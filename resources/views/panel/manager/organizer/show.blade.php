@extends('layouts.panel', ['section' => 'organizers'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">
            Организатор: {{ $organizer->user->last_name }} {{ $organizer->user->first_name }} {{ $organizer->user->father_name }}
        </h2>
    </div>
    <div class="admin-content__section">
        <p class="admin-content__section-title">Данные организатора</p>
        <div class="admin-event__data">
            <div class="admin-event__fields">
                <div class="admin-event__field">
                    <p class="admin-event__field-label">Электронная почта</p>
                    <p class="admin-event__field-value">{{ $organizer->user->email }}</p>
                </div>
                <div class="admin-event__field">
                    <p class="admin-event__field-label">Номер телефона</p>
                    <p class="admin-event__field-value">{{ $organizer->phone }}</p>
                </div>
                <div class="admin-event__field">
                    <p class="admin-event__field-label">Дата рождения</p>
                    <p class="admin-event__field-value">
                        {{ \Carbon\Carbon::parse($organizer->date_birth)->format('d.m.Y') }}
                    </p>
                </div>
                <div class="admin-event__field">
                    <p class="admin-event__field-label">Тип организатора</p>
                    <p class="admin-event__field-value">{{ $organizerTypes[$organizer->type] }}</p>
                </div>
                <div class="admin-event__field">
                    <p class="admin-event__field-label">ИНН</p>
                    <p class="admin-event__field-value">{{ $organizer->inn }}</p>
                </div>
                @if ($organizer->type == \App\Models\Organizer::UR_PERSON)
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Полное наименование организации</p>
                        <p class="admin-event__field-value">{{ $organizer->organizationDetail->name }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">E-mail организации</p>
                        <p class="admin-event__field-value">{{ $organizer->organizationDetail->email }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Телефон организации</p>
                        <p class="admin-event__field-value">{{ $organizer->organizationDetail->ur_phone }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Почтовый адрес</p>
                        <p class="admin-event__field-value">{{ $organizer->organizationDetail->mailing_address }}</p>
                    </div>
                    <div class="admin-event__field">
                        <p class="admin-event__field-label">Юридический адрес</p>
                        <p class="admin-event__field-value">{{ $organizer->organizationDetail->legal_address }}</p>
                    </div>
                @endif
                <div class="admin-event__field">
                    <p class="admin-event__field-label">Проведено мероприятий</p>
                    <p class="admin-event__field-value">
                        {{ $organizer->events->where('event_status_id', \App\Models\EventStatus::FINISHED_STATUS)->count() }}
                    </p>
                </div>
                <div class="admin-event__field">
                    <p class="admin-event__field-label">Выручка с мероприятий</p>
                    <p class="admin-event__field-value">{{ $organizer->getProfitForEvents() }} руб.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="admin-content__section">
        <p class="admin-content__section-title">Все мероприятия</p>
        <div class="admin-event__tickets">
            @foreach ($organizer->events->sortBy(['updated_at', 'desc']) as $event)
                <div class="event-block">
                    <div class="event-block__data">
                        <div class="event-block__img-block">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="" class="event-block__img" />
                        </div>
                        <div class="event-block__fields">
                            <p class="event-block__event">{{ $event->name }}</p>
                            <p class="event-block__field">
                                <span>Статус:</span> {{ $event->status->name }}
                            </p>
                            <p class="event-block__field">
                                <span>Категория:</span> {{ $event->category->name }}
                            </p>
                            <p class="event-block__field">
                                <span>Время проведения:</span> {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i:s') }}
                            </p>
                            @if (in_array($event->status->id, [
                                \App\Models\EventStatus::ACTIVE_STATUS,
                                \App\Models\EventStatus::FINISHED_STATUS
                            ]))
                                <p class="event-block__field">
                                    <span>Продано билетов:</span> {{ $event->paidTickets()->count() }} шт.
                                </p>
                                <p class="event-block__field">
                                    <span>На сумму:</span> {{ $event->paidTickets()->sum('ticket_price') }} ₽
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
