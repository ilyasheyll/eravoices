const openMenu = document.querySelector('.header__burger');
const closeMenu = document.querySelector('.header__menu-close');
const headerMenu = document.querySelector('.header__menu');

[openMenu, closeMenu].forEach((button) => {
    button.addEventListener('click', () => {
        document.querySelector('body').classList.toggle('menu-opened');
        headerMenu.classList.toggle('header__menu--opened');
    });
});
