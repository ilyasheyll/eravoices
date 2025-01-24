const navigationButtons = document.querySelectorAll('button.account__navigation-button');

navigationButtons.forEach(button => {
    button.addEventListener('click', () => {
        const selectedButton = document.querySelector('.account__navigation-button--selected');
        const showedSection = document.querySelector('.account__section--showed');
        if (selectedButton) selectedButton.classList.remove('account__navigation-button--selected');
        if (showedSection) showedSection.classList.remove('account__section--showed');
        document.getElementById(button.dataset.section).classList.add('account__section--showed');
        button.classList.add('account__navigation-button--selected');
    });
});

document.querySelector('.account__navigation-button').click();
