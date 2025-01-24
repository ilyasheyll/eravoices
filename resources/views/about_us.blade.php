@extends('layouts.main')
@section('content')
    <section class="about">
        <div class="section-title-block">
            <h2 class="section-title events__title">О нас</h2>
        </div>
        <div class="about__content">
            <div class="about__section">
                <div class="about__descr">
                    <div class="about__descr-text">
                        <p class="about__paragraph">EraVoices — это <span>культовая</span> концертная площадка, которая с 2010 года радует любителей музыки незабываемыми впечатлениями.</p>
                        <p class="about__paragraph">Вместимостью 2000 человек, EraVoices является <span>идеальным местом</span> для проведения концертов, фестивалей и других мероприятий.</p>
                        <p class="about__paragraph">За свою историю EraVoices приобрела репутацию среди посетителей, артистов и арендаторов благодаря своей <span>первоклассной</span> акустике, <span>впечатляющему</span> световому и звуковому оборудованию и теплой, гостеприимной <span>атмосфере</span>. </p>
                    </div>
                    <div class="about__descr-img-block">
                        <img src="{{ asset('img/about/descr-img.png') }}" alt="" class="about__descr-img">
                    </div>
                </div>
            </div>
            <div class="about__section">
                <p class="about__paragraph">На сцене EraVoices выступали <span>легендарные</span> исполнители, оставившие неизгладимый след в музыкальной индустрии.</p>
                <div class="about__artists">
                    <div class="about__artist">
                        <img src="{{ asset('img/about/artists/pharaoh.png') }}" alt="" class="about__artist-img">
                        <p class="about__artist-name">PHARAOH</p>
                    </div>
                    <div class="about__artist">
                        <img src="{{ asset('img/about/artists/tdd.png') }}" alt="" class="about__artist-img">
                        <p class="about__artist-name">Три дня дождя</p>
                    </div>
                    <div class="about__artist">
                        <img src="{{ asset('img/about/artists/bones.png') }}" alt="" class="about__artist-img">
                        <p class="about__artist-name">BONES</p>
                    </div>
                    <div class="about__artist">
                        <img src="{{ asset('img/about/artists/feduk.png') }}" alt="" class="about__artist-img">
                        <p class="about__artist-name">FEDUK</p>
                    </div>
                </div>
            </div>
            <div class="about__section">
                <p class="about__paragraph">Помимо проведения концертов, EraVoices также предлагает услуги <a href="#" class="about__parapraph-link">аренды</a> для частных мероприятий, корпоративных собраний и других специальных случаев. Команда опытных специалистов площадки готова помочь вам спланировать и провести незабываемое мероприятие, которое превзойдет все ваши ожидания.</p>
                <p class="about__paragraph"><a href="{{ route('event.index') }}" class="about__parapraph-link">Приходите</a> в EraVoices и станьте частью истории. Испытайте магию живой музыки в одном из самых знаковых концертных залов города.</p>
            </div>
        </div>
    </section>
@endsection
