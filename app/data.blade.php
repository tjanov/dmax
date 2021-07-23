
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

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

    <style>
        img{border: none;}
        button:focus { outline: none; }
    </style>

</head>
<body>

    <main class="global" data-scroll-container>
        
        <div class="loader-background"></div>
        <div class="loader">
            <div class="loader-logo">
                <img src="img/logo-2.svg" alt="">
            </div>
        </div>

        <section class="cabinet">
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

        @if($lvl->level-1 != 0)
            <!-- top countdown -->
            <div class="countdown__top">
                <div class="container">
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
        @endif

            <?php
                $user = auth()->user();
                $command = \App\Command::where('user_id', $user->id)->first();
            ?>
            <!-- header -->
            <header class="header">
                <div class="container">
                    <!-- logo -->
                    <a href="/" class="logo"><img src="/img/logo-2.png" alt=""></a>

                    <div class="header__active">
                        
                        <!-- go home -->
                        <a class="fpage__header--back go-home --white" href="/">{{ __('asd.на главная') }}</a>
                        <a class="fpage__header--back go-home go-exit --white" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('asd.выход') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                        <!-- lang -->
                        <div class="lang">
                        	<a @if(session()->get('locale') == 'uz') class="is-active" @endif href="/languages/uz">UZ</a>
                            <a @if(session()->get('locale') == 'ru') class="is-active" @endif href="/languages/ru">RU</a>
                        </div>
                        
                        <!-- button notifications -->
                        <button class="notification__btn" type="button">
                            <span class="is-have"></span>
                            <img src="/img/bell.svg" alt="">
                        </button>

                        <!-- user -->
                        <div class="profile">
                            @if($command)
                            <div class="profile-inner">
                                <img class="profile-logo" src="{{ $command->logo }}" alt="">
                                <div class="profile-title">{{ $command->name }}</div>
                            </div>
                            <span class="profile-block">
                                    <img src="/img/cup.svg" alt="">
                                    <span class="profile-ball">{{ $command->point }}</span>
                                </span>
                                @else
                                <button class="usermodal_command_open">{{ __('asd.Создать команду') }}</button>
                                @endif
                        </div>

                    </div>
                </div>
            </header>

            <main class="content">
                <div class="container">

                    <!-- header -->
                    <section class="content__header">
                        @if($command)
                            <div class="content__header--info">
                                <img src="{{ $command->logo }}" alt="">
                                <div class="content__title">{{ $command->name }}</div>
                                <div class="content__deviz">{{ $command->deviz }}</div>
                                <button type="button" class="command-edit usermodal_command_open">
                                    <img src="/img/user-edit.svg" alt="">
                                </button>
                            </div>
                        @else
                            <div class="content__header--info usermodal_command_open">
                                <a class="">
                                	@if(session()->get('locale') == 'uz')
                                    <img class="add-command" src="img/create-command-uz.jpg" alt="">
                                    @else
                                    <img class="add-command" src="img/create-command.jpg" alt="">
                                    @endif
                                </a>
                            </div>
                        @endif

                        {{--<div class="content__header--navigation">--}}
                            {{--{{ \App\Level::find($command->level_id)->level }} Этап  ({{ \App\Level::find($command->level_id)->name }})--}}
                        {{--</div>--}}
                        
                        <div class="content__header--navigation" data-step-navigation="{{ $sf == 1? $lvl->level-1:$lvl->level }}">
                            @if($lvl->level-1 != 0)
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
                            @endif
                        </div>
                        
                        <div class="content__header--navigation" data-step-navigation="1">
                            <div class="navigation">
                                <div class="navigation-car">
                                    <img src="img/car-mini.png" alt="">
                                </div>
                                <div class="navigation-steps">
                                    <div class="navigation-step finished">
                                        <img src="img/flag.svg" alt="">
                                    </div>
                                    <div class="navigation-step">
                                        <img src="img/flag.svg" alt="">
                                    </div>
                                    <div class="navigation-step">
                                        <img src="img/flag.svg" alt="">
                                    </div>
                                    <div class="navigation-step">
                                        <img src="img/flag.svg" alt="">
                                    </div>
                                    <div class="navigation-step">
                                        <img src="img/flag.svg" alt="">
                                    </div>
                                    <div class="navigation-step">
                                        <img src="img/flag.svg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- users -->
                    <section class="users">
                        <div class="user">
                            <div class="user-pic">
                                <style>
                                    .bottom-left {
                                        position: absolute;
                                        bottom: 8px;
                                        left: 16px;
                                    }
                                    .center-block {
                                        background: #96000069;
                                        width: 100%;
                                        height: 100%;
                                        position: absolute;
                                        text-align: center;
                                        color: #ffffff
                                    }
                                </style>
                                @switch($user->active)
                                    @case(1)
                                    <img src="{{ $user->photo }}" alt="">
                                    @break
                                    @case(2)
                                    <p class="center-block"><span style="top: 50%; position: relative;">{!! __('asd.<b>Капитан не принято</b><br>(измените данные капитана)') !!}</span></p>
                                    <img src="{{ $user->photo }}" alt="">
                                    @break
                                    @default

                                    <p class="bottom-left" style="background: #ffffffd1;">{{ __('asd.Капитан ещё не подтвержден') }}</p>
                                    <img src="{{ $user->photo }}" alt="">
                                @endswitch
                                <button type="button" class="user-edit usermodal__{{ $user->id }}_open">
                                    <img src="/img/user-edit.svg" alt="">
                                </button>
                            </div>
                            <div class="user-name">{{ $user->name }} {{ $user->surname }}</div>
                        </div>

                        <?php
                            $profiles = \App\Profile::where('user_id', $user->id)->get();
                        ?>

                        @foreach($profiles as $item)
                                <div class="user">
                                    <div class="user-pic">
                                        <style>
                                            .bottom-left {
                                                position: absolute;
                                                bottom: 8px;
                                                left: 16px;
                                            }
                                            .center-block {
                                                background: #96000069;
                                                width: 100%;
                                                height: 100%;
                                                position: absolute;
                                                text-align: center;
                                                color: #ffffff
                                            }
                                        </style>
                                        @switch($item->active)
                                            @case(1)
                                                <img src="{{ $item->photo }}" alt="">
                                            @break
                                            @case(2)
                                            <p class="center-block"><span style="top: 50%; position: relative;">{!! __('asd.<b>Этот участник не принят</b><br>(измените данные пользователья)') !!}</span></p>
                                            <img src="{{ $item->photo }}" alt="">
                                            @break
                                            @default

                                            <p class="bottom-left" style="background: #ffffffd1;">{{ __('asd.Этот участник ещё не подтвержден') }}</p>
                                            <img src="{{ $item->photo }}" alt="">
                                        @endswitch
                                        <button type="button" class="user-edit usermodal_{{ $item->id }}_open">
                                            <img src="/img/user-edit.svg" alt="">
                                        </button>
                                    </div>
                                    <div class="user-name">{{ $item->name }} {{ $item->surname }}</div>
                                </div>

                        @endforeach
                        @if(count($profiles) < 3)
                        <div class="user">
                            <div class="user-pic usermodal_create_open">
                            	@if(session()->get('locale') == 'uz')
                                <img src="/img/user-add-uz.jpg" alt="">
                                @else
                                <img src="/img/user-add.jpg" alt="">
                                @endif
                            </div>
                            <div class="user-name"></div>
                        </div>
                        @endif
                    </section>

                </div>
            </main>

        </section>

        <!-- slider -->
        <?php
            $count = count(\App\LevelPhoto::where('user_id', auth()->id())->get());
        ?>
        @if($count > 0)
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
                                @foreach(\App\LevelPhoto::where('user_id', auth()->id())->where('type', 'photo')->get() as $photo)
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
                                @foreach(\App\LevelPhoto::where('user_id', auth()->id())->where('type', 'video')->get() as $video)
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
        @endif

        @if($command)
        <?php
            $score = \App\CommandLevel::where('level_id', $command->level_id)->first();
        ?>

        @if(isset($score->com_1) != null || isset($score->com_2) != null)
            @if($score->com_1 == $command->id)
                <?php
                    $com = \App\Command::find($score->com_2);
                ?>
            @else
                <?php
                    $com = \App\Command::find($score->com_1);
                ?>
            @endif
        @endif
        <!-- tasks -->
        <section class="cabinet__task">
            <div class="container">

                <div class="task__column tasks">
                	<div class="user__lock">
                        <img src="/img/lock.svg" alt="">
                    </div>
                    <div class="task__column--title">задания</div>
                    <div class="accordion">
                        <!-- item -->
                        @foreach(\App\Level::all() as $level)
                            @if($command->level_id == $level->id)
                            <?php
                                $sc = 0;
                                $sc1 = \App\CommandLevel::where("level_id", $level->id)->where('com_1', $command->id)->get()->toArray();
                                $sc2 = \App\CommandLevel::where("level_id", $level->id)->where('com_2', $command->id)->get()->toArray();
                                foreach (\App\CommandLevel::where("level_id", $level->id)->where('com_1', $command->id)->get() as $item){
                                    $sc += $item->score_1;
                                }
                                foreach (\App\CommandLevel::where("level_id", $level->id)->where('com_2', $command->id)->get() as $item){
                                    $sc += $item->score_2;
                                }
                            ?>
                                <div class="accordion-item">
                                    <button class="acc-btn" id="accordion-button-1" aria-expanded="false">
                                        <span class="accordion-title">{{ $level->level }} {{ __('asd.ЭТАП') }}</span>
                                        <span class="accordion-ball">{{ $sc }} {{ __('asd.БАЛЛ') }}</span>
                                        <span class="icon" aria-hidden="true"></span>

                                    </button>
                                    <div class="accordion-content">
                                        <div class="tasks__text">
                                            <p>{{ $level->description }}</p>
                                        </div>
                                        <div class="tasks__images">
                                            <img src="{{ $level->photo }}" alt="">
                                        </div>

                                        <div class="tasks__videos">
                                            <video id="player" class="js-player" playsinline controls data-poster="">
                                                <source src="video/333.mov" type="video/quicktime" />
                                                <!-- <source src="video/video.webm" type="video/webm" /> -->
                                            </video>
                                        </div>

                                        <div class="tasks__answer">
                                            <div class="tasks__answer--title">{{ __('asd.Ответы') }}</div>
                                            <hr>
                                            <!-- photo report -->
                                            <div class="tasks__answer--subtitle">{{ __('asd.Фотоотчет') }}</div>
                                            <form class="#fileuploadform" action="/level_photos" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="file" name="files" class="files">
                                                <input type="hidden" name="level_id" value="{{ $level->id }}">
                                                <div class="form__group mt20">
                                                    <button class="btn btn-black" type="submit">
                                                        <span>{{ __('asd.Отправить фото/видео') }}</span>
                                                    </button>
                                                </div>
                                            </form>

                                            <!-- answer -->
                                            <div class="form__answer">
                                                <div class="tasks__answer--subtitle">{{ __('asd.ответ на вопрос') }}</div>
                                                <form id="answerform" method="post" enctype="multipart/form-data">
                                                    <div class="form__group">
                                                        <textarea class="required input" name="tasks__answer" id="" cols="30" rows="10" placeholder="Напишите ответ на вопрос"></textarea>
                                                    </div>
                                                    <div class="form__group">
                                                        <button class="btn btn-black" type="submit">
                                                            <span>{{ __('asd.Отправить ответ') }}</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                @if(isset($score->com_1) != null || isset($score->com_2) != null)

                <div class="task__column enemy">
                	<div class="user__lock">
                        <img src="/img/lock.svg" alt="">
                    </div>
                    <div class="task__column--title">{{ __('asd.Ваш противник') }}</div>
                    <div class="countdown">
                        <div class="countdown__title">{{ __('asd.до встрече вашим противником осталось') }}</div>
                        <div class="countdown" data-countdown="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i', $score->date)->Format('Y/m/d H:i') }}"></div>
                    </div>
                        <div class="enemy-block">
                            <img src="{{ $com->logo }}" alt="">
                            <div class="enemy-text">
                                <div class="enemy-name">{{ $com->name }}</div>
                                <div class="enemy-deviz">{{ $com->deviz }}</div>
                            </div>
                            <div class="enemy-ball">
                                <img src="/img/cup.svg" alt="">
                                <div class="enemy-ball-text">{{ $com->point }}</div>
                            </div>
                        </div>
                        <div class="enemy-users">
                            <?php $profile = \App\Profile::where('user_id', \App\User::find($com->user_id)->id)->get()?>
                            @foreach($profile as $item )
                                <div class="enemy-user"><img src="{{ $item->photo }}" alt=""></div>
                            @endforeach
                        </div>

                </div>
                    @endif
            </div>
        </section>
            @else
            <section class="cabinet__task">
            	    <div class="user__lock">
                        <img src="/img/lock.svg" alt="">
                    </div>
                <div class="container">

                    <div class="task__column tasks">
                        <div class="task__column--title">{{ __('asd.задания') }}</div>
                        <div class="accordion">
                            <!-- item -->
                            @foreach(\App\Level::all() as $level)
                                @if($level->id < 4)
                                    <div class="accordion-item">
                                        <button class="acc-btn" id="accordion-button-1" aria-expanded="false">
                                            <span class="accordion-title">{{ $level->level }} {{ __('asd.ЭТАП') }}</span>
                                            <span class="accordion-ball"></span>
                                            <span class="icon" aria-hidden="true"></span>

                                        </button>
                                        <div class="accordion-content">
                                            <div class="tasks__text">
                                                <p>{{ $level->description }}</p>
                                            </div>
                                            <div class="tasks__images">
                                                <img src="{{ $level->photo }}" alt="">
                                            </div>

                                            <div class="tasks__videos">
                                                <video id="player" class="js-player" playsinline controls data-poster="">
                                                    <source src="video/333.mov" type="video/quicktime" />
                                                    <!-- <source src="video/video.webm" type="video/webm" /> -->
                                                </video>
                                            </div>

                                            <div class="tasks__answer">
                                                <div class="tasks__answer--title">{{ __('asd.Ответы') }}</div>
                                                <hr>
                                                <!-- photo report -->
                                                <div class="tasks__answer--subtitle">{{ __('asd.Фотоотчет') }}</div>
                                                <form class="#fileuploadform" action="/level_photos" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="files" class="files">
                                                    <input type="hidden" name="level_id" value="{{ $level->id }}">
                                                    <div class="form__group mt20">
                                                        <button class="btn btn-black" type="submit">
                                                            <span>{{ __('asd.Отправить фото/видео') }}</span>
                                                        </button>
                                                    </div>
                                                </form>

                                                <!-- answer -->
                                                <div class="form__answer">
                                                    <div class="tasks__answer--subtitle">{{ __('asd.ответ на вопрос') }}</div>
                                                    <form id="answerform" method="post" enctype="multipart/form-data">
                                                        <div class="form__group">
                                                            <textarea class="required input" name="tasks__answer" id="" cols="30" rows="10" placeholder="Напишите ответ на вопрос"></textarea>
                                                        </div>
                                                        <div class="form__group">
                                                            <button class="btn btn-black" type="submit">
                                                                <span>{{ __('asd.Отправить ответ') }}</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="footer__top">
                    <a href="#" class="logo">
                        <img src="img/logo-2.svg" alt="">
                    </a>
                    <nav class="nav footer__nav">
                        <a href="/#about" class="to-anim-about">{{ __('asd.О квесте') }}</a>
                        <a href="/#mexanika" class="to-anim-mexanika">{{ __('asd.Механика') }}</a>
                        <a href="/#create" class="to-anim-create">{{ __('asd.Создать лого') }}</a>
                    </nav>
                </div>
                <div class="footer__bottom">
                    <ul class="social social__footer">
                        <li><a target="_blank" href="https://t.me/samauto_uz">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 300 300" style="enable-background:new 0 0 300 300;" xml:space="preserve"><g><path d="M5.299,144.645l69.126,25.8l26.756,86.047c1.712,5.511,8.451,7.548,12.924,3.891l38.532-31.412 c4.039-3.291,9.792-3.455,14.013-0.391l69.498,50.457c4.785,3.478,11.564,0.856,12.764-4.926L299.823,29.22 c1.31-6.316-4.896-11.585-10.91-9.259L5.218,129.402C-1.783,132.102-1.722,142.014,5.299,144.645z M96.869,156.711l135.098-83.207 c2.428-1.491,4.926,1.792,2.841,3.726L123.313,180.87c-3.919,3.648-6.447,8.53-7.163,13.829l-3.798,28.146 c-0.503,3.758-5.782,4.131-6.819,0.494l-14.607-51.325C89.253,166.16,91.691,159.907,96.869,156.711z"></path></g></svg>
                        </a></li>
                        <li><a target="_blank" href="https://instagram.com/samauto.uz/">
                            <svg viewBox="-21 -21 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg">
                                <path d="m0 132.976562v374.046876c0 73.441406 59.535156 132.976562 132.976562 132.976562h374.046876c73.441406 0 132.976562-59.535156 132.976562-132.976562v-374.046876c0-73.441406-59.535156-132.976562-132.976562-132.976562h-374.046876c-73.441406 0-132.976562 59.535156-132.976562 132.976562zm387.792969 368.359376c-157.855469 54.464843-303.59375-91.273438-249.128907-249.128907 18.351563-53.203125 60.335938-95.191406 113.539063-113.542969 157.859375-54.464843 303.597656 91.273438 249.132813 249.132813-18.351563 53.203125-60.335938 95.1875-113.542969 113.539063zm154.28125-374.859376c-2.511719 13.152344-13.394531 20.804688-24.652344 20.804688-6.851563 0-13.835937-2.828125-19.183594-8.964844-.472656-.542968-.914062-1.125-1.304687-1.730468-5.519532-8.4375-5.691406-18.460938-1-26.589844 3.320312-5.753906 8.679687-9.863282 15.097656-11.582032 6.410156-1.726562 13.113281-.839843 18.859375 2.484376 8.132813 4.6875 12.992187 13.457031 12.4375 23.511718-.039063.6875-.121094 1.386719-.253906 2.066406zm0 0"></path><path d="m320 164.523438c-85.734375 0-155.476562 69.742187-155.476562 155.476562s69.742187 155.476562 155.476562 155.476562 155.476562-69.742187 155.476562-155.476562-69.742187-155.476562-155.476562-155.476562zm0 0"></path>
                            </svg>
                        </a></li>
                        <li><a target="_blank" href="https://facebook.com/samauto.uz/">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 96.124 96.123" style="enable-background:new 0 0 96.124 96.123;" xml:space="preserve"><g><path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803
                            c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654
                            c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246
                            c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z"></path></g></svg>
                        </a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UC_nOhhMXKjRATT9H-4Yw_lA/featured">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 90"><defs/>
                            <path d="M70.94 65.83H66l.02-2.87a2.33 2.33 0 012.33-2.32h.31A2.33 2.33 0 0171 62.96l-.06 2.87zM52.4 59.68c-1.25 0-2.27.85-2.27 1.88V75.5c0 1.03 1.02 1.87 2.27 1.87 1.26 0 2.29-.84 2.29-1.87V61.56c0-1.04-1.03-1.88-2.29-1.88zm30.09-7.8v26.54C82.5 84.8 76.98 90 70.23 90H19.77C13.02 90 7.5 84.79 7.5 78.42V51.88c0-6.37 5.52-11.58 12.27-11.58h50.46c6.75 0 12.27 5.21 12.27 11.58zM23.14 81.3V53.34h6.25V49.2l-16.68-.02v4.07l5.2.02V81.3h5.23zm18.75-23.8h-5.22v14.93c0 2.16.13 3.24 0 3.62-.43 1.16-2.34 2.39-3.08.13-.13-.4-.01-1.6-.02-3.65l-.02-15.03h-5.18l.01 14.8c0 2.26-.05 3.96.02 4.73.13 1.35.08 2.93 1.34 3.84 2.35 1.69 6.84-.25 7.97-2.67l-.01 3.08h4.19V57.52zm16.68 17.1l-.01-12.43c0-4.74-3.55-7.57-8.36-3.74l.02-9.24h-5.2l-.03 31.9 4.28-.06.4-1.99c5.47 5.02 8.9 1.58 8.9-4.44zm16.32-1.65l-3.9.02-.02.53v2.18c0 1.17-.96 2.12-2.14 2.12h-.76a2.14 2.14 0 01-2.14-2.12v-5.74h8.95v-3.37c0-2.46-.06-4.92-.26-6.33-.64-4.45-6.9-5.16-10.05-2.88a5.89 5.89 0 00-2.2 2.94 16.58 16.58 0 00-.66 5.26v7.4c0 12.33 14.97 10.59 13.18-.01zM54.83 32.73c.27.66.69 1.19 1.26 1.59.56.39 1.27.59 2.13.59.75 0 1.42-.2 2-.62a4.8 4.8 0 001.46-1.87l-.1 2.04h5.82V9.74h-4.58v19.24a1.9 1.9 0 01-3.81 0V9.74h-4.78v16.67c0 2.13.04 3.54.1 4.26.07.71.23 1.4.5 2.06zM37.22 18.77c0-2.37.2-4.23.59-5.56A6.2 6.2 0 0139.94 10a6.17 6.17 0 013.95-1.22c1.34 0 2.5.27 3.46.78.96.52 1.7 1.2 2.23 2.03a8 8 0 011.07 2.58c.2.89.3 2.23.3 4.04v6.26c0 2.29-.1 3.98-.28 5.05a8 8 0 01-1.15 3 5.43 5.43 0 01-2.23 2.06c-.92.44-1.97.66-3.16.66a8.76 8.76 0 01-3.36-.57 4.61 4.61 0 01-2.14-1.7 7.6 7.6 0 01-1.1-2.78c-.21-1.08-.32-2.7-.32-4.88v-6.54zm4.55 9.82c0 1.4 1.04 2.54 2.31 2.54s2.3-1.14 2.3-2.54V15.43c0-1.4-1.03-2.54-2.3-2.54-1.27 0-2.31 1.14-2.31 2.54v13.16zm-16.09 6.64h5.49V16.29L37.65.02h-6L28.21 12.1 24.7 0h-5.93l6.9 16.28v18.95z"/>
                            </svg>
                        </a></li>
                    </ul>
                    <img class="logo-xs" src="img/logo-2.svg" alt="">
                    <div class="copyright">{!! __('asd.copyright') !!}</div>
                    <a target="_blank" href="https://samauto.uz/" class="footer__dev">
                        <img src="img/sam.png" alt="">
                    </a>
                </div>
            </div>
        </footer>

    </main>

	<!-- modal -->
	<div id="usermodal__{{ auth()->id() }}">
	    <div class="modal">
	        <button class="usermodal__{{ auth()->id() }}_close modal-close" type="button">
	        	<img src="/img/usermoda-close.svg" alt="">
	        </button>
	
	        <form id="userchange" action="/user/update" method="post" enctype="multipart/form-data">
	            @csrf
	            {{ method_field('PUT') }}
	            <div class="form__group">
	            	<label for="fileInput">{{ __('asd.Ваше фото') }}</label>
		            <div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
		                <img id="image" class="object-cover w-full h-32" src="https://placehold.co/300x300/e2e8f0/e2e8f0" />
		
		                <div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" onClick="document.getElementById('fileInput').click()">
		                    <button type="button" style="background-color: rgba(255, 255, 255, 0.65)" class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm">
		                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
		                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
		                            <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
		                            <circle cx="12" cy="13" r="3" />
		                        </svg>
		                    </button>
		                </div>
		            </div>
		            <input name="photo" id="fileInput" accept="image/*" class="hidden" type="file" onChange="let file = this.files[0];
						var reader = new FileReader();
						reader.onload = function (e) {
							document.getElementById('image').src = e.target.result;
						};
						reader.readAsDataURL(file);
					">
	            </div>
	            <div class="form__group">
	                <label for="name">{{ __('asd.Введите имя') }}</label>
	                <input id="name" name="name" type="text" class="required input" value="{{ auth()->user()->name }}" placeholder="{{ __('asd.Введите имя') }}">
	            </div>
	            <div class="form__group">
	                <label for="name">{{ __('asd.Введите фамилия') }}</label>
	                <input id="name" name="surname" type="text" class="required input" value="{{ auth()->user()->surname }}" placeholder="{{ __('asd.Введите фамилия') }}">
	            </div>
	            <div class="form__group">
	                <button class="btn btn-red" type="submit"><span>{{ __('asd.Сохранить') }}</span></button>
	            </div>
	        </form>
	    </div>
	</div>
	
	<div id="usermodal_create">
	    <div class="modal">
	        <button class="usermodal_create_close modal-close" type="button"><img src="/img/usermoda-close.svg" alt=""></button>
	        <form id="user_create" action="/invite" method="post" enctype="multipart/form-data">
	            @csrf
                <div class="modal-form__before">
                    <div class="modal-form__title">{{ __('asd.Приглашение') }}</div>
                    <div class="form__group">
                        <label for="phone">{{ __('asd.Введите телефон номер') }}</label>
                        <input id="phone" name="phone" type="tel" class="required input" placeholder="{{ __('asd.Tel') }}">
                    </div>
                    <div class="form__group">
                        <button class="btn btn-red" type="submit"><span>{{ __('asd.Пригласить') }}</span></button>
                    </div>
                </div>
                <div class="modal-form__sent">
                    <div class="modal-form__inner">
                        <img src="img/sent.svg" alt="">
                        <div class="modal-form__title">{{ __('Приглашение отправлено!') }}</div>
                    </div>
                </div>
	        </form>
	    </div>
	</div>
	
	<div id="usermodal_command">
	    <div class="modal">
	        <button class="usermodal_command_close modal-close" type="button"><img src="/img/usermoda-close.svg" alt=""></button>
	        @if($command)
	            <form id="userchange" action="/commands/{{ $command->id }}" method="post" enctype="multipart/form-data">
	                @csrf
	                {{ method_field('PUT') }}
	                <div class="form__group">
	                    <label for="name">{{ __('asd.Названия команды') }}</label>
	                    <input id="name" name="name" type="text" class="required input" value="{{ $command->name }}" placeholder="Имя">
	                </div>
	                <div class="form__group">
	                    <label for="name">{{ __('asd.Девиз команды') }}</label>
	                    <textarea name="deviz" class="required input" id="" cols="30" rows="10">{{ $command->deviz }}</textarea>
	                </div>
	                <div class="form__group">
	                    <button class="btn btn-red" type="submit"><span>{{ __('asd.Сохранить') }}</span></button>
	                </div>
	            </form>
	        @else
	        <form id="userchange" action="/commands" method="post" enctype="multipart/form-data">
	            @csrf
				<div class="form__group">
					<label>{{ __('asd.Создать лого') }}</label>
					<a href="/create-logo" class="btn btn-red" type="submit"><span>{{ __('asd.Создать') }}</span></a>	
				</div>
	            <div class="form__group">
	                <label for="name">{{ __('asd.Названия команды') }}</label>
	                <input id="name" name="name" type="text" class="required input" placeholder="Имя">
	            </div>
	            <div class="form__group">
	                <label for="name">{{ __('asd.Девиз команды') }}</label>
	                <textarea name="deviz" class="required input" id="" cols="30" rows="10"></textarea>
	            </div>
	            <div class="form__group">
	                <button class="btn btn-red" type="submit"><span>{{ __('asd.Сохранить') }}</span></button>
	            </div>
	        </form>
	        @endif
	
	    </div>
	</div>

	@foreach($profiles as $item)
	    <div id="usermodal_{{ $item->id }}">
	        <div class="modal">
	            <button class="usermodal_{{ $item->id }}_close modal-close" type="button"><img src="/img/usermoda-close.svg" alt=""></button>
	
	            <form id="userchange" action="/profiles/{{ $item->id }}" method="post" enctype="multipart/form-data">
	                @csrf
	                {{ method_field('put') }}
	                <div class="form__group">
	                    <label>{{ __('asd.Ваше фото') }}</label>
	                    <div class="w-32 h-32 mb-1 border rounded-lg overflow-hidden relative bg-gray-100">
	                        <img id="image" class="object-cover w-full h-32" src="https://placehold.co/300x300/e2e8f0/e2e8f0" />
	
	                        <div class="absolute top-0 left-0 right-0 bottom-0 w-full block cursor-pointer flex items-center justify-center" onClick="document.getElementById('fileInput').click()">
	                            <button type="button" style="background-color: rgba(255, 255, 255, 0.65)" class="hover:bg-gray-100 text-gray-700 font-semibold py-2 px-4 text-sm border border-gray-300 rounded-lg shadow-sm">
	                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-camera" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
	                                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
	                                    <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
	                                    <circle cx="12" cy="13" r="3" />
	                                </svg>
	                            </button>
	                        </div>
	                    </div>
	                    <input name="photo" id="fileInput" accept="image/*" class="hidden" type="file" onChange="let file = this.files[0];
	                        var reader = new FileReader();
	                        reader.onload = function (e) {
	                            document.getElementById('image').src = e.target.result;
	                        };
	                        reader.readAsDataURL(file);
	                    ">
	                </div>
	                <div class="form__group">
	                    <label for="name">{{ __('asd.Введите имя') }}</label>
	                    <input id="name" name="name" type="text" class="required input" value="{{ $item->name }}" placeholder="{{ __('asd.Введите имя') }}">
	                </div>
	                <div class="form__group">
	                    <label for="name">{{ __('asd.Введите фамилия') }}</label>
	                    <input id="name" name="surname" type="text" class="required input" value="{{ $item->surname }}" placeholder="{{ __('asd.Введите фамилия') }}">
	                </div>
	                <div class="form__group">
	                    <button class="btn btn-red" type="submit"><span>{{ __('asd.Сохранить') }}</span></button>
	                </div>
	            </form>
	        </div>
	    </div>
	@endforeach

	<div class="notifications">
	    <div class="notifications__top">
	        <div class="notifications__toptitle">{{ __('asd.Оповещения') }}</div>
	        <button class="notifications__close" type="button"><img src="img/usermoda-close.svg" alt=""></button>
	    </div>
	    <div class="notifications__content">
	        @if($command)
	        @foreach(\App\MessageToCommand::where('command_id', $command->id)->get() as $item)
	            <div class="notifications__item">
	                <div class="notifications__date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->Format('d.m.Y') }}</div>
	                <div class="notifications__title">{{ $item->name }}</div>
	                <div class="notifications__text">{{ $item->message }}</div>
	                <!-- <button class="notifications__collape"><img src="img/not-arrow-down.svg" alt=""></button> -->
	            </div>
	        @endforeach
	        @endif
	
	    </div>
	</div>

	<!-- js -->
	<script type="text/javascript" src="https://cdn.plrjs.com/player/zh26b3e4db756/fskmcfbi1ka7.js"></script>
	<script type="text/javascript" src="/js/libs.js"></script>
	<script type="text/javascript" src="/js/app.js"></script>
	
	<script>
		// form user invite
		$('#user_create').on('submit', function() {
		    $.ajax({
		        type: 'POST',
		        url: '/invite',
		        data: $('#user_create').serialize(),
		        success: function() {
		            setTimeout(function() {
		                $('.modal-form__sent').addClass('is-active')
		            }, 2e3);
		        }
		    });
		    return false;
		})
		
		$('.usermodal_create_close').on('click',function() {
		    $('.modal-form__sent').removeClass('is-active')
		})

	    @foreach($profiles as $item)
	        $('#usermodal_{{ $item->id }}').popup({
	            escape: false,
	            blur: false,
	            scrolllock: true,
	            transition: 'all 0.3s'
	        });
	    @endforeach
	
	    $('#usermodal__{{ auth()->id() }}').popup({
	        escape: false,
	        blur: false,
	        scrolllock: true,
	        transition: 'all 0.3s'
	    });
	
	    $('#usermodal_create').popup({
	        escape: false,
	        blur: false,
	        scrolllock: true,
	        transition: 'all 0.3s'
	    });
	    $('#usermodal_command').popup({
	        escape: false,
	        blur: false,
	        scrolllock: true,
	        transition: 'all 0.3s'
	    });
	</script>
	<script>
	window.replainSettings = { id: '11098f24-5bf2-45f4-98fa-068a588cc29d' };
	(function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
	var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
	})('https://widget.replain.cc/dist/client.js');
	</script>

</body>
</html>
