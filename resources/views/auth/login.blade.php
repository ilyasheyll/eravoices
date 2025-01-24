@extends('layouts.main')
@section('content')
    <section class="login">
        <form action="{{ route('login') }}" class="form" method="post">
            @csrf
            <h1 class="form__title">Авторизация</h1>
            <div class="form__content">
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="email" class="form__label">Электронная почта</label>
                    </div>
                    <input type="email" value="{{ old('email') }}" name="email" id="email" class="input form__input" />
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form__input-block">
                    <div class="form__label-block">
                        <label for="login" class="form__label">Пароль</label>
                    </div>
                    <input type="password" name="password" id="password" class="input form__input" />
                </div>
                <p class="form__register-link">Нет аккаунта? <a href="{{ route('register') }}">Регистрация</a></p>
                <button type="submit" name="submit" class="button form__button">Авторизация</button>
            </div>
        </form>
    </section>
@endsection
