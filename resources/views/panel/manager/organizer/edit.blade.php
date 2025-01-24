@extends('layouts.panel', ['section' => 'organizers'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Редактирование заявки на организацию</h2>
    </div>
    <div class="admin__form">
        <div class="admin-content__section">
            <p class="admin-content__section-title">Информация об организаторе</p>
            <div class="admin__form-input-block">
                <div class="admin__form-label-block">
                    <label for="" class="admin__form-label">Тип организатора</label>
                </div>
                <input type="text" name="type" value="{{ $organizerTypes[$organizer->type] }}" id="" class="input admin__form-input" disabled />
            </div>
            <div class="admin__form-input-block">
                <div class="admin__form-label-block">
                    <label for="" class="admin__form-label">ФИО организатора</label>
                </div>
                <input type="text" name="fio" value="{{ $organizer->user->last_name }} {{ $organizer->user->first_name }} {{ $organizer->user->father_name }}" id="" class="input admin__form-input" disabled />
            </div>
            <div class="admin__form-input-block">
                <div class="admin__form-label-block">
                    <label for="" class="admin__form-label">Электронная почта</label>
                </div>
                <input type="email" name="email" value="{{ $organizer->user->email }}" id="" class="input admin__form-input" disabled />
            </div>
            <div class="admin__form-input-block">
                <div class="admin__form-label-block">
                    <label for="" class="admin__form-label">ИНН</label>
                </div>
                <input type="text" name="inn" value="{{ $organizer->inn }}" id="" class="input admin__form-input" />
            </div>
            <div class="admin__form-input-block">
                <div class="admin__form-label-block">
                    <label for="" class="admin__form-label">Номер телефона</label>
                </div>
                <input type="text" name="phone" value="{{ $organizer->phone }}" id="" class="input admin__form-input" />
            </div>
            <div class="admin__form-input-block">
                <div class="admin__form-label-block">
                    <label for="" class="admin__form-label">Дата рождения</label>
                </div>
                <input type="text" name="date_birth" value="{{ \Carbon\Carbon::parse($organizer->date_birth)->format('d.m.Y') }}" id="" class="input admin__form-input" />
            </div>
            @if ($organizer->type == \App\Models\Organizer::UR_PERSON)
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Полное наименование организации</label>
                    </div>
                    <input type="text" name="name" value="{{ $organizer->organizationDetail->name }}" id="" class="input admin__form-input" />
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">E-mail организации</label>
                    </div>
                    <input type="text" name="email" value="{{ $organizer->organizationDetail->email }}" id="" class="input admin__form-input" />
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Телефон организации</label>
                    </div>
                    <input type="text" name="phone" value="{{ $organizer->organizationDetail->ur_phone }}" id="" class="input admin__form-input" />
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Почтовый адрес</label>
                    </div>
                    <input type="text" name="mailing_address" value="{{ $organizer->organizationDetail->mailing_address }}" id="" class="input admin__form-input" />
                </div>
                <div class="admin__form-input-block">
                    <div class="admin__form-label-block">
                        <label for="" class="admin__form-label">Юридический адрес</label>
                    </div>
                    <input type="text" name="legal_address" value="{{ $organizer->organizationDetail->legal_address }}" id="" class="input admin__form-input" />
                </div>
            @endif
        </div>
        <div class="admin-content__section">
            <p class="admin-content__section-title">Подтверждение статуса</p>
            <div class="admin__form-buttons">
                <form action="{{ route('panel.organizers.update', [$organizer->id]) }}" method="post">
                    @csrf
                    @method('patch')
                    <button type="submit" class="button button--blue">Подтвердить</button>
                </form>
                <form action="{{ route('panel.organizers.destroy', [$organizer->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="button button--bg-transparent button--red-border">Отклонить</button>
                </form>
            </div>
        </div>
@endsection
