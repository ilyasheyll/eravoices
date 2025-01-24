@extends('layouts.panel', ['section' => 'events'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Мероприятия</h2>
    </div>
    <a href="{{ route('panel.events.create') }}" class="button admin-content__button">Добавить</a>
    <div class="admin-content__sections">
        <div class="admin-content__section">
            <p class="admin-content__section-title">Предстоящие мероприятия</p>
            <div class="events-blocks">
                @forelse ($events->where('event_status_id', \App\Models\EventStatus::ACTIVE_STATUS) as $event)
                    @php
                        $profit = $event->paidTickets()->sum('ticket_price')
                    @endphp
                    <div class="event-block">
                        <div class="event-block__data">
                            <div class="event-block__img-block">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="" class="event-block__img" />
                            </div>
                            <div class="event-block__fields">
                                <p class="event-block__event">{{ $event->name }}</p>
                                <p class="event-block__field">
                                    <span>Категория:</span> {{ $event->category->name }}
                                </p>
                                <p class="event-block__field">
                                    <span>Время проведения:</span> {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}
                                </p>
                                <p class="event-block__field">
                                    <span>Продано билетов:</span> {{ $event->paidTickets()->count() }} шт.
                                </p>
                                <p class="event-block__field">
                                    <span>На сумму:</span> {{ $profit }} ₽
                                </p>
                                <p class="event-block__field">
                                    <span>Конечная прибыль:</span> {{ $profit - $event->organizerSumPercent() }} ₽
                                </p>
                            </div>
                        </div>
                        <div class="event-block__buttons">
                            <a href="{{ route('panel.events.show', [$event->id]) }}" class="button event-block__button button--transparent button--full-width">
                                <i class="event-block__button-icon bi bi-eye"></i>
                                <span class="event-block__button-text">Подробнее</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Не найдено предстоящих мероприятий!</p>
                @endforelse
            </div>
        </div>
        <div class="admin-content__section">
            <p class="admin-content__section-title">Мероприятия в ожидании</p>
            <div class="events-blocks">
                @forelse ($events->whereIn('event_status_id', [
                    \App\Models\EventStatus::CREATED_STATUS,
                    \App\Models\EventStatus::APPROVED_STATUS
                ]) as $event)
                    <div class="event-block">
                        <div class="event-block__data">
                            <div class="event-block__img-block">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="" class="event-block__img" />
                            </div>
                            <div class="event-block__fields">
                                <p class="event-block__event">{{ $event->name }}</p>
                                <p class="event-block__field">
                                    <span>Категория:</span> {{ $event->category->name }}
                                </p>
                                <p class="event-block__field">
                                    <span>Время проведения:</span> {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}
                                </p>
                                <p class="event-block__field">
                                    <span>Статус:</span> {{ $event->status->name }}
                                </p>
                            </div>
                        </div>
                        @if($event->event_status_id === \App\Models\EventStatus::CREATED_STATUS)
                            <div class="event-block__buttons">
                                <a href="{{ route('panel.events.edit', [$event->id]) }}" class="button event-block__button button--full-width button--bg-transparent button--blue-border">
                                    <i class="event-block__button-icon bi bi-pencil"></i>
                                    <span class="event-block__button-text">Редактировать</span>
                                </a>
                                <form method="post" action="{{ route('panel.events.destroy', [$event->id]) }}" class="event-block__button">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="button event-block__button button--full-width button--bg-transparent button--red-border">
                                        <i class="event-block__button-icon bi bi-trash3"></i>
                                        <span class="event-block__button-text">Удалить</span>
                                    </button>
                                </form>
                                {{-- <a href="" class="button event-block__button button--full-width button--bg-transparent button--red-border">
                                    <i class="event-block__button-icon bi bi-trash3"></i>
                                    <span class="event-block__button-text">Удалить</span>
                                </a> --}}
                            </div>
                        @endif
                    </div>
                @empty
                    <p>Не найдено мероприятий в ожидании!</p>
                @endforelse
            </div>
        </div>
        <div class="admin-content__section">
            <p class="admin-content__section-title">Завершённые мероприятия</p>
            <div class="events-blocks">
                @forelse ($events->where('event_status_id', \App\Models\EventStatus::FINISHED_STATUS) as $event)
                    @php
                        $profit = $event->paidTickets()->sum('ticket_price')
                    @endphp
                    <div class="event-block">
                        <div class="event-block__data">
                            <div class="event-block__img-block">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="" class="event-block__img" />
                            </div>
                            <div class="event-block__fields">
                                <p class="event-block__event">{{ $event->name }}</p>
                                <p class="event-block__field">
                                    <span>Категория:</span> {{ $event->category->name }}
                                </p>
                                <p class="event-block__field">
                                    <span>Время проведения:</span> {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}
                                </p>
                                <p class="event-block__field">
                                    <span>Продано билетов:</span> {{ $event->paidTickets()->count() }} шт.
                                </p>
                                <p class="event-block__field">
                                    <span>На сумму:</span> {{ $profit }} ₽
                                </p>
                                <p class="event-block__field">
                                    <span>Конечная прибыль:</span> {{ $profit - $event->organizerSumPercent() }} ₽
                                </p>
                            </div>
                        </div>
                        <div class="event-block__buttons">
                            <a href="{{ route('panel.events.show', [$event->id]) }}" class="button event-block__button button--transparent button--full-width">
                                <span class="event-block__button-text">Подробнее</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Не найдено завершённых мероприятий!</p>
                @endforelse
            </div>
        </div>
        <div class="admin-content__section">
            <p class="admin-content__section-title">Отклонённые мероприятия</p>
            <div class="events-blocks">
                @forelse ($events->where('event_status_id', \App\Models\EventStatus::NOT_APPROVED_STATUS) as $event)
                    <div class="event-block">
                        <div class="event-block__data">
                            <div class="event-block__img-block">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="" class="event-block__img" />
                            </div>
                            <div class="event-block__fields">
                                <p class="event-block__event">{{ $event->name }}</p>
                                <p class="event-block__field">
                                    <span>Категория:</span> {{ $event->category->name }}
                                </p>
                                <p class="event-block__field">
                                    <span>Время проведения:</span> {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Не найдено отклонённых мероприятий!</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
