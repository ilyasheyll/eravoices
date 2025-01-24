<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('fonts/bootstrap-icons/font/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
        <title>{{ $title ?? 'Панель EraVoices' }}</title>
    </head>
    <body>
        <header class="header">
            <div class="container admin__container">
                <div class="header__top">
                    <a href="{{ route('index') }}" class="header__logo">
                        <img src="{{ asset('img/logo.svg') }}" alt="" class="header__logo-img" />
                    </a>
                    <div class="header__actions">
                        <a href="{{ route('user.index') }}" class="button header__button">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div class="header__burger"><span></span></div>
                    </div>
                </div>
            </div>
        </header>

        <main class="main">
            <div class="container admin__container">
                <div class="admin">
                    <div class="admin-panel">
                        <div class="admin-menu">
                            <nav class="admin-menu__nav">
                                <ul class="admin-menu__list">
                                    @if (Auth::user()->role === 'organizer')
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === 'organizer-info' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="fa-solid fa-user admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Данные организатора</p>
                                            </a>
                                        </li>
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.events.index') }}" class="admin-menu__link {{ $section === 'events' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-calendar-event-fill admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Мероприятия</p>
                                            </a>
                                        </li>
                                    @elseif (Auth::user()->role === 'manager')
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.banners.index') }}" class="admin-menu__link {{ $section === 'banners' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-card-image admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Баннеры</p>
                                            </a>
                                        </li>
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.events.index') }}" class="admin-menu__link {{ $section === 'events' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-calendar-event-fill admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Мероприятия</p>
                                            </a>
                                        </li>
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.organizers.index') }}" class="admin-menu__link {{ $section === 'organizers' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-archive-fill admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Организаторы</p>
                                            </a>
                                        </li>
                                    @elseif (Auth::user()->role === 'administrator')
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.stats.index') }}" class="admin-menu__link {{ $section === 'stats' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-graph-up admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Статистика</p>
                                            </a>
                                        </li>
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.tickets.index') }}" class="admin-menu__link {{ $section === 'tickets' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-receipt admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Продажи</p>
                                            </a>
                                        </li>
                                    @endif




                                    {{-- @can('view-organizer-info', Auth::user())
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === 'organizer-info' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="fa-solid fa-user admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Данные организатора</p>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('viewAny', \App\Models\Event::class)
                                        <li class="admin-menu__item">
                                            <a href="{{ route('panel.events.index') }}" class="admin-menu__link {{ $section === 'events' ? 'admin-menu__link--selected' : '' }}">
                                                <i class="bi bi-calendar-event-fill admin__menu-item-icon"></i>
                                                <p class="admin-menu__label">Мероприятия</p>
                                            </a>
                                        </li>
                                    @endcan
                                    <li class="admin-menu__item">
                                        <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === '1' ? 'admin-menu__link--selected' : '' }}">
                                            <i class="bi bi-card-image admin__menu-item-icon"></i>
                                            <p class="admin-menu__label">Баннеры</p>
                                        </a>
                                    </li>
                                    <li class="admin-menu__item">
                                        <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === '1' ? 'admin-menu__link--selected' : '' }}">
                                            <i class="bi bi-calendar-event-fill admin__menu-item-icon"></i>
                                            <p class="admin-menu__label">Мероприятия</p>
                                        </a>
                                    </li>
                                    <li class="admin-menu__item">
                                        <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === '1' ? 'admin-menu__link--selected' : '' }}">
                                            <i class="bi bi-archive-fill admin__menu-item-icon"></i>
                                            <p class="admin-menu__label">Заявки организаторов</p>
                                        </a>
                                    </li>
                                    <li class="admin-menu__item">
                                        <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === '1' ? 'admin-menu__link--selected' : '' }}">
                                            <i class="fa-solid fa-user admin__menu-item-icon"></i>
                                            <p class="admin-menu__label">Организаторы</p>
                                        </a>
                                    </li>
                                    <li class="admin-menu__item">
                                        <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === '1' ? 'admin-menu__link--selected' : '' }}">
                                            <i class="bi bi-graph-up admin__menu-item-icon"></i>
                                            <p class="admin-menu__label">Статистика</p>
                                        </a>
                                    </li>
                                    <li class="admin-menu__item">
                                        <a href="{{ route('panel.organizer-info') }}" class="admin-menu__link {{ $section === '1' ? 'admin-menu__link--selected' : '' }}">
                                            <i class="bi bi-receipt admin__menu-item-icon"></i>
                                            <p class="admin-menu__label">Продажи</p>
                                        </a>
                                    </li> --}}
                                </ul>
                            </nav>
                        </div>
                        <div class="admin-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @yield('js-files')
        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/admin-products.js"></script> --}}
    </body>
</html>
