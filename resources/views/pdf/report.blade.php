<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/for-pdf/report.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="report">
        <table class="report__header">
            <tr>
                <td>
                    <img src="{{ asset('img/logo-black.svg') }}" alt="">
                </td>
                <td class="report__title-cell">
                    <h1 class="report__title">Отчёт по продажам</h1>
                </td>
            </tr>
        </table>
        <table class="report__table" cellspacing="0">
            <tr>
                <th>Мероприятие</th>
                <th>Организатор</th>
                <th>Количество продаж</th>
                <th>Доля организатора, руб.</th>
                <th>Доля зала, руб.</th>
                <th>Итого, руб.</th>
            </tr>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->event_name }}</td>
                    <td>
                        @if ($item->organizer_id)
                            @if ($item->type === \App\Models\Organizer::UR_PERSON)
                                {{ $item->organization_name }}
                            @else
                                {{ $item->last_name }}
                                {{ $item->first_name }}
                                {{ $item->father_name }}
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->count_tickets }}</td>
                    <td>
                        {{
                            $item->organizer_id
                            ? $item->price_sum - ($item->price_sum * ((100 - $item->percent)) / 100)
                            : 0
                        }}
                    </td>
                    <td>
                        {{
                            $item->organizer_id
                            ? $item->price_sum - ($item->price_sum * ($item->percent / 100))
                            : $item->price_sum
                        }}
                    </td>
                    <td>{{ $item->price_sum }} Р</td>
                </tr>
            @endforeach
            <tr>
                <td id="results_label" colspan="2">Итого:</td>
                <td>{{ $data->sum('count_tickets') }}</td>
                <td>{{ $resultOrganizerSum }}</td>
                <td>{{ $resultHallSum }}</td>
                <td>{{ $data->sum('price_sum') }}</td>
            </tr>
        </table>
        <p class="report__date">
            Дата: {{ \Carbon\Carbon::now()->format('d.m.Y') }}
        </p>
        <div class="report__signatures">
            <p class="report__singature">
                Составил: {{ Auth::user()->last_name }} {{ Auth::user()->first_name }} {{ Auth::user()->father_name }} / __________
            </p>
            <p class="report__singature">Утвердил: Иванов Иван Иванович / __________</p>
        </div>
    </div>
</body>
</html>
