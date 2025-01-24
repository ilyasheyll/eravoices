@extends('layouts.main')
@section('content')
    <section class="login">
        <form action="{{ route('register') }}" class="form" method="post" novalidate>
            @csrf
            <h1 class="form__title">Регистрация</h1>
            <div class="form__content">
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="last_name" class="form__label">Фамилия</label>
                    </div>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" id="last_name" class="input form__input" />
                    @error('last_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="first_name" class="form__label">Имя</label>
                    </div>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" id="first_name" class="input form__input" />
                    @error('first_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="father_name" class="form__label">Отчество</label>
                    </div>
                    <input type="text" name="father_name" value="{{ old('father_name') }}" id="father_name" class="input form__input" />
                    @error('father_name')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="email" class="form__label">Электронная почта</label>
                    </div>
                    <input type="email" name="email" value="{{ old('email') }}" id="email" class="input form__input" />
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="login" class="form__label">Пароль</label>
                    </div>
                    <input type="password" name="password" id="password" class="input form__input" />
                    @error('password')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <p class="form__policy">Регистрируясь на сайте, вы даёте своё согласие на обработку данных в соответствии с <a href="{{ route('policy') }}" class="main-link">«Политикой обработки персональных данных»</a>.</p>
                <button type="submit" name="submit" class="button form__button button--full-width">Регистрация</button>
            </div>
            
        </form>
    </section>
@endsection
