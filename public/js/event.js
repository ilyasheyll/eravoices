let tickets = [];
let ticketsCount = 0
let ticketsCost = 0;

const paymentBlock = document.querySelector('.purchase__payment');
const ticketsCountBlock = document.getElementById('tickets-count');
const ticketsSumBlock = document.getElementById('tickets-sum');
const orderForm = document.querySelector('.purchase__payment-order');

const zonesForStanding = document.querySelectorAll('.purchase__tickets-category[data-zone-type-id="1"]');
const zonesForSeating = document.querySelectorAll('.purchase__tickets-category[data-zone-type-id="2"]')

zonesForStanding.forEach(zone => {
    const priceId = zone.dataset.priceId;
    const price = +zone.dataset.priceValue;
    const seatId = zone.dataset.seatId;

    const countInput = zone.querySelector(".purchase__tickets-counter-input");
    let countInputValue = +countInput.value;

    const counterButtons = zone.querySelectorAll(".purchase__tickets-counter-button");
    counterButtons.forEach((button) => {
        const actionButton = button.dataset.action;

        button.addEventListener("click", () => {
            if (actionButton == 'decrease' && countInputValue === 0) return;

            ticketsCount = actionButton == 'increase' ? ticketsCount + 1 : ticketsCount - 1;
            ticketsCost = actionButton == 'increase' ? ticketsCost + price : ticketsCost - price;
            countInput.value = actionButton == "increase" ? countInputValue + 1 : countInputValue - 1;
            countInputValue = +countInput.value;

            const newTicket = {
                seatId: seatId,
                priceId: priceId,
                priceValue: price
            };

            if (actionButton == 'increase') tickets.push(newTicket);
            else {
                const ticketIndex = tickets.findLastIndex(ticket => {
                    return ticket.seatId === newTicket.seatId && ticket.priceId === newTicket.priceId;
                });

                tickets = tickets.filter((ticket, index) => index !== ticketIndex);
            }

            outputTicketsData(ticketsCount, ticketsCost);
        });
    });
})

zonesForSeating.forEach(zone => {
    const priceId = zone.dataset.priceId;
    const price = +zone.dataset.priceValue;

    const ticketButtons = zone.querySelectorAll('.purchase__tickets-button');
    ticketButtons.forEach(button => {
        const seatId = button.dataset.seatId;

        button.addEventListener('click', () => {
            const newTicket = {
                seatId: seatId,
                priceId: priceId,
                priceValue: price
            };

            button.classList.toggle('button--transparent');
            if (!button.classList.contains('button--transparent')) {
                tickets.push(newTicket);
                ticketsCount++;
                ticketsCost += price;
            } else {
                tickets = tickets.filter(ticket => ticket.seatId !== newTicket.seatId && ticket.priceId !== newTicket.priceId);
                ticketsCount--;
                ticketsCost -= price;
            }

            outputTicketsData(ticketsCount, ticketsCost);
        })
    })
});

orderForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const token = orderForm._token.value;
    fetch(orderForm.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify({ "_token": token, price: ticketsCost, tickets: tickets })
    })
        .then(response => response.json())
        .then(result => {
            // console.log(result);
            if (!result.success) throw new Error();
            location.href = result.confirmationUrl;
        });
})

function outputTicketsData(count, cost) {
    if (count <= 0) {
        paymentBlock.classList.remove('purchase__payment--showed');
        return;
    }

    paymentBlock.classList.add('purchase__payment--showed');
    ticketsCountBlock.textContent = count;
    ticketsSumBlock.textContent = cost;
    console.log(tickets);
}
