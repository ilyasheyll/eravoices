const typeSelect = document.getElementById('type');
const form = document.querySelector('.for-organizers__form');

typeSelect.addEventListener('change', () => {
    const showedFormSection = document.querySelector('.form__organizers-section--showed');
    if (showedFormSection) showedFormSection.classList.remove('form__organizers-section--showed');

    const selectedFormSection = document.getElementById(typeSelect.value);
    selectedFormSection.classList.add('form__organizers-section--showed');
});

form.addEventListener('submit', (e) => {
    e.preventDefault();

    fetch(form.action, {
        method: 'POST',
        body: new FormData(form)
    })
        .then(response => response.json())
        .then(result => {
            if (!result['success']) throw new Error();
            form.style.display = 'none';
            document.querySelector('.for-organizers__message-block').style.display = 'block';
        });
})
