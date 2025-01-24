@extends('layouts.main', ['title' => 'Заявка для организаторов'])
@section('content')
    <section class="for-organizers">
        <div class="section-title-block">
            <h2 class="section-title for-organizers__title">Организаторам</h2>
        </div>
        <p class="for-organizers__descr">Для того, чтобы стать организатором, заполните следующую форму:</p>
        <form action="{{ route('organizers.store') }}" class="form for-organizers__form" method="post">
            <div class="form__content">
                @csrf
                <h1 class="form__title">Стать организатором</h1>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="phone" class="form__label">Телефон контактного лица</label>
                    </div>
                    <input type="text" name="phone" id="phone" class="input form__input" required />
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="date_birth" class="form__label">Дата рождения</label>
                    </div>
                    <input type="date" name="date_birth" id="date_birth" class="input form__input" required />
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="type" class="form__label">Кем вы являетесь?</label>
                    </div>
                    <select name="type" id="type" class="input form__input" required>
                        <option value="" selected disabled>Физическое или юридическое лицо?</option>
                        @foreach(\App\Models\Organizer::getTypes() as $key => $type)
                            <option value="{{ $key }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form__organizers-section" id="fiz">
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="fiz_inn" class="form__label">ИНН самозанятого</label>
                        </div>
                        <input type="text" name="fiz_inn" id="fiz_inn" class="input form__input" />
                    </div>
                </div>
                <div class="form__organizers-section" id="ur">
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="name" class="form__label">Полное наименование организации (напр. ИП Иванов Иван Иванович)</label>
                        </div>
                        <input type="text" name="name" id="name" class="input form__input" />
                    </div>
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="ur_inn" class="form__label">ИНН организации</label>
                        </div>
                        <input type="text" name="ur_inn" id="ur_inn" class="input form__input" />
                    </div>
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="mailing_address" class="form__label">Почтовый адрес</label>
                        </div>
                        <input type="text" name="mailing_address" id="mailing_address" class="input form__input" />
                    </div>
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="legal_address" class="form__label">Юридический адрес</label>
                        </div>
                        <input type="text" name="legal_address" id="legal_address" class="input form__input" />
                    </div>
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="email" class="form__label">Email для связи</label>
                        </div>
                        <input type="email" name="email" id="email" class="input form__input" />
                    </div>
                    <div class="form__input-block">
                        <div class="form__label-block">
                            <label for="ur_phone" class="form__label">Телефон</label>
                        </div>
                        <input type="text" name="ur_phone" id="ur_phone" class="input form__input" />
                    </div>
                </div>
                <p class="form__policy">Отправляя данную форму, вы даёте своё согласие на обработку данных в соответствии с <a href="{{ route('policy') }}" class="main-link">«Политикой обработки персональных данных»</a>.</p>
                <button type="submit" name="submit" class="button form__button">Подать заявку</button>
            </div>
        </form>
        <div class="for-organizers__message-block">
            <p class="for-organizers__message">Ваша заявка отправлена! Ожидайте звонка менеджера.</p>
        </div>
    </section>
@endsection

@section('js-files')
    <script src="{{ asset('js/for-organizers.js') }}"></script>
@endsection
