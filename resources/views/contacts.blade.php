@extends('layouts.main')
@section('content')
    <section class="contacts">
        <div class="section-title-block">
            <h2 class="section-title events__title">Контакты</h2>
        </div>
        <div class="contacts__content">
            <div class="contacts">
                <div class="contact">
                    <i class="contact__icon fa-solid fa-envelope"></i>
                    <p class="contact__text">
                        <span>E-mail: </span><a class="contact__text-link" href="#" class="">mail@eravoices.ru</a>
                    </p>
                </div>
                <div class="contact">
                    <i class="contact__icon fa-solid fa-phone"></i>
                    <p class="contact__text">
                        <span>Телефон: </span><a class="contact__text-link" href="#" class="">+7 (900) 900-00-00</a>
                    </p>
                    
                </div>
                <div class="contact">
                    <i class="contact__icon fa-solid fa-location-dot"></i>
                    <p class="contact__text"><span>Адрес: </span> г. Екатеринбург, ул. Куйбышева, д. 48</p>
                </div>
            </div>
            <ul class="socials contacts__socials">
                <li class="social">
                    <a href="#" class="social__link"><i class="fa-brands fa-vk"></i></a>
                </li>
                <li class="social">
                    <a href="#" class="social__link"><i class="fa-brands fa-youtube"></i></a>
                </li>
                <li class="social">
                    <a href="#" class="social__link"><i class="fa-brands fa-telegram"></i></a>
                </li>
            </ul>
            <div class="contacts__address">
                <iframe 
                    class="contacts__address-iframe" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2183.047333072518!2d60.61533397687528!3d56.82797717350105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43c16e93e747d0a5%3A0x653559d21939beba!2z0YPQuy4g0JrRg9C50LHRi9GI0LXQstCwLCA0OCwg0JXQutCw0YLQtdGA0LjQvdCx0YPRgNCzLCDQodCy0LXRgNC00LvQvtCy0YHQutCw0Y8g0L7QsdC7LiwgNjIwMDI2!5e0!3m2!1sru!2sru!4v1718530686015!5m2!1sru!2sru" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    >
                </iframe>
            </div>
        </div>
    </section>
@endsection
