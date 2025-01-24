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
            </div>
        </div>
        <div class="account__sections">
            <div class="account__section" id="tickets">
                <div class="account__tickets">
                    <div class="account__subtitle">Билеты</div>
                    <div class="account__tickets-categories">
                        <div class="account__tickets-category">
                            <p class="account__tickets-category-name">Активные билеты</p>
                            <div class="event-blocks account__tickets-list">
                                @php $countActiveTickets = 0; @endphp
                                @foreach ($tickets->where('status', 'Оплачен')->where('used', 0) as $activeTicket)
                                    @if ($nextDayTimestamp < \Carbon\Carbon::parse($activeTicket->price->event->date)->timestamp)
                                        @php $countActiveTickets++; @endphp
                                        <div class="event-block">
                                            <div class="event-block__data">
                                                <div class="event-block__img-block">
                                                    <img src="{{ asset('storage/' . $activeTicket->price->event->image) }}" alt="" class="event-block__img" />
                                                </div>
                                                <div class="event-block__fields">
                                                    <p class="event-block__event">{{ $activeTicket->price->event->name }}</p>
                                                    <p class="event-block__field">
                                                        <span>Время проведения:</span> {{ \Carbon\Carbon::parse($activeTicket->price->event->date)->format('d.m.Y H:i:s') }}
                                                    </p>
                                                    <p class="event-block__field"><span>Зона:</span> {{ $activeTicket->price->zone->name }}</p>
                                                    <p class="event-block__field"><span>Место:</span> {{ $activeTicket->seat->designation }}</p>
                                                    <p class="event-block__field"><span>Стоимость:</span> {{ $activeTicket->price->price_value }} ₽</p>
                                                    <p class="event-block__field">
                                                        <span>Время покупки:</span> {{ \Carbon\Carbon::parse($activeTicket->created_at)->format('d.m.Y H:i:s') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="event-block__buttons">
                                                <a href="{{ route('user.ticket.show', [$activeTicket->id]) }}" class="button event-block__button button--full-width">
                                                    <i class="event-block__button-icon fa-solid fa-ticket"></i>
                                                    <span class="event-block__button-text">Скачать билет</span>
                                                </a>
                                                <form method="post" action="{{ route('user.ticket.update', [$activeTicket->id]) }}" class="event-block__button">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="button event-block__button button--full-width button--bg-transparent button--red-border">
                                                        <i class="event-block__button-icon fa-solid fa-xmark"></i>
                                                        <span class="event-block__button-text">Отменить</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($countActiveTickets === 0)
                                    <p>Не найдено информации об активных билетах!</p>
                                @endif
                            </div>
                        </div>
                        <div class="account__tickets-category">
                            <p class="account__tickets-category-name">Неактивные билеты</p>
                            <div class="account__tickets-list">
                                @php $countInactiveTickets = 0; @endphp
                                @foreach ($tickets as $inactiveTicket)
                                    @if ($inactiveTicket->status === 'Отменён' || $nextDayTimestamp > \Carbon\Carbon::parse($inactiveTicket->price->event->date)->timestamp)
                                        @php $countInactiveTickets++; @endphp
                                        <div class="event-block">
                                            <div class="event-block__data">
                                                <div class="event-block__img-block">
                                                    <img src="{{ asset('storage/' . $inactiveTicket->price->event->image) }}" alt="" class="event-block__img" />
                                                </div>
                                                <div class="event-block__fields">
                                                    <p class="event-block__event">{{ $inactiveTicket->price->event->name }}</p>
                                                    <p class="event-block__field"><span>Статус:</span> {{ $inactiveTicket->status }} </p>
                                                    <p class="event-block__field">
                                                        <span>Время проведения:</span> {{ \Carbon\Carbon::parse($inactiveTicket->price->event->date)->format('d.m.Y H:i:s') }}
                                                    </p>
                                                    <p class="event-block__field"><span>Зона:</span> {{ $inactiveTicket->price->zone->name }}</p>
                                                    <p class="event-block__field"><span>Место:</span> {{ $inactiveTicket->seat->designation }}</p>
                                                    <p class="event-block__field"><span>Стоимость:</span> {{ $inactiveTicket->price->price_value }} ₽</p>
                                                    <p class="event-block__field">
                                                        <span>Время покупки:</span> {{ \Carbon\Carbon::parse($inactiveTicket->created_at)->format('d.m.Y H:i:s') }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                @if ($countInactiveTickets === 0)
                                    <p>Не найдено информации о неактивных билетах!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="account__section" id="favorites">
                <h3 class="account__subtitle">Избранное</h3>
                <div class="account__favorites">
                    <div class="events-list">
                        @foreach ($user->favorites->sortByDesc('created_at') as $favorite)
                            <a href="{{ route('event.show', ['event' => $favorite->event->id]) }}" class="events-list__item">
                                <div class="events-list__item-img-block">
                                    <img src="{{ asset('storage/' . $favorite->event->image) }}" alt="" class="events-list__item-img" />
                                </div>
                                <p class="events-list__item-name">{{ $favorite->event->name }}</p>
                                <p class="events-list__item-date">{{ \Carbon\Carbon::parse($favorite->event->date)->format('d.m.Y H:i:s') }}</p>
                                <p class="events-list__item-price">{{ $favorite->event->prices()->min('price_value') }}-{{ $favorite->event->prices()->max('price_value') }} ₽</p>
                                <button class="button events-list__item-button button--full-width">Подробнее</button>
                                @auth
                                    @if (!Auth::user()->favorites->contains('event_id', $favorite->event->id))
                                        <form method="post" action="{{ route('favorites.store') }}" class="events-list__item-favorite">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $favorite->event->id }}">
                                            <button type="submit" class="events-list__item-favorite-button">
                                                <i class="events-list__item-favorite-icon fa-solid fa-heart"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form
                                            method="POST" 
                                            action="{{ route('favorites.destroy', [Auth::user()->favorites->where('event_id', $favorite->event->id)->first()->id]) }}" 
                                            class="events-list__item-favorite"
                                        >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="events-list__item-favorite-button events-list__item-favorite-button--red">
                                                <i class="events-list__item-favorite-icon fa-solid fa-heart"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/account.js') }}"></script>
@endsection
