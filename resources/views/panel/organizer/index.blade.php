@extends('layouts.panel', ['section' => 'organizer-info'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Личные данные</h2>
    </div>
    <div class="admin__personal">
        <div class="admin__personal-item">
            <div class="admin__personal-item-content">
                <i class="bi bi-person-fill admin__personal-item-icon"></i>
                <div class="admin__personal-item-data">
                    <p class="admin__personal-item-label">ФИО организатора</p>
                    <p class="admin__personal-item-value">{{ $user->last_name }} {{ $user->first_name }} {{ $user->father_name }}</p>
                </div>
            </div>
        </div>
        <div class="admin__personal-item">
            <div class="admin__personal-item-content">
                <i class="bi bi-envelope-fill admin__personal-item-icon"></i>
                <div class="admin__personal-item-data">
                    <p class="admin__personal-item-label">Электронная почта</p>
                    <p class="admin__personal-item-value">{{ $user->email }}</p>
                </div>
            </div>
        </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-telephone-fill admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Номер телефона</p>
                        <p class="admin__personal-item-value">{{ $organizer->phone }}</p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-calendar-event-fill admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Дата рождения</p>
                        <p class="admin__personal-item-value">
                            {{ \Carbon\Carbon::parse($organizer->date_birth)->format('d.m.Y') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="fa-solid fa-building admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Вид организации</p>
                        <p class="admin__personal-item-value">
                            {{ \App\Models\Organizer::getTypes()[$organizer->type] }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-file-text-fill admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">ИНН</p>
                        <p class="admin__personal-item-value">{{ $organizer->inn }}</p>
                    </div>
                </div>
            </div>
        @if ($organizer->type == \App\Models\Organizer::UR_PERSON)
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="fa-solid fa-briefcase admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Полное наименование организации</p>
                        <p class="admin__personal-item-value">{{ $organizer->organizationDetail->name }}</p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-envelope-fill admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">E-mail организации</p>
                        <p class="admin__personal-item-value">{{ $organizer->organizationDetail->email }}</p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-telephone-fill admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Телефон организации</p>
                        <p class="admin__personal-item-value">{{ $organizer->organizationDetail->ur_phone }}</p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-geo-alt admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Почтовый адрес</p>
                        <p class="admin__personal-item-value">{{ $organizer->organizationDetail->mailing_address }}</p>
                    </div>
                </div>
            </div>
            <div class="admin__personal-item">
                <div class="admin__personal-item-content">
                    <i class="bi bi-geo-alt-fill admin__personal-item-icon"></i>
                    <div class="admin__personal-item-data">
                        <p class="admin__personal-item-label">Юридический адрес</p>
                        <p class="admin__personal-item-value">{{ $organizer->organizationDetail->legal_address }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
