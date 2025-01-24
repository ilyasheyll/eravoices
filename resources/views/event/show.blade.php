@extends('layouts.main', ['title' => "Мероприятие: {$event->name}"])
@section('content')
    <section class="information">
        <div class="information__img-block" style="background-image: url({{ asset('storage/' . $event->image) }})"></div>
        <div class="information__content">
            <div class="information__text">
                <div class="section-title-block information__title-block">
                    <h2 class="section-title information__title">Описание</h2>
                </div>
                <p class="information__desc">{{ $event->descr }}</p>
            </div>
            <div class="information__purchase">
                <p class="information__category">Категория: {{ $event->category->name }}</p>
                <p class="information__event">{{ $event->name }}</p>
                <p class="information__date">{{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}</p>
                @if ($event->event_status_id === \App\Models\EventStatus::FINISHED_STATUS)
                    <p class="information__completed">Мероприятие завершено</p>
                @else
                    <a href="#purchase-section" class="button information__button button--full-width">Купить билет</a>
                @endif
            </div>
        </div>
    </section>

    @if ($event->event_status_id === \App\Models\EventStatus::ACTIVE_STATUS)
        <section class="purchase" id="purchase-section">
            <div class="section-title-block purchase__title-block">
                <h2 class="section-title purchase__title">Купить билет</h2>
            </div>
            <div class="purchase__content">
                <div class="purchase__grid">
                    <div class="purchase__scheme">
                        <div class="purchase__scheme-img-block">
                            <img src="{{ asset('img/event-page/scheme-group.svg') }}" alt="" class="purchase__scheme-img" />
                        </div>
                    </div>
                    <div class="purchase__tickets">
                        @guest
                            <p class="purchase__tickets-message">
                                Для приобретения билетов необходимо <a href="{{ route('login') }}" class="main-link">авторизоваться</a> на сайте.
                            </p>
                        @endguest
                        @auth
                            @foreach($event->prices as $price)
                                @if($price->count_purchases < $price->zone->count_tickets)
                                    @if($price->zone->zone_type_id === \App\Models\ZoneType::STANDING_ZONE)
                                            <div class="purchase__tickets-category" data-zone-type-id="1" data-zone-id="{{ $price->zone->id }}" data-seat-id="{{ $price->zone->seatForStandingZone->id }}" data-price-id="{{ $price->id }}" data-price-value="{{ $price->price_value }}">
                                                <p class="purchase__tickets-category-name">{{ $price->zone->name }} ({{ $price->price_value }} руб.)</p>
                                                <div class="purchase__tickets-list">
                                                    <div class="purchase__tickets-counter">
                                                        <button class="button purchase__tickets-counter-button button--transparent" data-action="decrease">-</button>
                                                        <input type="text" name="count" id="" value="0" class="input purchase__tickets-counter-input" disabled />
                                                        <button class="button purchase__tickets-counter-button button--transparent" data-action="increase">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                    @else
                                        <div class="purchase__tickets-category" data-zone-type-id="2" data-zone-id="{{ $price->zone->id }}"  data-price-id="{{ $price->id }}" data-price-value="{{ $price->price_value }}">
                                            <p class="purchase__tickets-category-name">{{ $price->zone->name }} ({{ $price->price_value }} руб.)</p>
                                            <div class="purchase__tickets-list">
                                                @foreach ($price->zone->seatsByEvent($event) as $seat)
                                                    <button class="button purchase__tickets-button button--transparent" data-seat-id="{{ $seat->seat_id }}">{{ $seat->designation }}</button>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        @endauth
                    </div>
                </div>
                <div class="purchase__payment">
                    <div class="container">
                        <div class="purchase__payment-content">
                            <div class="purchase__payment-data">
                                <p class="purchase__payment-data-item">Билетов: <span id="tickets-count">2</span> шт.</p>
                                <p class="purchase__payment-data-item">на сумму <span id="tickets-sum">5000</span> ₽</p>
                            </div>
                            <form action="{{ route('orders.store') }}" name="order" method="post" class="purchase__payment-order">
                                @csrf
                                <button type="submit" class="button purchase__payment-button button--white">Оформить заказ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@section('js-files')
    <script src="{{ asset('js/event.js') }}"></script>
@endsection
