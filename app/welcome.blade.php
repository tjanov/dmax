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
    <meta name="msapplication-TileColor" content="#fff">
    <meta name="theme-color" content="#fff" />
    <!-- Open Graph -->
    <meta name="og:title" content="dmaxquest - DMAX-QUEST">
    <meta name="og:description" content="DMAX-QUEST">
    <meta name="og:url" content="https://dmaxquest.uz/">
    <meta name="og:image" content="https://dmaxquest.uz/img/og.jpg">
    <meta name="og:site_name" content="DMAX-QUEST - DMAX-QUEST">
    <meta name="og:locale" content="uz_UZ">
    <meta name="og:type" content="website">
    <!-- ios -->
    <!--     <link rel="manifest" href="/img/favicon/site.webmanifest">
        <link rel="mask-icon" href="/img/favicon//safari-pinned-tab.svg" color="#ffcd79">
        <meta name="apple-mobile-web-app-title" content="DMAX-QUEST">
        <meta name="application-name" content="DMAX-QUEST"> -->
    <!-- style -->
    <link rel="stylesheet" media="all" href="/css/style.css" />
</head>
<body>

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

        <header class="header">
            <div class="container">
                <a href="/" class="logo"><img src="/img/logo.svg" alt=""></a>
                <nav class="nav">
                    <a href="" class="to-anim-about">{{ __('asd.О квесте') }}</a>
                    <a href="" class="to-anim-mexanika">{{ __('asd.Механика') }}</a>
                    <a href="" class="to-anim-create">{{ __('asd.Создать лого') }}</a>
                    <a href="" class="to-anim-how">{{ __('asd.Как пользоваться сайтом') }}</a>
                </nav>
                <div class="header__active">
                    <div class="lang">
                        <a @if(session()->get('locale') == 'ru') class="is-active" @endif href="/languages/ru">RU</a>
                        <a @if(session()->get('locale') == 'uz') class="is-active" @endif href="/languages/uz">UZ</a>
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
                </div>
                <!-- burger -->
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
                            <a href="" class="tp-anim-about">{{ __('asd.О квесте') }}</a>
                        </li>
                        <li class="menuitem">
                            <a href="" class="tp-anim-mexanika">{{ __('asd.Механика') }}</a>
                        </li>
                        <li class="menuitem">
                            <a href="" class="tp-anim-create">{{ __('asd.Создать лого') }}</a>
                        </li>
                        <li class="menuitem">
                            <a href="" class="tp-anim-how">{{ __('asd.Как пользоваться сайтом') }}</a>
                        </li>
                    </ul>
                    <div class="middle">
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
                        </div>
                    </div>
                    <hr>
                    <div class="bottom">
                        <ul class="social">
                            <li><a target="_blank" href="https://instagram.com/samauto.uz/"><img src="img/instagram.png" alt=""></a></li>
                            <li><a target="_blank" href="https://facebook.com/samauto.uz/"><img src="img/facebook.png" alt=""></a></li>
                            <li><a target="_blank" href="https://t.me/samauto_uz"><img src="img/telegram.svg" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- hero -->
        <section class="hero">
            <img class="hero__mob" src="/img/mob-hero.jpg" alt="">
            <div class="container">
                <div class="hero__title">
                    <div>Travel-квест</div>
                    <div>Главный приз — <br>пикап ISUZU D-Max</div>
                </div>
                {{--<a href="#" class="hero__title">--}}
                    {{--{!! __('asd.КВЕСТ УЧАСТВУЙ ПРИЗ ПИКАП') !!}--}}
                {{--</a>--}}
                
                <div class="herocount">
                    <div class="herocount__title">{{ __('asd.до регистрации осталось') }}</div>
                    <div class="countdown" data-countdown="2021/08/01"></div>
                </div>

                <div class="hero__active">
                    <a href="{{ route('register') }}" target="_blank" class="btn btn-red"><span>{{ __('asd.Успей участвовать') }}</span></a>
                    <a data-fancybox href="https://www.youtube.com/watch?v=JGeOroGUazw" class="btn btn-black"><span>{{ __('asd.посмотреть видео') }}</span></a>
                </div>
                
                <a target="_blank" href="https://samauto.uz/transport/pickupitem/32" class="btn-link">
                    <span class="btn-link__text">Узнать подробнее o пикапе d-max</span>
                    <span class="btn-link__circle">
                        <span class="btn-link__border"></span>
                        <span class="btn-link__arrow">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.25 9.75V3.75H8.25" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M14.25 3.75L3.75 14.25" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </span>
                    </span>
                </a>

            </div>
        </section>

        <section id="about" class="about">
            <div class="container">
                <div class="inview-fade-in-up-group" data-scroll data-scroll-offset="50%, 0">
                <div class="subtitle subtitle--white"><span></span> {{ __('asd.О квесте') }}</div>
                <div class="about__block">
                        <div class="about__left inview-fade-in-up-element delay01">
                        <img src="img/about.jpg" alt="">
                    </div>
                    <div class="about__right">
                        <div class="about__title inview-fade-in-up-element delay02">{{ __('asd.о нас') }}</div>
                        <div class="about__text inview-fade-in-up-element delay02">
                            <p>Маршрут travel-квеста от SamAuto охватит всю страну. Участники будут выполнять увлекательные задания, разгадывать головоломки и открывать для себя живописные, малоизвестные локации.</p>
                        </div>
                        <div class="about__img inview-fade-in-up-element delay02">
                            <img src="img/about.jpg" alt="">
                        </div>
                    </div>
                </div>
                <div class="about__block about__bottom inview-fade-in-up-group" data-scroll data-scroll-offset="50%, 0">
                    <div class="about__right">
                        <div class="about__title inview-fade-in-up-element delay01">{{ __('asd.правила') }}</div>
                        <ul>
                            <li class="inview-fade-in-up-element delay01">
                                <div class="about__list--num">01</div>
                                <div class="about__list--text">Соберите команду из 4 человек, зарегистрируйте её на сайте <a target="_blank" href="https://dmaxquest.uz/">https://dmaxquest.uz/</a>, путешествуйте по Узбекистану, разгадайте загадки и выиграйте красный ISUZU D-Max.</div>
                            </li>
                        </ul>
                    </div>
                    <div class="about__left inview-fade-in-up-element delay02">
                        <img src="img/about.jpg" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="mexanika" class="mexanika">
            <div class="container">
                <div class="subtitle"><span></span> {{ __('asd.механика') }}</div>
            </div>
            <img class="mex__img" src="/img/mex.svg" alt="">
            <div class="container mex">
                <div class="mex__list">
                    @foreach(\App\Level::orderBy('level', 'asc')->get() as $item)
                        @if($item->id < 4)
                        <div class="mex__item">
                            <div class="mex__num">{{ $item->level }}</div>
                            <div class="mex__subtext">{{ __('asd.этап') }}</div>
                            <div class="mex__text">{{ $item->description }}</div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <!-- create logo -->
        <section id="create" class="createlogo inview-fade-in-up-group" data-scroll data-scroll-offset="50%, 0">
            <div class="container">
                <div class="subtitle subtitle--white inview-fade-in-up-element delay01"><span></span> {{ __('asd.создать лого') }}</div>
                <div class="createlogo__block">
                    <div class="createlogo__left inview-fade-in-up-element delay02">
                        <div class="title title--white">{!! __('asd.создай <br>себе команду') !!}</div>
                        <p>Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь.</p>
                        <a href="{{ route('register') }}" class="btn"><span>{{ __('asd.попробовать') }}</span></a>
                    </div>
                    <div class="createlogo__right inview-fade-in-up-element delay03">
                        <img src="/img/create-small.png" alt="">
                        <img class="big" src="/img/create-big.png" alt="">
                        <img src="/img/create-small-2.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- video instruction -->
        <section id="how" class="instruction inview-fade-in-up-group" data-scroll data-scroll-offset="50%, 0">
            <img class="instruction-img-lg" src="img/instruktor.jpg" alt="">
            <img class="instruction-img-xs" src="img/mob-instruktor.jpg" alt="">
            <div class="instruction__content">
                <div class="subtitle subtitle--white inview-fade-in-up-element delay01"><span class="--white"></span> {{ __('asd.инструкция') }}</div>
                <div class="title title--white inview-fade-in-up-element delay03">{!! __('asd.Как пользоваться <br> сайтом') !!}</div>
                <a data-fancybox href="https://www.youtube.com/watch?v=JGeOroGUazw" class="btn-play btn-cirle btn-red inview-fade-in-up-element delay03">
                    <span>play</span>
                </a>
            </div>
        </section>

        <!-- are you ready -->
        <section class="youready inview-fade-in-up-group" data-scroll data-scroll-offset="50%, 0">
            <div class="container">
                <div class="title youready__title inview-fade-in-up-element delay01">{!! __('asd.Ну что, готов? <br>Успей зарегистрироваться') !!}</div>
                <div class="countdown inview-fade-in-up-element delay02">
                    <div class="countdown" data-countdown="2021/08/01 15:00"></div>
                </div>
                <a href="{{ route('register') }}" class="btn inview-fade-in-up-element delay03"><span>{{ __('asd.Успей участвовать') }}</span></a>
            </div>
        </section>

        <!-- faq -->
        <section class="faq inview-fade-in-up-group" data-scroll data-scroll-offset="50%, 0">
            <div class="container">
                <div class="subtitle inview-fade-in-up-element delay01"><span class="sqr sqr-blck"></span> {{ __('asd.FAQ') }}</div>
                <div class="title inview-fade-in-up-element delay02">{{ __('asd.ОСТАЛИСЬ ВОПРОСЫ?') }}</div>
                <div class="faq__block inview-fade-in-up-element delay03">
                    <div class="accordion">
                        <!-- item -->
                        <div class="accordion-item">
                            <button class="acc-btn" aria-expanded="false">
                                <span class="accordion-title">Команда может быть из любого города?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>Да, выполнять задания travel-квеста можно из любой точки Узбекистана. Локации с заданиями распределены по всей республике.</p>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="accordion-item">
                            <button class="acc-btn" aria-expanded="false">
                                <span class="accordion-title">Какой именно пикап ISUZU D-Max разыгрывается?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>Призом станет пикап ISUZU D-Max Irbis красного цвета. Это модель c двухрядной кабиной, 5 посадочными местами, объёмом двигателя 3 литра и автоматической коробкой передач. Организаторы берут на себя оплату налога на доходы физических лиц, который возникает при получении приза.</p>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="accordion-item">
                            <button class="acc-btn" aria-expanded="false">
                                <span class="accordion-title">Есть ли вступительные взносы?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>Нет, участие в D-MAX квесте бесплатно на всех этапах. Главное успеть собрать команду и <a target="_blank" href="/register">зарегистрироваться</a> (до 30 июля 23:59 включительно). Однако участники будут самостоятельно нести расходы на топливо и т.д. </p>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="accordion-item">
                            <button class="acc-btn" aria-expanded="false">
                                <span class="accordion-title">Обязательно ли иметь машину?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>Нет. Способ передвижения выбирают сами участники квеста. Вы можете добираться до заданных точек на поезде, самолёте, такси, попутных машинах, даже арендовать автомобиль и т д.
                                    <br>
                                    Чтобы выиграть автомобиль – необязательно иметь автомобиль.</p>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="accordion-item">
                            <button class="acc-btn" aria-expanded="false">
                                <span class="accordion-title">Головоломки, задания сложные? </span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>Нет, будет весело, интересно и местами даже захватывающе! </p>
                            </div>
                        </div>
                        <!-- item -->
                        <div class="accordion-item">
                            <button class="acc-btn" aria-expanded="false">
                                <span class="accordion-title">В какое время будут проходить соревнования? </span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p>Задания группового и финального этапов нужно будет выполнять раз в две недели. Мы заботимся о том, чтобы вы успели отдохнуть и посвятить время себе.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <a href="" class="to-anim-about">{{ __("asd.О квесте") }}</a>
                        <a href="" class="to-anim-mexanika">{{ __("asd.Механика") }}</a>
                        <a href="" class="to-anim-create">{{ __('asd.Создать лого') }}</a>
                        <a href="" class="to-anim-how">{{ __('asd.Как пользоваться сайтом') }}</a>
                    </nav>
                </div>
                <div class="footer__bottom">
                    <ul class="social social__footer">
                        <li><a target="_blank" href="https://instagram.com/samauto.uz/"><img src="img/instagram.png" alt=""></a></li>
                        <li><a target="_blank" href="https://facebook.com/samauto.uz/"><img src="img/facebook.png" alt=""></a></li>
                        <li><a target="_blank" href="https://t.me/samauto_uz"><img src="img/telegram.svg" alt=""></a></li>
                    </ul>
                    <img class="logo-xs" src="/img/logo-2.svg" alt="">
                    <div class="copyright">{{ __('asd.© ИП ООО «ISUZU-RU». Все права защищены. 2021') }}</div>
                    <div class="footer__dev">
                        <img src="/img/oke.svg" alt="">
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- js -->
    <script type="text/javascript" src="/js/libs.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>

</body>
</html>
