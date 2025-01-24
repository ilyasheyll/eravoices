@extends('layouts.main')
@section('content')
    <section class="ticket-info">
        <div class="section-title-block">
            <h2 class="section-title">Билет №{{ $ticket->id }}</h2>
        </div>
        <div class="ticket-info__fields">
            <p class="ticket-info__field">
                <span class="ticket-info__field-label">Покупатель: </span> 
                {{ $ticket->user->last_name }} {{ $ticket->user->first_name }} {{ $ticket->user->father_name }}
            </p>
            <p class="ticket-info__field">
                <span class="ticket-info__field-label">Мероприятие: </span> 
                {{ $ticket->price->event->name }}
            </p>
            <p class="ticket-info__field">
                <span class="ticket-info__field-label">Дата проведения: </span> 
                {{ \Carbon\Carbon::parse($ticket->price->event->date)->format('d.m.Y H:i:s') }}
            </p>
            <p class="ticket-info__field">
                <span class="ticket-info__field-label">Зона: </span> 
                {{ $ticket->price->zone->name }}
            </p>
            <p class="ticket-info__field">
                <span class="ticket-info__field-label">Место: </span> 
                {{ $ticket->seat->designation }}
            </p>
            <p class="ticket-info__field">
                <span class="ticket-info__field-label">Статус: </span> 
                <span 
                    class="ticket-info__field-status {{ $ticket->status !== 'Оплачен' ? 'ticket-info__field-status--red' : '' }}"
                >
                    Оплачен
                </span>
            </p>
        </div>
        @can('inspector-update-ticket', $ticket)
            @if (!$ticket->used)
                <form method="POST" class="ticket-info__action" action="{{ route('tickets.update', $ticket->code) }}">
                    @csrf
                    @method('patch')
                    <button type="submit" class="button button--blue">Пропустить</button>
                </form>
            @else
                <form method="POST" class="ticket-info__action" action="{{ route('tickets.update', $ticket->code) }}">
                    @csrf
                    @method('patch')
                    <button type="submit" class="button button--red">Отменить пропуск</button>
                </form>
            @endif
        @endcan
    </section>
@endsection
