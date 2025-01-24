@extends('layouts.panel', ['section' => 'events'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Добавление мероприятия</h2>
    </div>
    <div class="admin__form">
        <form method="post" action="{{ route('panel.events.store') }}" class="" enctype="multipart/form-data">
            @csrf
            <div class="admin-content__section">
                <p class="admin-content__section-title">Информация о мероприятии</p>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Артист/наименование мероприятия</label>
                    </div>
                    <input type="text" name="name" value="{{ old('name') }}" id="" class="input admin__form-input" />
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Категория</label>
                    </div>
                    <select name="category_id" id="" class="input admin__form-input">
                        <option value="" selected disabled>Выберите категорию</option>
                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Описание</label>
                    </div>
                    <textarea name="descr" id="" rows="5" class="input admin__form-input">{{ old('descr') }}</textarea>
                    @error('descr')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Дата мероприятия</label>
                    </div>
                    <input type="date" name="date" value="{{ old('date') }}" id="" class="input admin__form-input" />
                    @error('date')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Время проведения</label>
                    </div>
                    <input type="time" name="time" value="{{ old('time') }}" id="" class="input admin__form-input" />
                    @error('time')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Изображение</label>
                    </div>
                    <input type="file" name="image" accept="image/*" id="" class="input admin__form-input" required />
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                @can('update-event-status', Auth::user())
                    <div class="admin__form-input-block">
                        <div class="admin__form-label-block">
                            <label for="" class="admin__form-label">Статус</label>
                        </div>
                        <select name="event_status_id" id="" class="input admin__form-input">
                            <option value="" selected disabled>Выберите статус</option>
                            @foreach ($eventStatuses as $eventStatus)
                                <option
                                    value="{{ $eventStatus->id }}"
                                    {{ old('event_status_id') == $eventStatus->id ? 'selected' : '' }}
                                >
                                    {{ $eventStatus->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('event_status_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                @endcan
            </div>
            <div class="admin-content__section">
                <p class="admin-content__section-title">Цены на билеты</p>
                @foreach ($zones as $zone)
                <div class="admin__form-input-block admin__form-flex-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">{{ $zone->name }}</label>
                    </div>
                    <input type="hidden" name="prices[{{ $zone->id }}][zone_id]" value="{{ $zone->id }}">
                    <input type="number" name="prices[{{ $zone->id }}][price_value]" placeholder="Стоимость" value="{{ old("prices.{$zone->id}.price_value") }}" id="" class="input admin__form-input input--width-150" />
                    @error("prices.{$zone->id}.price_value")
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach
            </div>

            <button type="submit" class="button admin__form-button">Добавить</button>
        </form>
    </div>
@endsection
