@extends('layouts.panel', ['section' => 'events'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Редактирование мероприятия</h2>
    </div>
    <div class="admin__form">
        <form method="post" action="{{ route('panel.events.update', [$event->id]) }}" class="" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <input type="hidden" name="organizer_id" value="{{ $event->organizer_id }}">
            @if ($event->organizer && !(auth()->user()->role === \App\Models\User::ROLE_ORGANIZER))
                <div class="admin-content__section">
                    <p class="admin-content__section-title">Организатор</p>
                    <div class="admin-content__organizer">
                        <p class="admin-content__organizer-info">
                            <span>ФИО организатора:</span> {{ $event->organizer->user->last_name }} {{ $event->organizer->user->first_name }} {{ $event->organizer->user->father_name }}
                        </p>
                        @if ($event->organizer->type === \App\Models\Organizer::UR_PERSON)
                            <p class="admin-content__organizer-info">
                                <span>Полное наименование организации:</span> {{ $event->organizer->organizationDetail->name }}
                            </p>
                        @endif
                    </div>
                </div>
            @endif
            <div class="admin-content__section">
                <p class="admin-content__section-title">Информация о мероприятии</p>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Артист/наименование мероприятия</label>
                    </div>
                    <input type="text" name="name" value="{{ old('name') ?? $event->name }}" id="" class="input admin__form-input" />
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
                                {{ (old('event_status_id') == $category->id || $event->category_id == $category->id) ? 'selected' : '' }}
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
                    <textarea name="descr" id="" rows="5" class="input admin__form-input">{{ old('descr') ?? $event->descr }}</textarea>
                    @error('descr')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Дата мероприятия</label>
                    </div>
                    <input type="date" name="date" value="{{ old('date') ?? \Carbon\Carbon::parse($event->date)->format('Y-m-d') }}" id="" class="input admin__form-input" />
                    @error('date')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Время проведения</label>
                    </div>
                    <input type="time" name="time" value="{{ old('time') ?? \Carbon\Carbon::parse($event->date)->format('H:i') }}" id="" class="input admin__form-input" />
                    @error('time')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Изображение</label>
                    </div>
                    <input type="file" name="image" accept="image/*" id="" class="input admin__form-input" />
                    <div class="admin__form-img-block">
                        <img src="{{ asset('storage/' . $event->image) }}" alt="" class="admin__form-img">
                    </div>
                    @error('image')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                @can('set-manager-fields-for-events')
                    <div class="admin__form-input-block">
                        <div class="admin__form-label-block">
                            <label for="" class="admin__form-label">Статус</label>
                        </div>
                        <select name="event_status_id" id="" class="input admin__form-input">
                            <option value="" selected disabled>Выберите статус</option>
                            @foreach ($eventStatuses as $eventStatus)
                                <option
                                    value="{{ $eventStatus->id }}"
                                    {{ (old('event_status_id') == $eventStatus->id || $event->event_status_id == $eventStatus->id) ? 'selected' : '' }}
                                >
                                    {{ $eventStatus->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('event_status_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                    @if($event->organizer_id)
                        <div class="admin__form-input-block">
                            <div class="admin__form-label-block">
                                <label for="" class="admin__form-label">Процент организатору</label>
                            </div>
                            <input type="number" name="percent" value="{{ old('percent') ?? $event->organizerPercent->percent ?? $defaultPercent }}" id="percent" class="input admin__form-input">
                            @error('percent')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
                @endcan
            </div>
            <div class="admin-content__section">
                <p class="admin-content__section-title">Цены на билеты</p>
                @foreach ($event->prices as $price)
                <div class="admin__form-input-block admin__form-flex-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">{{ $price->zone->name }}</label>
                    </div>
                    <input type="hidden" name="prices[{{ $price->id }}][zone_id]" value="{{ $price->zone_id }}">
                    <input
                        type="number"
                        name="prices[{{ $price->id }}][price_value]"
                        placeholder="Стоимость"
                        value="{{ $price->price_value }}"
                        id=""
                        class="input admin__form-input input--width-150"
                    />
                    @error('name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach
            </div>
            <button type="submit" class="button admin__form-button">Редактировать</button>
        </form>
    </div>
@endsection
