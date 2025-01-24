@extends('layouts.main')
@section('content')
    <section class="banners">
        @foreach ($banners as $banner)
            <div class="banner" style="background-image: url({{ $banner->image ? asset('storage/' . $banner->image) : asset('storage/' . $banner->event->image) }})">
                <div class="banner__content">
                    <div class="banner__text">
                        <p class="banner__title">{{ $banner->title }}</p>
                        <p class="banner__descr">{{ $banner->min_descr }}</p>
                        <a href="{{ $banner->link ?? route('event.show', [$banner->event_id]) }}" class="button banner__button">Подробнее</a>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <section class="events main__events">
        <div class="main__events-content">
            <div class="section-title-block">
                <h2 class="section-title events__title">Предстоящие мероприятия</h2>
            </div>
            <div class="events-list">
                @foreach ($events as $event)
                    <a href="{{ route('event.show', ['event' => $event->id]) }}" class="events-list__item">
                        <div class="events-list__item-img-block">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="" class="events-list__item-img" />
                        </div>
                        <p class="events-list__item-name">{{ $event->name }}</p>
                        <p class="events-list__item-date">{{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}</p>
                        <p class="events-list__item-price">{{ $event->prices->min('price_value') }}-{{ $event->prices->max('price_value') }} ₽</p>
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
            <div class="main__events-more">
                <a href="{{ route('event.index') }}" class="main__events-more-button">Все события</a>
            </div>
        </div>
    </section>
@endsection

@section('js-files')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ asset('js/main-slider.js') }}"></script>
@endsection
