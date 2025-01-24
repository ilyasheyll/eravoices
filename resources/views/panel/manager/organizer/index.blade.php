@extends('layouts.panel', ['section' => 'organizers'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Организаторы</h2>
    </div>
    {{-- <a href="{{ route('panel.banners.create') }}" class="button admin-content__button">Добавить</a> --}}
    <form action="{{ route('panel.organizers.index') }}" method="GET" class="admin-content__filter">
        <div class="admin-content__filter-grid">
            <select name="approved" id="" class="input admin-content__filter-input">
                <option value="" selected disabled>Подтверждение</option>
                <option value="1">Подтверждено</option>
                <option value="0">Не подтверждено</option>
            </select>
            <select name="type" id="" class="input admin-content__filter-input">
                <option value="" selected disabled>Тип организатора</option>
                @foreach(\App\Models\Organizer::getTypes() as $key => $type)
                    <option value="{{ $key }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="button admin-content__filter-button button--transparent">Найти</button>
    </form>
    {{-- <form action="{{ route('panel.organizers.index') }}" class="admin-content__filter admin-content__filter--3-cols">
        <select name="approved" id="" class="input admin-content__filter-input">
            <option value="" selected disabled>Подтверждение</option>
            <option value="">Все организаторы</option>
            <option value="1">Подтверждено</option>
            <option value="0">Не подтверждено</option>
        </select>
        <select name="type" id="" class="input admin-content__filter-input">
            <option value="" selected disabled>Тип организатора</option>
            <option value="">Все организаторы</option>
            <option value="Физическое лицо">Физическое лицо</option>
            <option value="Юридическое лицо">Юридическое лицо</option>
        </select>
        <button type="submit" class="button button--transparent">Найти</button>
    </form> --}}
    <div class="admin-content-table__block">
        <table class="admin-table admin-content__table" cellspacing="0px">
            <tr class="admin-table__row">
                <th class="admin-table__cell">ФИО организатора</th>
                <th class="admin-table__cell">Тип</th>
                <th class="admin-table__cell">Подтверждено</th>
                <th class="admin-table__cell">Действия</th>
            </tr>
            @foreach ($organizers as $organizer)
                <tr class="admin-table__row">
                    <td class="admin-table__cell">
                        {{ $organizer->user->last_name }} {{ $organizer->user->first_name }} {{ $organizer->user->father_name }}
                    </td>
                    {{-- <td class="admin-table__cell">{{ $banner->min_descr }}</td> --}}
                    <td class="admin-table__cell">{{ $organizerTypes[$organizer->type] }}</td>
                    <td class="admin-table__cell">{{ $organizer->approved ? 'Да' : 'Нет' }}</td>
                    <td class="admin-table__cell">
                        <div class="admin-table-cell-actions">
                            @if ($organizer->approved)
                                <a href="{{ route('panel.organizers.show', [$organizer->id]) }}">
                                    <i class="bi bi-eye-fill admin__table-cell-icon"></i>
                                </a>
                            @endif
                            <a href="{{ route('panel.organizers.edit', [$organizer->id]) }}">
                                <i class="fa-solid fa-pen-to-square admin__table-cell-icon"></i>
                            </a>
                            {{-- <form action="{{ route('panel.banners.destroy', [$banner->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    <i class="fa-solid fa-trash admin__table-cell-icon admin__table-cell-icon--red"></i>
                                </button>
                            </form> --}}
                            {{-- <a href="{{ route('panel.banners.edit', [$banner->id]) }}">
                                <i class="fa-solid fa-trash admin__table-cell-icon admin__table-cell-icon--red"></i>
                            </a> --}}
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="page-links admin-content__links">
        {{ $organizers->withQueryString()->links() }}
    </div>
@endsection
