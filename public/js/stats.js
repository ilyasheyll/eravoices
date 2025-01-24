Chart.defaults.color = '#eee';

let chartForDays;
let chartForEvents;
let chartForOrganizers;

const filterForm = document.querySelector('.admin-content__filter');
const dateStartInput = filterForm.date_start;
const dateEndInput = filterForm.date_end;
outputAllStats(dateStartInput.value, dateEndInput.value);

filterForm.addEventListener('submit', (event) => {
    event.preventDefault();

    outputAllStats(dateStartInput.value, dateEndInput.value);
});

function outputAllStats(startDate, endDate) {
    outputStatsForDays(startDate, endDate);
    outputStatsForEvents(startDate, endDate);
    outputStatsForOrganizers(startDate, endDate);
}

async function outputStatsForDays(startDate, endDate) {
    const response = await fetch(`/panel/stats/per-days?start_date=${startDate}&end_date=${endDate}`);
    if (!response.ok) throw new Error();
    const stats = await response.json();

    let priceSum = 0;
    let ticketsCount = 0;
    let labels = [];
    let dataset = [];
    stats.data.forEach(statsItem => {
        labels.push(statsItem.day);
        dataset.push(statsItem.count_tickets);

        priceSum += +statsItem.price_sum;
        ticketsCount += statsItem.count_tickets;
    });

    document.getElementById('price_sum').textContent = priceSum;
    // document.getElementById('hall_sum').textContent = priceSum - (priceSum * 95 / 100);
    document.getElementById('tickets_count').textContent = ticketsCount;

    const config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Продажи',
                    data: dataset,
                    borderColor: '#036dbb',
                    backgroundColor: '#107cc9'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Продаж: ${stats.data[context.dataIndex].count_tickets}, выручка: ${stats.data[context.dataIndex].price_sum} руб.`
                        }
                    }
                }
            }
        },
    };

    const ctx = document.getElementById("canvas");
    chartForDays = createOrUpdateChart(chartForDays, ctx, config);
}

async function outputStatsForEvents(startDate, endDate) {
    const response = await fetch(`/panel/stats/by-events?start_date=${startDate}&end_date=${endDate}`);
    if (!response.ok) throw new Error();
    const stats = await response.json();

    let labels = [];
    let dataset = [];
    stats.data.forEach(statsItem => {
        labels.push(statsItem.name);
        dataset.push(statsItem.count_tickets);
    });

    const config = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Продажи',
                    data: dataset,
                    borderColor: '#036dbb',
                    backgroundColor: '#107cc9'
                }
            ]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Продаж: ${stats.data[context.dataIndex].count_tickets}, выручка: ${stats.data[context.dataIndex].price_sum} руб.`
                        }
                    }
                }
            }
        }
    };

    const ctx = document.getElementById("canvas2");
    chartForEvents = createOrUpdateChart(chartForEvents, ctx, config);
}

async function outputStatsForOrganizers(startDate, endDate) {
    const response = await fetch(`/panel/stats/by-organizers?start_date=${startDate}&end_date=${endDate}`);
    if (!response.ok) throw new Error();
    const stats = await response.json();

    let labels = [];
    let dataset = [];
    stats.data.forEach(statsItem => {
        labels.push(`${statsItem.last_name} ${statsItem.first_name} ${statsItem.father_name}`);
        dataset.push(statsItem.count_tickets);
    });

    const config = {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Продажи',
                    data: dataset,
                    borderColor: '#036dbb',
                    backgroundColor: '#107cc9'
                }
            ]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Продаж: ${stats.data[context.dataIndex].count_tickets}, выручка: ${stats.data[context.dataIndex].price_sum} руб.`
                        }
                    }
                }
            }
        }
    };

    const ctx = document.getElementById("canvas3");
    chartForOrganizers = createOrUpdateChart(chartForOrganizers, ctx, config);
}

function createOrUpdateChart(chart, ctx, config) {
    if (chart !== undefined) {
        chart.data = config.data;
        chart.update();
    } else {
        chart = new Chart(ctx, config);
    }

    return chart;
}
