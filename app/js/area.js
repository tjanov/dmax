document.querySelector('#tel').addEventListener('blur', (event) => {
    let err = document.querySelector(".error-messg");
    err.innerText = "";
    try {

        //if field empty
        if(event.target.validity.valueMissing)
            throw event.target.validationMessage;
        
        else {
            event.target.style.borderColor  = 'green';
            err.innerText = "";
        }
    }

    catch(messg) {
        err.innerText = messg;
        event.target.style.borderColor = '#E30613';
    }
    
});

//adding to password field
document.querySelector("#password").addEventListener('blur', validatePassword);

//password validation
function validatePassword(event) {
    let error = event.target.nextElementSibling;
    // $('#parent').append('<span class="error-messg"></span>');
    error.innerText = "";
    event.target.style.border = "3px solid #E30613";

    try {
        console.log((event.target.value));
        if(event.target.validity.valueMissing)
            throw event.target.validationMessage;

        else if(!(/[0-9]{4,}/g).test(event.target.value)) {
            throw "Там должно быть не менее 4 цифр.";
            event.target.style.border = "3px solid #E30613";
        }

        else if(event.target.value.length < 4 || event.target.value.length > 12) {
            throw "Пароль должен быть от 4 до 12 символов.";
            event.target.style.border = "3px solid #E30613";
        }

        else {
            document.querySelector('[type="submit"]').removeAttribute('disabled');
            event.target.style.border = "3px solid green";
        }

    }
    catch(messg) {
        document.querySelector('[type="submit"]').setAttribute('disabled', "disabled");
        error.innerText = messg;
    }
}


///////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////   Countdown
let getDeadline = $("#countdown").getAttribute('data-time');
let deadline = getDeadline;

// time remaining
function time_remaining(endtime) {
    let t = Date.parse(endtime) - Date.parse(new Date());
    let seconds = Math.floor( (t/1000) % 60 );
    let minutes = Math.floor( (t/1000/60) % 60 );
    let hours = Math.floor( (t/(1000*60*60)) % 24 );
    let days = Math.floor( t/(1000*60*60*24) );
    return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
}

// run
function run_clock(id, endtime) {
let clock = document.getElementById(id);

    // get spans where our clock numbers are held
    let days_span = clock.querySelector('.days');
    let hours_span = clock.querySelector('.hours');
    let minutes_span = clock.querySelector('.minutes');
    let seconds_span = clock.querySelector('.seconds');

    function update_clock() {
        let t = time_remaining(endtime);

        // update the numbers in each part of the clock
        days_span.innerHTML = t.days;
        hours_span.innerHTML = ('0' + t.hours).slice(-2);
        minutes_span.innerHTML = ('0' + t.minutes).slice(-2);
        seconds_span.innerHTML = ('0' + t.seconds).slice(-2);

        if(t.total<=0){ clearInterval(timeinterval); }

    }
    update_clock();
    let timeinterval = setInterval(update_clock,1000);
}
run_clock('countdown', deadline);

function validatePhone(phoneVal) {
    var regex = /^((\+998)[\- ]?)?\(?\d{2}\)?[\- ]?\d{3}[\- ]?\d{2}[\- ]?\d{2}?$/;
    return regex.test(phoneVal);
}

$('[type="tel"]').inputmask({
    mask: "+\\9\\98 99 999 99 99",
    placeholder: "-",
});

//password show/hide functionality
document.querySelector('.passkey-icon').addEventListener('click', displayPassword);
document.querySelectorAll('.passkey-icon')[1].addEventListener('click', displayPassword);

function displayPassword(event) {
    if(event.target.parentNode.getAttribute('data-display-passkey') == 'off') {
        event.target.parentNode.setAttribute('data-display-passkey','on');
        $('.passkey-icon img').attr('src','img/eye-crossed.svg');
        event.target.parentElement.previousSibling.previousSibling.setAttribute('type','text');
        console.log(event.target.parentElement.previousSibling.previousSibling);
    }
    else {
        event.target.parentNode.setAttribute('data-display-passkey','off');
        $('.passkey-icon img').attr('src','img/eye.svg');
        event.target.parentElement.previousSibling.previousSibling.setAttribute('type','password');
    }
}

form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    labels: {
        next: "Продолжить",
        previous: "Назад",
        finish: "Завершить",
    },
    onStepChanging: function (event, currentIndex, newIndex) {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex) {
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex) {
        // alert("Submitted!");
        form.submit();
    }
});






var ScrollTrigger;
var scroller;
$(window).load(function() {

    var html = $('html');

    html.addClass('loader-done');

    setTimeout(function() {

        html.addClass('loader-gone');

        html.removeClass('loader-html');

        var heroVideo = $('#hero-video');
        if (heroVideo.length && !dev) {
            heroVideo[0].play();
        }

        scroller = new LocomotiveScroll({
            el: document.querySelector('[data-scroll-container]'),
            smooth: true,
            getDirection: true,
            direction: 'vertical',
            reloadOnContextChange: true,
            //getSpeed: true,
            smartphone: {
                smooth: true,
                direction: 'vertical',
            },
            tablet: {
                smooth: true,
                direction: 'vertical',
            }
        });

        gsap.registerPlugin(ScrollTrigger);
        scroller.on('scroll', ScrollTrigger.update);

        $(window).resize(function() {
            ScrollTrigger.update;
        });
        
        if (window.location.pathname === "/interior/")
            ScrollTrigger.update;

        ScrollTrigger.scrollerProxy('.main-global', {
            scrollTop(value) {
                return arguments.length ?
                    scroller.scrollTo(value, 0, 0) :
                    scroller.scroll.instance.scroll.y
            },
            getBoundingClientRect() {
                return {
                    left: 0,
                    top: 0,
                    width: window.innerWidth,
                    height: window.innerHeight
                }
            }
        });

        ScrollTrigger.create({
            trigger: '.our-goal',
            scroller: '.main-global',
            start: '-25% 50%',
            end: '10% 50%',
            animation: gsap.to('.hero-background', {
                opacity: '0'
            }),
            scrub: 2,
            markers: false
        });

        // ScrollTrigger.create({
        //     trigger: '.our-goal',
        //     scroller: '.main-global',
        //     start: '-50% 50%',
        //     end: '150% 50%',
        //     animation: gsap.to('.our-goal-container', { 'transform': 'translateY(150px)' }),
        //     scrub: 2,
        //     markers: false
        // });

        var nextState = false;
        var nextTimer = 3000;
        var nextInterval;

        function nextGo() {
            if (nextTimer == 0) {
                clearInterval(nextInterval);
                var thisLink = $('.next-section').find('.next-section-link').attr('href');
                if ($('.next-section').find('.next-section-link').length > 0 && thisLink !== undefined)
                    window.location = thisLink;
            } else {
                nextTimer = nextTimer - 100;
            }
            //console.log(nextTimer);
        }

        function nextEnter(progress, direction, isActive) {
            //console.log('enter', isActive);
            nextState = isActive;
            nextInterval = setInterval(nextGo, 100);
        }

        function nextLeave(progress, direction, isActive) {
            //console.log('leave', isActive);
            nextState = isActive;
            nextTimer = 3000;
            clearInterval(nextInterval);
        }

        if ($('.next-section').length) {
            ScrollTrigger.create({
                trigger: '.next-section',
                scroller: '.main-global',
                start: '0% 50%',
                end: '100% 50%',
                //animation: gsap.to('.our-goal-container', { 'transform': 'translateY(150px)' }),
                onEnter: ({
                    progress,
                    direction,
                    isActive
                }) => nextEnter(progress, direction, isActive),
                onEnterBack: ({
                    progress,
                    direction,
                    isActive
                }) => nextEnter(progress, direction, isActive),
                onLeave: ({
                    progress,
                    direction,
                    isActive
                }) => nextLeave(progress, direction, isActive),
                onLeaveBack: ({
                    progress,
                    direction,
                    isActive
                }) => nextLeave(progress, direction, isActive),
                scrub: 2,
                toggleClass: "active-inview",
                markers: false
            });
        }



        ScrollTrigger.addEventListener('refresh', () => scroller.update());
        ScrollTrigger.refresh();

        //get derection y
        const header = document.querySelector('.header');

        scroller.on('scroll', (args) => {
            //console.log(args.speed);
            if (args.scroll.y >= 100) {
                header.classList.add('header-hide');
            } else {
                header.classList.remove('header-hide');
            }
            if (args.direction == 'up') {
                header.classList.add('header-show');
            } else {
                header.classList.remove('header-show');
            }
        });

        //------------------------------------------------------------------------------------------//

        $(document).on('click', '.hero-scroll-down', function(event) {
            event.preventDefault();
            var target = document.querySelector('#our-goal');
            scroller.scrollTo(target);
        });

        //------------------------------------------------------------------------------------------//

        var circle = document.querySelector(".circle");

        TweenLite.set(circle, {
            xPercent: -50,
            yPercent: -50
        });

        $('.next-section').on('mousemove', function(e) {
            TweenLite.to(circle, 0.3, {
                x: e.clientX,
                y: e.clientY + scroller.scroll.instance.scroll.y
            });
        });

        $(document).on('mouseenter', '.next-section', function() {
            $('.circle').addClass('active');
        });

        $(document).on('mouseleave', '.next-section', function() {
            $('.circle').removeClass('active');
        });

        $(document).on('click', '.next-section', function(event) {
            event.preventDefault();
            var thisLink = $(this).find('.next-section-link').attr('href');
            window.location = thisLink;
        });

        //------------------------------------------------------------------------------------------//

        //advantages
        var advantagesSlider,
            advantagesSliderLength = $('.advantages-slider').length;
        if (advantagesSliderLength) {
            advantagesSlider = new Swiper('.advantages-slider', {
                speed: 1000,
                parallax: true,
                simulateTouch: false,
                allowTouchMove: false
            });

            //beforeSlideChangeStart
            //slideChange
            // advantagesSlider.on('slideChange', function (swiper) {
            //     console.log(swiper);
            // });

            $(document).on('click', '.advantages-navigation-link', function() {
                var thisIndex = $(this).data('index');
                $(this).addClass('active').siblings('.advantages-navigation-link').removeClass('active');
                advantagesSlider.slideTo(thisIndex, 1000);
            });
        }

        //------------------------------------------------------------------------------------------//

        //system
        var systemSlider,
            systemSliderLength = $('.system-slider').length;
        if (systemSliderLength) {
            systemSlider = new Swiper('.system-slider', {
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                loop: true,
                speed: 1000,
                parallax: true,
                simulateTouch: false,
                allowTouchMove: false,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
            });

            $(document).on('click', '.system-slider-next', function() {
                systemSlider.slideNext(1000);
            });
        }

        //------------------------------------------------------------------------------------------//

        //colors navigation
        $(document).on('click', '.colors-navigation-item', function(event) {
            event.preventDefault();
            $(this).addClass('active').siblings().removeClass('active');
            $('.colors-info-title').text($(this).data('color-title'));
            $('.colors-info-subtitle').text($(this).data('color-subtitle'));
            if ($('.colors-navigation').innerWidth() < $('.colors-navigation-item').length * ($(this).innerWidth() + 3)) {
                var tempOffset = $('.colors-navigation').scrollLeft();
                var thisOffset = $(this).offset().left;
                $('.colors-navigation').animate({
                    scrollLeft: tempOffset + thisOffset - 26
                }, 100);
            }
        });

        //------------------------------------------------------------------------------------------//

        $('.advantages-item-button').hover(function() {
            var thisParent = $(this).parents('.advantages-item');
            thisParent.addClass('hover');
            var thisPanel = thisParent.find('.advantages-item-block').html();
            $('.advantages-panel-content').html(thisPanel);
            $('.advantages-panel').addClass('active');
        }, function() {
            var thisParent = $(this).parents('.advantages-item');
            thisParent.removeClass('hover');
            $('.advantages-panel').removeClass('active');
        });

        //------------------------------------------------------------------------------------------//

        var template_loader = '\
           <span class="inline-loader-dot inline-loader-dot-1"></span>\
            <span class="inline-loader-dot inline-loader-dot-2"></span>\
            <span class="inline-loader-dot inline-loader-dot-3"></span>';

        function addLoader(container) {
            var item = document.querySelector('[data-ref="' + container + '"]');
            let template_wrap = document.createElement('div');
            template_wrap.className = "inline-loader inline-loader-view";
            template_wrap.innerHTML = template_loader;
            item.appendChild(template_wrap);
        }

        function removeLoader(container) {
            var item = document.querySelector('[data-ref="' + container + '"]');
            if (item.hasChildNodes()) {
                var children = item.childNodes;
                for (var i = 0; i < children.length; ++i) {
                    if (children[i].classList !== undefined && children[i].classList.contains('inline-loader')) {
                        item.removeChild(children[i]);
                    }
                }
            }
        }
        var sourceFolder = 'configurator/colors/img_3d/6at_premium/valencia_orange_metallic';
        var initialFrame = 44;

        function spritespinInit(folder, frame) {
            addLoader('color');
            var num = '1.2';
            $('.spritespin').spritespin({
                source: SpriteSpin.sourceArray('/img/' + folder + '/{frame}.png?v=' + num, {
                    frame: [0, 71],
                    digits: 1
                }),
                width: 1156,
                // width: 885,
                height: 498,
                sense: 1,
                responsive: true,
                loop: true,
                animate: false,
                //preloadCount: 1,
                frame: frame,
                onComplete: function() {
                    // console.log('onComplete');
                    removeLoader('color');
                },
                onInit: function(e, data) {

                    var to = null;
                    var iv = null;

                    $(document).on('mousedown', '.colors-gallery-next', function(event) {
                        SpriteSpin.updateFrame(data, data.frame + 1);
                        to = setTimeout(function() {
                            iv = setInterval(function() {
                                SpriteSpin.updateFrame(data, data.frame + 1);
                            }, 40);
                        }, 40);
                    });

                    $(document).on('mousedown', '.colors-gallery-prev', function(event) {
                        SpriteSpin.updateFrame(data, data.frame - 1);
                        to = setTimeout(function() {
                            iv = setInterval(function() {
                                SpriteSpin.updateFrame(data, data.frame - 1);
                            }, 40);
                        }, 40);
                    });

                    $(document).on('mouseup mouseleave', '.colors-gallery-next, .colors-gallery-prev', function(event) {
                        clearTimeout(to);
                        clearInterval(iv);
                    });

                    $(document).on('mousedown', '.colors-gallery-next', function(event) {
                        event.preventDefault();
                        // console.log(data.frame);
                        SpriteSpin.updateFrame(data, data.frame + 1);
                    });
                },
                onFrameChanged: function(e, data) {
                    initialFrame = data.frame;
                }
            });
        }

        if ($('.spritespin').length) {
            spritespinInit(sourceFolder, initialFrame);
        }

        $(document).on('click', '.colors-navigation-item:not(".active")', function(event) {
            event.preventDefault();

            var thisFolder = $(this).data('folder');
            // console.log(thisFolder);

            $(".spritespin-wrapper").fadeOut('50', function() {
                $(".spritespin").spritespin("destroy");
                $(".spritespin").html("");
                $(".spritespin").attr("style", "");


                spritespinInit(thisFolder, initialFrame);

                $(".spritespin-wrapper").fadeIn('600');
            });
        });

        // $(document).on('click', '.navigation-toggle', function () {
        //     $('body').toggleClass('navigation-open');
        // });

        //------------------------------------------------------------------------------------------//

        $(document).on('click', '.services-toggle', function(event) {
            $('body').addClass('services-open');
            scroller.stop();
        });

        $(document).on('click', '.services-sidebar-close', function(event) {
            $('body').removeClass('services-open');
            scroller.start();
        });

        $(window).resize(function() {
            if ($('body').hasClass('services-open')) {
                $('body').removeClass('services-open');
                scroller.start();
            }
        });

        //------------------------------------------------------------------------------------------//

        $('.menu-dmax').hover(function() {
            $('.menu-background').css('background-image', "url(" + $('.menu-background').attr('data-img') + ")");
            $('.menu-background').addClass('active');
        }, function() {
            $('.menu-background').removeClass('active');
        });

        $('.menu-dmax-truck').hover(function() {
            $('.menu-background').css('background-image', "url(" + $('.menu-background').attr('data-img-truck') + ")");
            $('.menu-background').addClass('active');
        }, function() {
            $('.menu-background').removeClass('active');
        });

        $(document).on('click', '.menu-close', function() {
            $('body').removeClass('navigation-open');
            scroller.start();
        });

        $(document).on('click', '.navigation-toggle', function() {
            $('body').addClass('navigation-open');
            scroller.stop();
        });

        $(window).resize(function() {
            if ($('body').hasClass('navigation-open')) {
                $('body').removeClass('navigation-open');
                scroller.start();
            }
        });

        //------------------------------------------------------------------------------------------//

        $(document).on('click', '.about-button-on-engine', function() {
            $(this).addClass('about-button-on-hide');
            var thisParent = $(this).parents('.about');
            $('#engine-video-2').fadeIn(800, function() {
                thisParent.find('#engine-video-1')[0].pause();
                thisParent.find('#engine-video-2')[0].play();
                thisParent.find('.about-meta').addClass('about-meta-visible');
            })
        });

        $(document).on('click', '.about-button-on-4x4', function() {
            $(this).addClass('about-button-on-hide');
            var thisParent = $(this).parents('.about');
            $('#play-4x4-video-2').fadeIn(800, function() {
                // thisParent.find('.about-background')
                thisParent.find('#play-4x4-video-2')[0].play();
                thisParent.find('.about-meta').addClass('about-meta-visible');
            })
        });

        //------------------------------------------------------------------------------------------//

        $(document).on('click', '.seats-navigation-item:not(".active")', function() {
            $(this).addClass('active').siblings('.seats-navigation-item').removeClass('active');

            if ($(this).hasClass('seats-navigation-leather')) {
                $('.seats-cloth').fadeOut('100', function() {
                    $('.seats-leather').fadeIn('600');
                });
            } else if ($(this).hasClass('seats-navigation-cloth')) {
                $('.seats-leather').fadeOut('100', function() {
                    $('.seats-cloth').fadeIn('600');
                });
            }
        });

        //------------------------------------------------------------------------------------------//

        $(document).on('mousedown touchstart', '.comparison-slider-wrapper', function() {
            if ($('.about-frame-note').is(':visible')) {
                $('.about-frame-note').fadeOut('150');
                $('.about-frame-block').find('.about-meta').addClass('about-meta-visible');
            }
        });

        //------------------------------------------------------------------------------------------//

        $('.advantages-item-info').each(function(index, element) {
            $(this).wrapAll("<div class='advantages-item-wrapper' />");
        });

        //------------------------------------------------------------------------------------------//

        //arctic trucks order scroll
        $(document).on('click', '.arctic-trucks-hero-order-button', function(event) {
            event.preventDefault();
            var target = document.querySelector('#request-arctic-trucks-form');
            scroller.scrollTo(target);
        });

        //------------------------------------------------------------------------------------------//

        //arctic trucks modifications
        var arcticModificationsSlider,
            arcticModificationsSliderLength = $('.arctic-trucks-modifications-slider').length;
        if (arcticModificationsSliderLength) {
            arcticModificationsSlider = new Swiper('.arctic-trucks-modifications-slider', {
                speed: 600,
                slidesPerView: 'auto',
                spaceBetween: 24,
                freeMode: true,
                breakpoints: {
                    1200: {
                        spaceBetween: 62,
                    },
                    1400: {
                        spaceBetween: 72,
                    },
                }
            });
        }

        //------------------------------------------------------------------------------------------//


    }, animationTime);


}); //window load