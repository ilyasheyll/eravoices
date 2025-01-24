<nav class="admin-menu__nav">
    <ul class="admin-menu__list">
        @can('view-organizer-info', Auth::user())
            <li class="admin-menu__item">
                <a href="{{ route('organizer.index') }}" class="admin-menu__link {{ $section === 'personal' ? 'admin-menu__link--selected' : '' }}">
                    <i class="fa-solid fa-user admin__menu-item-icon"></i>
                    <p class="admin-menu__label">Данные организатора</p>
                </a>
            </li>
        @endcan
        @can('viewAny', \App\Models\Event::class)
            <li class="admin-menu__item">
                <a href="{{ route('organizer.events.index') }}" class="admin-menu__link {{ $section === 'events' ? 'admin-menu__link--selected' : '' }}">
                    <i class="bi bi-calendar-event-fill admin__menu-item-icon"></i>
                    <p class="admin-menu__label">Мероприятия</p>
                </a>
            </li>
        @endcan
        <li class="admin-menu__item">
            <a href="{{ route('organizer.requests.index') }}" class="admin-menu__link {{ $section === 'requests' ? 'admin-menu__link--selected' : '' }}">
                <i class="bi bi-archive-fill admin__menu-item-icon"></i>
                <p class="admin-menu__label">Заявки на организацию</p>
            </a>
        </li>
    </ul>
</nav>