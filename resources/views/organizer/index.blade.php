@extends('layouts.main', ['title' => 'Стать организатором'])
@section('content')
    <section class="organizers">
        <div class="section-title-block">
            <h2 class="section-title">Организаторам</h2>
        </div>
        <p class="organizers__text">
            <p class="organizers__paragraph">На нашем сайте вы можете оставить заявку на проведение своего мероприятия.</p>
            <p class="organizers__paragraph">Чтобы оставить заявку, вам необходимо <a class="main-link" href="{{ route('login') }}">авторизоваться</a> на сайте и заполнить <a class="main-link" href="{{ route('organizers.create') }}">форму</a>. После этого вы сможете отслеживать количество проданных билетов на свои мероприятия и сумму денег, полученную от их продажи.</p>
            <p class="organizers__paragraph">Мы рады предложить вам наш концертный зал для организации вашего мероприятия. Мы уверены, что наше сотрудничество будет успешным и плодотворным.</p>
        </p>
    </section>
@endsection