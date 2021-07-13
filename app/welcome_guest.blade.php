
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title>DMAX-QUEST</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="DMAX-QUEST" />
    <meta name="keywords" content="DMAX-QUEST" />
    <meta name="geo.placename" content="Ташкент, Узбекистан">
    <!-- Информация об авторе -->
    <link rel="me" href="https://dmaxquest.uz" type="text/html">
    <link rel="shortlink" href="https://dmaxquest.uz/" />
    <link rel="canonical" href="https://dmaxquest.uz/" />
    <!-- favicon -->
    <link rel="shortcut icon" href="/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
    <!-- Open Graph -->
    <meta name="og:title" content="dmaxquest - DMAX-QUEST">
    <meta name="og:description" content="DMAX-QUEST">
    <meta name="og:url" content="https://dmaxquest.uz/">
    <meta name="og:image" content="https://dmaxquest.uz/img/og.jpg">
    <meta name="og:site_name" content="DMAX-QUEST - DMAX-QUEST">
    <meta name="og:locale" content="uz_UZ">
    <meta name="og:type" content="website">
    <!-- ios -->
    <link rel="manifest" href="/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="/img/favicon//safari-pinned-tab.svg" color="#ff0000">
    <meta name="apple-mobile-web-app-title" content="DMAX-QUEST">
    <meta name="application-name" content="DMAX-QUEST">
    <!-- style -->
    <link rel="stylesheet" media="all" href="/css/style.css" />
</head>
<body class="guest">

    <main class="global" data-scroll-container>
        
        <div class="loader-background"></div>
        <div class="loader">
            <div class="loader-logo">
                <img src="img/logo-2.svg" alt="">
            </div>
        </div>

        <!-- title -->
        <div>
            <h1 class="pagetitle"></h1>
        </div>

        <!-- top countdown -->
        <div class="countdown__top">
            <div class="container">
                <?php
                $levels = \App\Level::all();
                $now = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', now())->Format('Y-m-d H:i');
                foreach ($levels as $level) {
                    $level->date > $now ? $time[] = $level->date : $time = false;
                    $level->date_end > $now ? $time_end[] = $level->date_end : $time_end = false;
                }

                if ($time){
                    if (min($time)<min($time_end)){
                        $start = min($time);
                        $lvl = \App\Level::where('date', $start)->first();
                        $sf = 1;
                    }else{
                        $start = min($time_end);
                        $lvl = \App\Level::where('date_end', $start)->first();
                        $sf = 2;
                    }
                }elseif($time_end){
                    $start = min($time_end);
                    $lvl = \App\Level::where('date_end', $start)->first();
                    $sf = 2;
                }else{
                    $start = \App\Level::orderBy('date_end', 'desc')->first()->date_end;
                    $lvl = \App\Level::where('date_end', $start)->first();
                    $sf = 2;
                }
                ?>
                <div class="cabinet__step--title">{{ $lvl->level }} {{ __('asd.ЭТАП') }}</div>
                <div class="countdown cabinet__top--countdown">
                    @if($sf == 1)
                        <div class="countdown__title">{{ __('asd.до начало этапа осталось') }}</div>
                    @else
                        <div class="countdown__title">{{ __('asd.до окончания этапа осталось') }}</div>
                    @endif
                    {{--Nov 01 2021--}}
                    <div class="countdown" data-countdown="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $start)->Format('Y/m/d H:i') }}"></div>
                </div>
                <button class="cabinet__top--close" type="button">
                    <img src="/img/top-close.svg" alt="">
                </button>
            </div>
        </div>

        <header class="header">
            <div class="container">
                <a href="/" class="logo"><img src="/img/logo-2.svg" alt=""></a>
                <nav class="nav">
                    <a href="#">Таблица</a>
                    <a href="#">Рейтинг</a>
                    <a href="#">Фото / Видео</a>
                    <a href="#">Карта</a>
                </nav>
                <div class="header__active">
                    <div class="lang">
                        <a @if(session()->get('locale') == 'ru') style="color: #E30613 !important;" @endif href="/languages/ru">RU</a>
                        <a @if(session()->get('locale') == 'uz') style="color: #E30613 !important;" @endif href="/languages/uz">UZ</a>
                    </div>
                </div>
                <div class="header__buttons">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">{{ __('asd.Кабинет') }}</a>
                        @else
                            <a href="{{ route('login') }}">{{ __('asd.ВХОД') }}</a>

                            @if (Route::has('register'))
                                <span></span>
                                <a href="{{ route('register') }}">{{ __('asd.РЕГИСТРАЦИЯ') }}</a>
                            @endif
                        @endauth
                    @endif
                </div>        <!-- burger -->
                <div class="burger">
                    <div class="line"></div>
                    <div class="line"></div>
                </div>

                <!-- mobile menu-->
                <div class="mob-menu">
                    @if(session()->get('locale') == 'ru')
                        <a href="/languages/uz" class="lng">UZ</a>
                    @else
                        <a href="/languages/ru" class="lng">RU</a>
                    @endif
                    <ul class="mob-nav">
                        <li class="menuitem active">
                            <a href="/">Таблица</a>
                        </li>
                        <li class="menuitem">
                            <a href="#">Рейтинг</a>
                        </li>
                        <li class="menuitem">
                            <a href="#">Фото / Видео</a>
                        </li>
                        <li class="menuitem">
                            <a href="#">Карта</a>
                        </li>
                    </ul>
                    <div class="middle">
                        <div class="header__buttons">
                            <a href="{{ route('login') }}">{{ __('asd.ВХОД') }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="bottom">
                        <ul class="social">
                            <li><a href="#"><img src="/img/instagram.png" alt=""></a></li>
                            <li><a href="#"><img src="/img/facebook.png" alt=""></a></li>
                            <li><a href="#"><img src="/img/youtube.png" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- hero -->
        <section class="hero hero-guest">
            <img class="hero__mob" src="/img/mob-hero.jpg" alt="">
            <div class="container">
                <div class="quest-navigation" data-step-navigation="{{ $sf == 1? $lvl->level-1:$lvl->level }}">
                    <div class="navigation">
                        <div class="navigation-car">
                            <img src="/img/car-mini.png" alt="">
                        </div>
                        @php($im_id = null)
                        <div class="navigation-steps">
                            @foreach(\App\Level::orderBy('level', 'asc')->get() as $item)
                                @php($sf == 1? $im_id = $lvl->id-1:$im_id = $lvl->id)
                                <div class="navigation-step @if($item->id == $im_id) finished @endif">
                                    <img src="/img/flag.svg" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="hero__content">
                    <div class="hero__left">
                        <a href="#" class="hero__title">
                            {!! __('asd.КВЕСТ УЧАСТВУЙ ПРИЗ ПИКАП') !!}

                        </a>
                    </div>
                    <div class="hero__right">
                        <div class="hero__rating">
                            <div class="rating__header">
                                <p>Рейтинг</p>
                                <span>топ-3</span>
                            </div>
                            <ul class="rating__content">
                                @foreach(\App\Command::orderBy('point', 'desc')->take(3)->get() as $item)
                                <li class="top top-1">
                                    <div class="info">
                                        <img src="{{ $item->logo }}" alt="">
                                        <div class="name">{{ $item->name }}</div>
                                    </div>
                                    <div class="ball">
                                        @if($loop->first)
                                        <img class="cup" src="/img/cup.svg" alt="">
                                        @endif
                                        @if($loop->iteration == 2)
                                        <img class="cup" src="/img/cup-silver.svg" alt="">
                                        @endif
                                        @if($loop->last)
                                        <img class="cup" src="/img/cup-med.svg" alt="">
                                        @endif
                                        <span>{{ $item->point }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="hero__rating--footer">
                                <a href="#rating"><img src="/img/back-right.svg" alt=""> посмотреть все</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- table team -->
        <section class="table">
            <div class="container">
                <div class="subtitle subtitle--white"><span></span> Таблица команды</div>
                <div class="table__team">
                    <div class="table__header">
                        <h3>Таблица</h3>
                        <p>дата</p>
                        <span>расписание команд</span>
                    </div>
                    <ul class="table__center">
                        @php($k = 1)
                        @foreach(\App\CommandLevel::orderBy('date', 'asc')->where('date', '>', now())->take(2)->get() as $item)
                            <li class="turnire" data-id="{{ $k }}">
                                <div class="left team">
                                    <div class="team__title">{{ \App\Command::find($item->com_1)->name }}</div>
                                    <img src="{{ \App\Command::find($item->com_1)->logo }}" alt="">
                                </div>
                                <div class="center team">
                                    <div class="team__step">{{ \App\Level::find($item->level_id)->level }} этап</div>
                                    <div class="team__date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $item->date)->Format('d.m.Y') }}</div>
                                </div>
                                <div class="right team">
                                    <img src="{{ \App\Command::find($item->com_2)->logo }}" alt="">
                                    <div class="team__title">{{ \App\Command::find($item->com_2)->name }}</div>
                                </div>
                            </li>
                            @php($k++)
                        @endforeach
                        <div id="turnir"></div>

                    </ul>
                    <div class="table__footer">
                        <a href="javascript:;" id="load_more_turnir" class="btn"><span>загрузить ёще</span></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- rating -->
        <section class="rating" id="rating">
            <div class="container">
                <div class="subtitle"><span></span> Рейтинг команды</div>
                <div class="rating__header">
                    <div>Рейтинг</div>
                    <span>топ-20</span>
                </div>
                <div class="rating__table">
                    <table class="ratings" cellpadding="0">
                        <thead>
                        <tr class="rating__row rating__th">
                            <th class="column column-1">№</th>
                            <th class="column column-2"></th>
                            <th class="column column-3">команды</th>
                            <th class="column column-4">побед в сражениях</th>
                            <th class="column column-5">осад выдержано</th>
                            <th class="column column-6">баллов</th>
                        </tr>
                        </thead>
                        @php($i=1)
                        <tbody >
                            @foreach(\App\Command::orderBy('point', 'desc')->take(3)->get() as $item)
                                <tr class="rating__row rating__td" data-id="{{ $i }}">
                                    <td class="column column-1" >{{ $i }}</td>
                                    <td class="column column-2">
                                        @if($loop->first)
                                            <img class="cup" src="/img/flag-gold.svg" alt="">
                                        @endif
                                        @if($loop->iteration == 2)
                                            <img class="cup" src="/img/flag-silver.svg" alt="">
                                        @endif
                                        @if($loop->iteration == 3)
                                            <img class="cup" src="/img/flag-med.svg" alt="">
                                        @endif
                                    </td>
                                    <td class="column column-3">
                                        <div class="rating__team">
                                            <img src="{{ $item->logo }}" alt=""> <div class="rating__title">{{ $item->name }}</div>
                                        </div>
                                    </td>
                                    <td class="column column-4">15</td>
                                    <td class="column column-5">3</td>
                                    <td class="column column-6">{{ $item->point }}</td>
                                </tr>
                                @php($i++)
                            @endforeach
                        <tr id="ratingss"></tr>
                        </tbody>
                    </table>
                </div>
                <div class="rating__footer">
                    <a href="javascript:;" class="btn btn-black" id="load_more_button"><span>загрузить ёще</span></a>
                </div>
            </div>
        </section>

        <section class="usermedia">
            <div class="container">
                <div class="subtitle"><span></span> Фото / Видео</div>
            </div>
            <!-- Slider main container -->
            <div class="usermedia__slider swiper-container">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach(\App\LevelPhoto::orderBy('created_at', 'desc')->where('type', 'photo')->get() as $photo)
                        <div class="swiper-slide">
                            <img src="{{ $photo->media }}" alt="">
                            <div class="usermedia__content">
                                <div class="usermedia__logo">
                                    <img src="{{ \App\Command::where('user_id', $photo->user_id)->first()->logo }}" style="border-radius: 50%" alt="">
                                </div>
                                <span>{{ \App\Command::where('user_id', $photo->user_id)->first()->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- slider -->
        <section class="content__slider">
            <!-- tab -->
            <div class="tab">
                <ul class="tabs">
                    <li><a href="#tab1"><span>{{ __('asd.фото') }}</span></a></li>
                    <li><a href="#tab2"><span>{{ __('asd.видео') }}</span></a></li>
                </ul>

                <div id="tabs__content" class="tab_container">
                    <div id="tab1" class="tab_content">
                        <!-- Slider main container -->
                        <div class="swiper-container slider__tabs slider__photo">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach(\App\LevelPhoto::orderBy('created_at', 'desc')->where('type', 'photo')->get() as $photo)
                                    <div class="swiper-slide">
                                        <div class="slider__tabs-img">
                                            <img src="{{ $photo->media }}" style="width: 400px" class="swiper-lazy" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div id="tab2" class="tab_content">
                        <!-- Slider main container -->
                        <div class="swiper-container slider__tabs slider__video">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach(\App\LevelPhoto::orderBy('created_at', 'desc')->where('type', 'video')->get() as $video)
                                    <div class="swiper-slide">
                                        <div class="slider__tabs-video">
                                            <video id="player" class="lozad js-player" playsinline controls data-poster="">
                                                <source src="{{ $video->media }}" type="video/mp4" />
                                                <!-- <source src="video/video.webm" type="video/webm" /> -->
                                            </video>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="activemap">
            <div class="container">
                <div class="subtitle subtitle--white"><span></span> Карта</div>
                <div class="quest-navigation" data-step-navigation="{{ $lvl->level }}">
                    <div class="navigation">
                        <div class="navigation-car">
                            <img src="/img/car-mini.png" alt="">
                        </div>
                        <div class="navigation-steps">
                            @foreach(\App\Level::orderBy('level', 'asc')->get() as $item)
                                <div class="navigation-step @if($item->id == $lvl->id) finished @endif">
                                    <img src="/img/flag.svg" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="activemap__svg">
                    <img src="/img/activemap.svg" alt="">
                </div>
                <div class="title title--white">Как пользоваться <br> сайтом</div>
            </div>
        </section>

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer__top">
                    <a href="#" class="logo">
                        <img src="/img/logo-2.svg" alt="">
                    </a>
                    <nav class="nav footer__nav">
                        <a href="#">{{ __('asd.О квесте') }}</a>
                        <a href="#">{{ __('asd.Механика') }}</a>
                        <a href="#">{{ __('asd.Создать лого') }}</a>
                        <a href="#">{{ __('asd.Как пользоваться сайтом') }}</a>
                    </nav>
                </div>
                <div class="footer__bottom">
                    <ul class="social social__footer">
                        <li><a href="#"><img src="/img/instagram.png" alt=""></a></li>
                        <li><a href="#"><img src="/img/facebook.png" alt=""></a></li>
                        <li><a href="#"><img src="/img/youtube.png" alt=""></a></li>
                    </ul>
                    <img class="logo-xs" src="/img/logo-2.svg" alt="">
                    <div class="copyright">{{ __("asd.© ИП ООО «ISUZU-RU». Все права защищены. 2021") }}</div>
                    <a href="https://okeyagency.uz" class="footer__dev">
                        <img src="/img/oke.svg" alt="">
                    </a>
                </div>
            </div>
        </footer>
    </main>

    <!-- js -->
    <script type="text/javascript" src="/js/libs.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>

    <script>
        var command = parseInt({{ count(\App\Command::all()) }});
        var turnir = parseInt({{ count(\App\CommandLevel::all()) }});
        $(document).ready(function(){
            $(document).on('click', '#load_more_button', function(){
                var max = 0;
                $('.rating__td').each(function() {
                    var value = parseInt($(this).data('id'));
                    max = (value > max) ? value : max;
                });
                $('#ratingss').load('/command/'+max);
                if(max == command);{
                    // $('#load_more_button').hide()
                }
            });
            $(document).on('click', '#load_more_turnir', function(){
                var max1 = 0;
                $('.turnire').each(function() {
                    var value = parseInt($(this).data('id'));
                    max1 = (value > max1) ? value : max1;
                });
                $('#turnir').load('/turnir/'+max1);
                if(max1 == turnir);{
                    // $('#load_more_turnir').hide()
                }
            });

        });
    </script>

</body>
</html>
