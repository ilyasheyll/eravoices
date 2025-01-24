<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/for-pdf/ticket.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="ticket">
        <div class="ticket__img-block">
            <img src="{{ $qrCode }}" alt="" class="ticket__img">
        </div>
        <div class="ticket__text">
            <p class="ticket__event">Мероприятие: {{ $ticket->price->event->name }}</p>
            <div class="ticket__data">
                <p class="ticket__data-item">Покупатель: {{$user->last_name}} {{$user->first_name}} {{$user->father_name}}</p>
                <p class="ticket__data-item">
                    Время проведения: {{ \Carbon\Carbon::parse($ticket->price->event->date)->format('d.m.Y H:i:s') }}
                </p>
                <p class="ticket__data-item">Зона: {{ $ticket->price->zone->name }}</p>
                <p class="ticket__data-item">Место: {{ $ticket->seat->designation }}</p>
                <p class="ticket__data-item">Стоимость: {{ $ticket->price->price_value }} руб.</p>
            </div>
        </div>
    </div>
</body>
</html>