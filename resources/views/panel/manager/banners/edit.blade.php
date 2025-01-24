@extends('layouts.panel', ['section' => 'banners'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Редактирование баннера</h2>
    </div>
    <div class="admin__form">
        <form method="post" action="{{ route('panel.banners.update', [$banner->id]) }}" class="" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="banner_img" id="banner_img" value="{{ $banner->image ? asset('/storage/' . $banner->image) : '' }}">
            <div class="admin-content__section">
                <p class="admin-content__section-title">Информация о баннере</p>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="title" class="admin__form-label">Заголовок</label>
                    </div>
                    <input type="text" name="title" maxlength="45" value="{{ old('title') ?? $banner->title }}" id="title" class="input admin__form-input" required />
                    @error('title')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="min_descr" class="admin__form-label">Минимальное описание</label>
                    </div>
                    <textarea class="input admin__form-input" name="min_descr" maxlength="150" id="min_descr" rows="5" required>{{ old('min_descr') ?? $banner->min_descr }}</textarea>
                    @error('min_descr')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Мероприятие</label>
                    </div>
                    <select name="event_id" class="input admin__form-input" id="event-select">
                        <option value="" selected disabled>Выберите мероприятие</option>
                        <option value="">(без мероприятия)</option>
                        @foreach ($nextEvents as $event)
                            <option
                                value="{{ $event->id }}"
                                {{ (old('event_id') == $event->id || $banner->event_id == $event->id) ? 'selected' : '' }}
                            >
                                {{ $event->name }} ({{ $event->date }})
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="image" class="admin__form-label">Изображение (необязательно)</label>
                    </div>
                    <input type="file" name="image" id="image" accept="image/*" class="input admin__form-input">
                    @error('image')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="link" class="admin__form-label">Ссылка (необязательно)</label>
                    </div>
                    <input type="text" name="link" id="link" value="{{ old('link') ?? $banner->link  }}" class="input admin__form-input">
                    @error('link')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="admin__form-input-block admin__form-flex-input-block">
                    <div class="admin__form-label-block">
                        <label for="active" class="admin__form-label">Баннер активен</label>
                    </div>
                    <input type="checkbox" name="active" id="active" {{ (old('active') ?? $banner->active) ? 'checked' : '' }}>
                    @error('active')
                    <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="admin-content__section">
                <p class="admin-content__section-title">Предварительный просмотр</p>
                <div class="admin-content__preview">
                    <div class="banner">
                        <div class="banner__content">
                            <div class="banner__text">
                                <p class="banner__title"></p>
                                <p class="banner__descr"></p>
                                <a href="#" target="_blank" class="button banner__button">Подробнее</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="button admin__form-button">Редактировать</button>
        </form>
    </div>
@endsection

@section('js-files')
    <script src="{{ asset('js/preview-banner.js') }}"></script>
@endsection
