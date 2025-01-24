@extends('layouts.panel', ['section' => 'tickets'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Продажи</h2>
        <div class="admin-content__report">
            <button class="admin-content__report-button">
                <p class="admin-content__report-button-text">Отчёт по продажам</p>
                <i class="admin-content__report-button-icon fa-solid fa-chevron-down"></i>
            </button>
            <div class="admin-content__report-dropdown">
                <form action="{{ route('panel.tickets.report') }}" class="" enctype="multipart/form-data">
                    <div class="admin__form-input-block">
                        <div class="admin__form-label-block">
                            <label for="" class="admin__form-label">Период: от</label>
                        </div>
                        <input type="date" name="start_date" value="{{ $startDate }}" value="" id="" class="input admin__form-input" required />
                    </div>
                    <div class="admin__form-input-block">
                        <div class="admin__form-label-block">
                            <label for="" class="admin__form-label">Период: до</label>
                        </div>
                        <input type="date" name="end_date" value="{{ $endDate }}" id="" class="input admin__form-input" required />
                    </div>

                    <button type="submit" class="button admin__form-button">Сформировать</button>
                </form>
            </div>
        </div>
    </div>
    <div class="admin-content__section">
{{--        <div class="admin-content__results">--}}
{{--            <div class="admin-content__result">--}}
{{--                <p class="admin-content__result-value">--}}
{{--                    {{ $paidTickets->count() }}--}}
{{--                </p>--}}
{{--                <p class="admin-content__result-label">совершено продаж</p>--}}
{{--            </div>--}}
{{--            <div class="admin-content__result">--}}
{{--                <p class="admin-content__result-value">{{ $paidTickets->sum('ticket_price') }} Р</p>--}}
{{--                <p class="admin-content__result-label">получено с продаж</p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <div class="admin-content__section">
        <p class="admin-content__section-title">Фильтры</p>
        <form action="{{ route('panel.tickets.index') }}" method="GET" class="admin-content__filter">
            <div class="admin-content__filter-grid">
                <input type="text" id="event" name="event" placeholder="Мероприятие" class="input admin-content__filter-input">
                <select name="status" id="status" class="input admin-content__filter-input">
                    <option value="0" selected disabled>Статус</option>
                    <option value="Оплачен">Оплачен</option>
                    <option value="Не оплачен">Не оплачен</option>
                </select>
            </div>
            <div class="admin-content__filter-grid">
                <input type="date" id="start_date" value="{{ $startDate }}" name="start_date" class="input admin-content__filter-input">
                <input type="date" id="end_date" value="{{ $endDate }}" name="end_date" class="input admin-content__filter-input">
            </div>
            <button type="submit" class="button admin-content__filter-button button--transparent">Найти</button>
        </form>
    </div>
    <div class="admin-content__section">
        <div class="admin-content-table__block">
            <table class="admin-table admin-content__table" cellspacing="0px">
                <tr class="admin-table__row">
                    <th class="admin-table__cell">ID</th>
                    <th class="admin-table__cell">Мероприятие</th>
                    <th class="admin-table__cell">Зона</th>
                    <th class="admin-table__cell">Место</th>
                    <th class="admin-table__cell">Стоимость</th>
                    <th class="admin-table__cell">Статус</th>
                    <th class="admin-table__cell">Время оплаты</th>
                    {{-- <th class="admin-table__cell">Действия</th> --}}
                </tr>
                @foreach ($tickets as $ticket)
                    <tr class="admin-table__row">
                        <td class="admin-table__cell">{{ $ticket->id }}</td>
                        <td class="admin-table__cell">{{ $ticket->price->event->name }}</td>
                        <td class="admin-table__cell">
                            {{ $ticket->price->zone->name }}
                        </td>
                        <td class="admin-table__cell">{{ $ticket->seat->designation }}</td>
                        <td class="admin-table__cell">{{ $ticket->price->price_value }}</td>
                        <td class="admin-table__cell">{{ $ticket->status }}</td>
                        <td class="admin-table__cell">{{ $ticket->created_at }}</td>
                        {{-- <td class="admin-table__cell">
                            <div class="admin-table-cell-actions">
                                <a href="{{ route('panel.events.edit', [$event->id]) }}">
                                    <i class="fa-solid fa-pen-to-square admin__table-cell-icon"></i>
                                </a>
                                <a href="">
                                    <i class="fa-solid fa-trash admin__table-cell-icon admin__table-cell-icon--red"></i>
                                </a>
                            </div>
                        </td> --}}
                    </tr>
                @endforeach
            </table>
        </div>

        <div class="page-links admin-content__links">
            {{ $tickets->withQueryString()->links() }}
        </div>
    </div>
@endsection

@section('js-files')
    <script src="{{ asset('js/tickets-page.js') }}"></script>
@endsection
