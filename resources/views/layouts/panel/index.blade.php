<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('fonts/bootstrap-icons/font/bootstrap-icons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/all.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/reset.css') }}" />
        <title>Админ-панель</title>
    </head>
    <body>
        <header class="header">
            <div class="container admin__container">
                <div class="header__top">
                    <a href="{{ route('index') }}" class="header__logo">
                        <img src="{{ asset('img/logo.svg') }}" alt="" class="header__logo-img" />
                    </a>
                    <div class="header__actions">
                        <a href="{{ route('user.index') }}" class="button header__button">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div class="header__burger"><span></span></div>
                    </div>
                </div>
            </div>
        </header>

        <main class="main">
            <div class="container admin__container">
                <div class="admin">
                    <div class="admin-panel">
                        @yield('content')        
                    </div>                
                </div>
            </div>
        </main>

        {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <script src="../js/main.js"></script>
        <script src="../js/admin-products.js"></script> --}}
    </body>
</html>
