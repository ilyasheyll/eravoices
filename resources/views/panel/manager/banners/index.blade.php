@extends('layouts.panel', ['section' => 'banners'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Баннеры</h2>
    </div>
    <a href="{{ route('panel.banners.create') }}" class="button admin-content__button">Добавить</a>
    <div class="admin-content-table__block">
        <table class="admin-table admin-content__table" cellspacing="0px">
            <tr class="admin-table__row">
                <th class="admin-table__cell">Заголовок</th>
                <th class="admin-table__cell">Активность</th>
                <th class="admin-table__cell">Дата изменения</th>
                <th class="admin-table__cell">Действия</th>
            </tr>
            @foreach ($banners as $banner)
                <tr class="admin-table__row">
                    <td class="admin-table__cell">{{ $banner->title }}</td>
                    <td class="admin-table__cell">
                        {{ $banner->active ? 'Да' : 'Нет' }}
                    </td>
                    <td class="admin-table__cell">{{ $banner->updated_at }}</td>
                    <td class="admin-table__cell">
                        <div class="admin-table-cell-actions">
                            <a href="{{ route('panel.banners.edit', [$banner->id]) }}">
                                <i class="fa-solid fa-pen-to-square admin__table-cell-icon"></i>
                            </a>
                            <form action="{{ route('panel.banners.destroy', [$banner->id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit">
                                    <i class="fa-solid fa-trash admin__table-cell-icon admin__table-cell-icon--red"></i>
                                </button>
                            </form>
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
        {{ $banners->withQueryString()->links() }}
    </div>
@endsection
