@extends('layouts.main', ['title' => 'Афиша'])
@section('content')
    <section class="concerts">
        <div class="section-title-block">
            <h2 class="section-title concerts__title">Афиша</h2>
        </div>
        <div class="concerts__content">
            <div class="concerts__filters">
                <form action="" method="GET" class="concerts__filters-form">
                    <div class="concerts__filter">
                        <button type="button" class="concerts__filter-category">
                            <p class="concerts__filter-category-name">Категория</p>
                            <i class="concerts__filter-category-chevron fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="concerts__filter-values">
                            <div class="concerts__filter-indent"></div>
                            @foreach ($categories as $category)
                                <div class="concerts__filter-value">
                                    <input type="radio" value="{{ $category->id }}" class="concerts__filter-value-checkbox" name="category_id" id="category-{{ $category->id }}" />
                                    <label for="category-{{ $category->id }}" class="concerts__filter-value">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="concerts__filter">
                        <button type="button" class="concerts__filter-category">
                            <p class="concerts__filter-category-name">Стоимость</p>
                            <i class="concerts__filter-category-chevron fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="concerts__filter-values">
                            <div class="concerts__filter-indent"></div>
                            <div class="concerts__filter-value">
                                <label for="" class="concerts__filter-value-label">Начальная стоимость</label>
                                <div class="concerts__filter-input-block">
                                    <input type="number" name="min_price" class="input concerts__filter-input input--white-transparent input--border-bottom" />
                                </div>
                            </div>
                            <div class="concerts__filter-value">
                                <label for="" class="concerts__filter-value-label">Конечная стоимость</label>
                                <div class="concerts__filter-input-block">
                                    <input type="number" name="max_price" class="input concerts__filter-input input--white-transparent input--border-bottom" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="concerts__filter">
                        <button type="button" class="concerts__filter-category">
                            <p class="concerts__filter-category-name">Дата проведения</p>
                            <i class="concerts__filter-category-chevron fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="concerts__filter-values">
                            <div class="concerts__filter-indent"></div>
                            <div class="concerts__filter-value">
                                <label for="" class="concerts__filter-value-label">Начальная дата</label>
                                <div class="concerts__filter-input-block">
                                    <input type="date" name="start_date" class="input concerts__filter-input input--white-transparent input--border-bottom" />
                                </div>
                            </div>
                            <div class="concerts__filter-value">
                                <label for="" class="concerts__filter-value-label">Конечная дата</label>
                                <div class="concerts__filter-input-block">
                                    <input type="date" name="end_date" class="input concerts__filter-input input--white-transparent input--border-bottom" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button concerts__filter-button button--transparent button--full-width">Фильтровать</button>
                </form>
            </div>
            <div class="concerts__items">
                @if ($events->count() > 0)
                    <div class="events-list">
                        @foreach ($events as $event)
                            <a href="{{ route('event.show', ['event' => $event->id]) }}" class="events-list__item">
                                <div class="events-list__item-img-block">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="" class="events-list__item-img" />
                                </div>
                                <p class="events-list__item-name">{{ $event->name }}</p>
                                <p class="events-list__item-date">{{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}</p>
                                <p class="events-list__item-price">
                                    {{ $event->prices->min('price_value') }}-{{ $event->prices->max('price_value') }} ₽
                                </p>
                                <button class="button events-list__item-button button--full-width">Подробнее</button>
                                @auth
                                    @if (!Auth::user()->favorites->contains('event_id', $event->id))
                                        <form method="post" action="{{ route('favorites.store') }}" class="events-list__item-favorite">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <button type="submit" class="events-list__item-favorite-button">
                                                <i class="events-list__item-favorite-icon fa-solid fa-heart"></i>
                                            </button>
                                        </form>
                                    @else
                                        <form
                                            method="POST"
                                            action="{{ route('favorites.destroy', [Auth::user()->favorites->where('event_id', $event->id)->first()->id]) }}"
                                            class="events-list__item-favorite"
                                        >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="events-list__item-favorite-button events-list__item-favorite-button--red">
                                                <i class="events-list__item-favorite-icon fa-solid fa-heart"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </a>
                        @endforeach
                    </div>
                @else
                    <p>Не найдено мероприятий по вашему запросу!</p>
                @endif
                <div class="page-links concerts__page-links">
                    {{ $events->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js-files')
    <script src="{{ asset('js/events.js') }}"></script>
@endsection
