@php
    $profit = $event->paidTickets()->sum('ticket_price')
@endphp

@extends('layouts.panel', ['section' => 'events'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Мероприятие: {{ $event->name }}</h2>
    </div>
    <div class="admin-event">
        <div class="admin-content__section">
            <div class="admin-event__data">
                <div class="admin-event__fields">
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Категория</p>
                        <p class="admin-event__field-value">{{ $event->category->name }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Дата проведения</p>
                        <p class="admin-event__field-value">{{ $event->date }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Описание</p>
                        <p class="admin-event__field-value">{{ $event->descr }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Продано билетов</p>
                        <p class="admin-event__field-value">{{ $event->paidTickets()->count() }} шт.</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">На сумму</p>
                        <p class="admin-event__field-value">{{ $profit }} руб.</p>
                    </div>

                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Конечная прибыль</p>
                        <p class="admin-event__field-value">
                            {{
                                Auth::user()->role === 'organizer'
                                ? $profit - $event->organizerSumPercent()
                                : $event->organizerSumPercent()
                            }} руб.
                        </p>
                    </div>
                </div>
                <div class="admin-event__img-block">
                    <img src="{{ asset('storage/' . $event->image) }}" alt="" class="admin-event__img">
                </div>
            </div>
        </div>
        <div class="admin-content__section admin-event__section">
            <p class="admin-content__section-title">Проданные билеты по каждой зоне</p>
            <div class="admin-event__tickets">
                @foreach ($event->prices as $price)
                    <div class="admin-event__ticket">
                        <p class="admin-event__ticket-name">{{ $price->zone->name }}</p>
                        <div class="admin-event__ticket-sales">
                            <span>{{ $price->count_purchases }}</span>/{{ $price->zone->count_tickets }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
