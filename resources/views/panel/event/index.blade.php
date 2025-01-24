@extends('layouts.panel', ['section' => 'events'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Мероприятия</h2>
    </div>
    <a href="{{ route('panel.events.create') }}" class="button admin-content__button">Добавить</a>
    <form action="{{ route('panel.events.index') }}" method="GET" class="admin-content__filter">
        <div class="admin-content__filter-grid">
            <input type="text" id="name" name="name" placeholder="Мероприятие" class="input admin-content__filter-input">
            <select name="event_status_id" id="" class="input admin-content__filter-input">
                <option value="" selected disabled>Статус:</option>
                <option value="">Все мероприятия</option>
                @foreach ($eventStatuses as $eventStatus)
                    <option value="{{ $eventStatus->id }}">{{ $eventStatus->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="button admin-content__filter-button button--transparent">Найти</button>
    </form>
    <div class="admin-content-table__block">
        <table class="admin-table admin-content__table" cellspacing="0px">
            <tr class="admin-table__row">
                <th class="admin-table__cell">Наименование</th>
                <th class="admin-table__cell">Категория</th>
                <th class="admin-table__cell">Дата проведения</th>
                <th class="admin-table__cell">Статус</th>
                <th class="admin-table__cell">Действия</th>
            </tr>
            @foreach ($events as $event)
                <tr class="admin-table__row">
                    <td class="admin-table__cell">{{ $event->name }}</td>
                    {{-- <td class="admin-table__cell">{{ $banner->min_descr }}</td> --}}
                    <td class="admin-table__cell">{{ $event->category->name }}</td>
                    <td class="admin-table__cell">
                        {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}
                    </td>
                    <td class="admin-table__cell">{{ $event->status->name }}</td>
                    <td class="admin-table__cell">
                        <div class="admin-table-cell-actions">
                            @if (in_array($event->event_status_id, [
                                \App\Models\EventStatus::ACTIVE_STATUS,
                                \App\Models\EventStatus::FINISHED_STATUS
                            ]))
                                <a href="{{ route('panel.events.show', [$event->id]) }}">
                                    <i class="fa-solid fa-eye admin__table-cell-icon"></i>
                                </a>
                            @endif
                            <a href="{{ route('panel.events.edit', [$event->id]) }}">
                                <i class="fa-solid fa-pen-to-square admin__table-cell-icon"></i>
                            </a>
                            <form method="POST" action="{{ route('panel.events.destroy', [$event->id]) }}">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    <i class="fa-solid fa-trash admin__table-cell-icon admin__table-cell-icon--red"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="page-links admin-content__links">
        {{ $events->withQueryString()->links() }}
    </div>
@endsection
