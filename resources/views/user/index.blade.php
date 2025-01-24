@extends('layouts.main', ['title' => 'Личный кабинет'])
@section('content')
    <section class="account">
        <div class="section-title-block">
            <div class="account__header">
                <h2 class="section-title account__title">Личный кабинет</h2>
                <a href="{{ route('logout') }}" class="account__header-button">
                    <i class="account__header-button-icon bi bi-box-arrow-left"></i>
                    <p class="account__header-button-text">Выйти</p>
                </a>
            </div>
        </div>
        <div class="account__content">
            <div class="account__data">
                <h3 class="account__subtitle">Личные данные</h3>
                <div class="account__data-content">
                    <div class="account__data-field">
                        <i class="account__data-field-icon fa-solid fa-user"></i>
                        <p class="account__data-field-value"><span>ФИО:</span> {{$user->last_name}} {{$user->first_name}} {{$user->father_name}}</p>
                    </div>
                    <div class="account__data-field">
                        <i class="account__data-field-icon fa-solid fa-envelope"></i>
                        <p class="account__data-field-value"><span>Email:</span> {{$user->email}}</p>
                    </div>
                </div>
            </div>
            <div class="account__navigation">
                <button class="button account__navigation-button" data-section="tickets">
                    <i class="account__navigation-button-icon fa-solid fa-ticket"></i>
                    <span class="account__navigation-button-text">Билеты</span>
                </button>
                <button class="button account__navigation-button" data-section="favorites">
                    <i class="account__navigation-button-icon fa-solid fa-heart"></i>
                    <span class="account__navigation-button-text">Избранное</span>
                </button>
                @can('view-panel')
                    <a href="{{ route('panel.index') }}" class="button account__navigation-button" data-section="favorites">
                        <i class="account__navigation-button-icon fa-solid fa-list"></i>
                        <span class="account__navigation-button-text">Панель EraVoices</span>
                    </a>
                @endcan
            </div>
        </div>
        <div class="account__sections">
            <div class="account__section" id="tickets">
                <div class="account__tickets">
                    <div class="account__subtitle">Билеты</div>
                    <div class="event-blocks account__tickets-list">
                        @forelse ($tickets as $ticket)
                            <div class="event-block">
                                <div class="event-block__data">
                                    <div class="event-block__img-block">
                                        <img src="{{ asset('storage/' . $ticket->price->event->image) }}" alt="" class="event-block__img" />
                                    </div>
                                    <div class="event-block__fields">
                                        <p class="event-block__event">{{ $ticket->price->event->name }}</p>
                                        <p class="event-block__field"><span>Статус:</span> {{ $ticket->status }} </p>
                                        <p class="event-block__field">
                                            <span>Время проведения:</span> {{ \Carbon\Carbon::parse($ticket->price->event->date)->format('d.m.Y H:i:s') }}
                                        </p>
                                        <p class="event-block__field"><span>Зона:</span> {{ $ticket->price->zone->name }}</p>
                                        <p class="event-block__field"><span>Место:</span> {{ $ticket->seat->designation }}</p>
                                        <p class="event-block__field"><span>Стоимость:</span> {{ $ticket->ticket_price }} ₽</p>
                                        <p class="event-block__field">
                                            <span>Время покупки:</span> {{ \Carbon\Carbon::parse($ticket->created_at)->format('d.m.Y H:i:s') }}
                                        </p>
                                    </div>
                                </div>
                                @if($ticket->isActiveTicket())
                                    <div class="event-block__buttons">
                                        <a href="{{ route('user.ticket.show', [$ticket->id]) }}" class="button event-block__button button--full-width">
                                            <i class="event-block__button-icon fa-solid fa-ticket"></i>
                                            <span class="event-block__button-text">Скачать билет</span>
                                        </a>
                                        <form method="post" action="{{ route('user.ticket.update', [$ticket->id]) }}" class="event-block__button">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="button event-block__button button--full-width button--bg-transparent button--red-border">
                                                <i class="event-block__button-icon fa-solid fa-xmark"></i>
                                                <span class="event-block__button-text">Отменить</span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p>Не найдено информации об активных билетах!</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="account__section" id="favorites">
                <h3 class="account__subtitle">Избранное</h3>
                <div class="account__favorites">
                    <div class="events-list">
                        @forelse ($favorites as $favorite)
                            <a href="{{ route('event.show', ['event' => $favorite->event->id]) }}" class="events-list__item">
                                <div class="events-list__item-img-block">
                                    <img src="{{ asset('storage/' . $favorite->event->image) }}" alt="" class="events-list__item-img" />
                                </div>
                                <p class="events-list__item-name">{{ $favorite->event->name }}</p>
                                <p class="events-list__item-date">{{ \Carbon\Carbon::parse($favorite->event->date)->format('d.m.Y H:i:s') }}</p>
                                <p class="events-list__item-price">{{ $favorite->event->prices->min('price_value') }}-{{ $favorite->event->prices->max('price_value') }} ₽</p>
                                <button class="button events-list__item-button button--full-width">Подробнее</button>
                                <form
                                    method="POST"
                                    action="{{ route('favorites.destroy', [$favorites->where('event_id', $favorite->event->id)->first()->id]) }}"
                                    class="events-list__item-favorite"
                                >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="events-list__item-favorite-button events-list__item-favorite-button--red">
                                        <i class="events-list__item-favorite-icon fa-solid fa-heart"></i>
                                    </button>
                                </form>
                            </a>
                        @empty
                            <p style="">Вы не добавили ни одного мероприятия в избранное</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-files')
    <script src="{{ asset('js/account.js') }}"></script>
@endsection
