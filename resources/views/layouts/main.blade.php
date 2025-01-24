<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link rel="icon" href="{{ asset('img/favicon/favicon.ico') }}" sizes="any">
        <link rel="icon" href="{{ asset('img/favicon/favicon.svg') }}" type="image/svg+xml">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('fonts/bootstrap-icons/font/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/all.min.css') }}" />
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <title>{{ $title ?? 'EraVoices - концертная площадка' }}</title>
    </head>
    <body>
        <div class="wrapper">
            <header class="header">
                <div class="container">
                    <div class="header__top">
                        <a href="{{ route('index') }}" class="header__logo">
                            <img src="{{ asset('img/logo.svg') }}" alt="" class="header__logo-img" />
                        </a>
                        <div class="header__top-search">
                            <form action="{{ route('event.index') }}" class="search-block">
                                <input type="text" name="name" class="search__input" />
                                <button type="submit" class="search__button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                        <div class="header__menu">
                            <div class="header__menu-head">
                                <button class="close-menu-btn header__menu-close"></button>
                            </div>
                            <nav class="header__nav">
                                <ul class="header__nav-list">
                                    <li class="header__nav-item"><a href="{{ route('about') }}" class="header__nav-link underline-on-hover">О нас</a></li>
                                    <li class="header__nav-item"><a href="{{ route('event.index') }}" class="header__nav-link underline-on-hover">Афиша</a></li>
                                    <li class="header__nav-item"><a href="{{ route('organizers.index') }}" class="header__nav-link underline-on-hover">Организаторам</a></li>
                                    <li class="header__nav-item"><a href="{{ route('contacts') }}" class="header__nav-link underline-on-hover">Контакты</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="header__actions">
                            <a href="{{ route('user.index') }}" class="button header__button">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <div class="header__burger"><span></span></div>
                        </div>
                    </div>
                    <div class="header__bottom">
                        <div class="header__bottom-search">
                            <div class="search-block header__bottom-search-block">
                                <input type="text" class="search__input header__bottom-search-input" />
                                <button type="submit" class="search__button">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="main">
                <div class="container">
                    @yield('content')
                </div>
            </main>

            <footer class="footer">
                <div class="container">
                    <div class="footer__sections">
                        <div class="footer__section">
                            <a href="#" class="footer__logo">
                                <img src="{{ asset('img/logo.svg') }}" alt="" class="footer__logo-img" />
                            </a>
                            <p class="footer__copyright">© 2010-2024. Все права защищены</p>
                            <div class="contacts footer__contacts">
                                <div class="contact">
                                    <i class="contact__icon fa-solid fa-envelope"></i>
                                    <p class="contact__text">
                                        <a class="contact__text-link" href="#" class="">mail@eravoices.ru</a>
                                    </p>
                                </div>
                                <div class="contact">
                                    <i class="contact__icon fa-solid fa-phone"></i>
                                    <p class="contact__text">
                                        <a class="contact__text-link" href="#" class="">+7 (900) 900-00-00</a>
                                    </p>

                                </div>
                                <div class="contact">
                                    <i class="contact__icon fa-solid fa-location-dot"></i>
                                    <p class="contact__text">г. Екатеринбург, ул. Куйбышева, д. 48</p>
                                </div>
                            </div>
                        </div>
                        <div class="footer__section">
                            <p class="footer__section-title">Компания</p>
                            <ul class="footer__section-list">
                                <li class="footer__section-list-item"><a href="{{ route('about') }}" class="footer__section-link underline-on-hover">О нас</a></li>
                                <li class="footer__section-list-item"><a href="{{ route('organizers.index') }}" class="footer__section-link underline-on-hover">Организаторам</a></li>
                                <li class="footer__section-list-item">
                                    <a href="{{ route('policy') }}" class="footer__section-link underline-on-hover">Политика обработки персональных данных</a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer__section">
                            <p class="footer__section-title">Онлайн-ресурсы</p>
                            <ul class="socials">
                                <li class="social">
                                    <a href="#" class="social__link"><i class="fa-brands fa-vk"></i></a>
                                </li>
                                <li class="social">
                                    <a href="#" class="social__link"><i class="fa-brands fa-youtube"></i></a>
                                </li>
                                <li class="social">
                                    <a href="#" class="social__link"><i class="fa-brands fa-telegram"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>

            <script src="{{ asset('js/header.js') }}"></script>
            @yield('js-files')
        </div>
    </body>
</html>
