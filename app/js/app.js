///////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////       BASIC
var dev = 0;
var animationTime = 2400;

$(document).ready(function () {

    //nojs
    $('body').removeClass('no-js');

    function heroFix() {
        $('.hero-ios-fix').height(window.innerHeight);
    }
    
    heroFix();

    $(window).resize(function () {
        heroFix();
    });

    //------------------------------------------------------------------------//

    //fakelink
    $(document).on('click', 'a[href="#"]', function (event) {
        event.preventDefault();
    });

    //------------------------------------------------------------------------------------------//

    if (dev) {
        $('body').addClass('dev-mode');
        $('body').find('video').each(function (index) {
            var thisElement = $(this);
            thisElement[0].pause();
        });
        animationTime = 0;
    }

});//document ready

var ScrollTrigger;
var scroller;
$(window).on('load', function() {

    var html = $('html');

    html.addClass('loader-done');

    setTimeout(function() {

        html.addClass('loader-gone');

        html.removeClass('loader-html');

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

        //------------------------------------------------------------------------------------------//
        
        $(document).on('click', '.to-anim-about', function(event) {
            event.preventDefault();
            var target = document.querySelector('#about');
            scroller.scrollTo(target);
        });
        $(document).on('click', '.to-anim-mexanika', function(event) {
            event.preventDefault();
            var target = document.querySelector('#mexanika');
            scroller.scrollTo(target);
        });
        $(document).on('click', '.to-anim-create', function(event) {
            event.preventDefault();
            var target = document.querySelector('#create');
            scroller.scrollTo(target);
        });
        $(document).on('click', '.to-anim-how', function(event) {
            event.preventDefault();
            var target = document.querySelector('#how');
            scroller.scrollTo(target);
        });

    	const observer = lozad('.lozad');
    	observer.observe();

    	let inputPhone = $('[type="tel"]').inputmask({
    		mask: "+\\9\\98 99 999 99 99",
    		placeholder: "-",
    	});

        //MOBILE OPEN MENU
        $('.burger').click(function() {
            if (!$(this).hasClass('transformed')) {
                $(this).addClass('transformed');
                $('.mob-menu').addClass('opened');
                setTimeout(function() {
                    $('body').addClass('overflow');
                }, 200)
            } else {
                $(this).removeClass('transformed');
                $('.mob-menu').removeClass('opened');
                $('body').removeClass('overflow');
            }
        });

        $(".mob-menu a").click(function() {
            $('.burger').removeClass('transformed');
            $('.mob-menu').removeClass('opened');
            $('body').removeClass('overflow');
        })

        $('.mex__item').each(function() {
             $(this).mouseenter(function() {
                 $(this).addClass('show');
            }).mouseleave(function() {
                 $(this).removeClass('show');
            })
        });

    	// Fancy Box active
        $('[data-fancybox]').fancybox();

    	// FAQ
        const items = document.querySelectorAll(".acc-btn");
        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');
            for (let i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }
            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }
        items.forEach(item => item.addEventListener('click', toggleAccordion));

        // home-2
        const userMediaSlider = new Swiper('.usermedia__slider', {
            slidesPerView: 4,
            centeredSlides: true,
            spaceBetween: 15,
            initialSlide: 1,
            watchOverflow: true,
            speed: 600
        });

        // Slider Tabs
        $('.tab_content').hide();
        $('.tab_content:first').show();
        $('.tabs li:first').addClass('is-active');

        $('.tabs li').click(function(e) {
            e.preventDefault()
            $('.tabs li').removeClass('is-active');
            $(this).addClass('is-active');
            $('.tab_content').hide();

            let selectTab = $(this).find('a').attr("href");

            $(selectTab).fadeIn();
        });

        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 3,
            slidesPerColumn: 2,
            spaceBetween: 20,
            freeMode: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });

        ScrollTrigger.addEventListener('refresh', () => scroller.update());
        ScrollTrigger.refresh();

        // scroller.on('scroll', (args) => {
        //     //console.log(args.speed);
        //     if (args.scroll.y > 150) {
        //         $('.cl-canvas').css('position','fixed');
        //     } else {
        //         $('.cl-canvas').css('position','absolute');
        //     }
        // });

    }, animationTime);

}); //window load


///////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////       FORM
function validatePhone(phoneVal) {
    let regex = /^((\+998)[\- ]?)?\(?\d{2}\)?[\- ]?\d{3}[\- ]?\d{2}[\- ]?\d{2}?$/;
    return regex.test(phoneVal);
}

$(document).ready(function() {
    
    // password-eye
    $('body').on('click', '.password-eye-1', function(){
        if ($('#password').attr('type') == 'password'){
            $(this).addClass('view');
            $('#password').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#password').attr('type', 'password');
        }
        return false;
    });

    $('body').on('click', '.password-eye-22', function(){
        if ($('#password').attr('type') == 'password'){
            $(this).addClass('view');
            $('#password').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#password').attr('type', 'password');
        }
        return false;
    });

    $('body').on('click', '.password-eye-2', function(){
        if ($('#confirm').attr('type') == 'password'){
            $(this).addClass('view');
            $('#confirm').attr('type', 'text');
        } else {
            $(this).removeClass('view');
            $('#confirm').attr('type', 'password');
        }
        return false;
    });

    // enable fileuploader plugin
    var $fileuploader = $('input.gallery_media').fileuploader({
        limit: 100,
        fileMaxSize: 20,
        extensions: ['image/*', 'video/*'],
        changeInput: ' ',
        theme: 'gallery',
        enableApi: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                      '<ul class="fileuploader-items-list">' +
                          '<li class="fileuploader-input"><button type="button" class="fileuploader-input-inner"><i class="fileuploader-icon-main"></i> <span>${captions.feedback}</span></button></li>' +
                      '</ul>' +
                  '</div>',
            item: '<li class="fileuploader-item">' +
                       '<div class="fileuploader-item-inner">' +
                           '<div class="actions-holder">' +
                               '<button type="button" class="fileuploader-action fileuploader-action-sort is-hidden" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                               '<button type="button" class="fileuploader-action fileuploader-action-settings is-hidden" title="${captions.edit}"><i class="fileuploader-icon-settings"></i></button>' +
                               '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                               '<div class="gallery-item-dropdown">' +
                                   '<a class="fileuploader-action-popup">${captions.setting_edit}</a>' +
                                   '<a class="gallery-action-rename">${captions.setting_rename}</a>' +
                                   '<a class="gallery-action-asmain">${captions.setting_asMain}</a>' +
                               '</div>' +
                           '</div>' +
                           '<div class="thumbnail-holder">' +
                               '${image}' +
                               '<span class="fileuploader-action-popup"></span>' +
                               '<div class="progress-holder"><span></span>${progressBar}</div>' +
                           '</div>' +
                           '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                           '<div class="type-holder">${icon}</div>' +
                       '</div>' +
                  '</li>',
            item2: '<li class="fileuploader-item file-main-${data.isMain}">' +
                       '<div class="fileuploader-item-inner">' +
                           '<div class="actions-holder">' +
                               '<button type="button" class="fileuploader-action fileuploader-action-sort" title="${captions.sort}"><i class="fileuploader-icon-sort"></i></button>' +
                               '<button type="button" class="fileuploader-action fileuploader-action-settings" title="${captions.edit}"><i class="fileuploader-icon-settings"></i></button>' +
                               '<button type="button" class="fileuploader-action fileuploader-action-remove" title="${captions.remove}"><i class="fileuploader-icon-remove"></i></button>' +
                               '<div class="gallery-item-dropdown">' +
                                   '<a href="${data.url}" target="_blank">${captions.setting_open}</a>' +
                                   '<a href="${data.url}" download>${captions.setting_download}</a>' +
                                   '<a class="fileuploader-action-popup">${captions.setting_edit}</a>' +
                                   '<a class="gallery-action-rename">${captions.setting_rename}</a>' +
                                   '<a class="gallery-action-asmain">${captions.setting_asMain}</a>' +
                               '</div>' +
                           '</div>' +
                           '<div class="thumbnail-holder">' +
                               '${image}' +
                               '<span class="fileuploader-action-popup"></span>' +
                           '</div>' +
                           '<div class="content-holder"><h5 title="${name}">${name}</h5><span>${size2}</span></div>' +
                           '<div class="type-holder">${icon}</div>' +
                       '</div>' +
                  '</li>',
            itemPrepend: true,
            startImageRenderer: true,
            canvasImage: false,
            onItemShow: function(item, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl),
                    color = api.assets.textToColor(item.format),
                    $plusInput = listEl.find('.fileuploader-input'),
                    $progressBar = item.html.find('.progress-holder');

                // put input first in the list
                $plusInput.prependTo(listEl);

                // color the icon and the progressbar with the format color
                item.html.find('.type-holder .fileuploader-item-icon')[api.assets.isBrightColor(color) ? 'addClass' : 'removeClass']('is-bright-color').css('backgroundColor', color);
            },
            onImageLoaded: function(item, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl);
                
                // add icon
                item.image.find('.fileuploader-item-icon i').html('')
                    .addClass('fileuploader-icon-' + (['image', 'video', 'audio'].indexOf(item.format) > -1 ? item.format : 'file'));

                // check the image size
                if (item.format == 'image' && item.upload && !item.imU) {
                    if (item.reader.node && (item.reader.width < 100 || item.reader.height < 100)) {
                        alert(api.assets.textParse(api.getOptions().captions.imageSizeError, item));
                        return item.remove();
                    }

                    item.image.hide();
                    item.reader.done = true;
                    item.upload.send();
                }

            },
            onItemRemove: function(html) {
                html.fadeOut(250);  
            }
        },
        dragDrop: {
            container: '.fileuploader-theme-gallery .fileuploader-input'
        },
        upload: {
            url: './php/ajax.php?type=upload',
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            start: true,
            synchron: true,
            beforeSend: function(item) {
                // check the image size first (onImageLoaded)
                if (item.format == 'image' && !item.reader.done)
                    return false;

                // add editor to upload data after editing
                if (item.editor && (typeof item.editor.rotation != "undefined" || item.editor.crop)) {
                    item.imU = true;
                    item.upload.data.name = item.name;
                    item.upload.data.id = item.data.listProps.id;
                    item.upload.data._editorr = JSON.stringify(item.editor);
                }

                item.html.find('.fileuploader-action-success').removeClass('fileuploader-action-success');
            },
            onSuccess: function(result, item) {
                var data = {};

                try {
                    data = JSON.parse(result);
                } catch (e) {
                    data.hasWarnings = true;
                }

                // if success update the information
                if (data.isSuccess && data.files.length) {
                    if (!item.data.listProps)
                        item.data.listProps = {};
                    item.title = data.files[0].title;
                    item.name = data.files[0].name;
                    item.size = data.files[0].size;
                    item.size2 = data.files[0].size2;
                    item.data.url = data.files[0].url;
                    item.data.listProps.id = data.files[0].id;

                    item.html.find('.content-holder h5').attr('title', item.name).text(item.name);
                    item.html.find('.content-holder span').text(item.size2);
                    item.html.find('.gallery-item-dropdown [download]').attr('href', item.data.url);
                }

                // if warnings
                if (data.hasWarnings) {
                    for (var warning in data.warnings) {
                        alert(data.warnings[warning]);
                    }

                    item.html.removeClass('upload-successful').addClass('upload-failed');
                    return this.onError ? this.onError(item) : null;
                }

                delete item.imU;
                item.html.find('.fileuploader-action-remove').addClass('fileuploader-action-success');

                setTimeout(function() {
                    item.html.find('.progress-holder').hide();

                    item.html.find('.fileuploader-action-popup, .fileuploader-item-image').show();
                    item.html.find('.fileuploader-action-sort').removeClass('is-hidden');
                    item.html.find('.fileuploader-action-settings').removeClass('is-hidden');
                }, 400);
            },
            onError: function(item) {
                item.html.find('.progress-holder, .fileuploader-action-popup, .fileuploader-item-image').hide();

                // add retry button
                item.upload.status != 'cancelled' && !item.imU && !item.html.find('.fileuploader-action-retry').length ? item.html.find('.actions-holder').prepend(
                    '<button type="button" class="fileuploader-action fileuploader-action-retry" title="Retry"><i class="fileuploader-icon-retry"></i></button>'
                ) : null;
            },
            onProgress: function(data, item) {
                var $progressBar = item.html.find('.progress-holder');

                if ($progressBar.length) {
                    $progressBar.show();
                    $progressBar.find('span').text(data.percentage >= 99 ? 'Uploading...' : data.percentage + '%');
                    $progressBar.find('.fileuploader-progressbar .bar').height(data.percentage + '%');
                }

                item.html.find('.fileuploader-action-popup, .fileuploader-item-image').hide();
            }
        },
        editor: {
            cropper: {
                showGrid: true,
                minWidth: 100,
                minHeight: 100
            },
            onSave: function(dataURL, item) {
                // if no editor
                if (!item.editor || !item.reader.width)
                    return;

                // if uploaded
                // resend upload
                if (item.upload && item.upload.resend)
                    item.upload.resend();

                // if preloaded
                // send request
                if (item.appended && item.data.listProps) {
                    // hide current thumbnail
                    item.imU = true;
                    item.image.addClass('fileuploader-loading').find('img, canvas').hide();
                    item.html.find('.fileuploader-action-popup').hide();

                    $.post('php/ajax.php?type=resize', {name: item.name, id: item.data.listProps.id, _editor: JSON.stringify(item.editor)}, function() {
                        // update the image
                        item.reader.read(function() {
                            delete item.imU;

                            item.image.removeClass('fileuploader-loading').find('img, canvas').show();
                            item.html.find('.fileuploader-action-popup').show();
                            item.editor.rotation = item.editor.crop = null;
                            item.popup = {open: item.popup.open};
                        }, null, true);
                    });
                }
            }   
        },
        sorter: {
            onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                var api = $.fileuploader.getInstance(inputEl),
                    fileList = api.getFiles(),
                    list = [];

                // prepare the sorted list
                api.getFiles().forEach(function(item) {
                    if (item.data.listProps)
                        list.push({
                            name: item.name,
                            id: item.data.listProps.id,
                            index: item.index
                        });
                });

                // send request
                $.post('php/ajax.php?type=sort', {
                    list: JSON.stringify(list)
                });
            }
        },
        afterRender: function(listEl, parentEl, newInputEl, inputEl) {
            var api = $.fileuploader.getInstance(inputEl),
                $plusInput = listEl.find('.fileuploader-input');

            // bind input click
            $plusInput.on('click', function() {
                api.open();
            });
            
            // set drop container
            api.getOptions().dragDrop.container = $plusInput;

            // bind dropdown buttons
            $('body').on('click', function(e) {
                var $target = $(e.target),
                    $item = $target.closest('.fileuploader-item'),
                    item = api.findFile($item);

                // toggle dropdown
                $('.gallery-item-dropdown').hide();
                if ($target.is('.fileuploader-action-settings') || $target.parent().is('.fileuploader-action-settings')) {
                    $item.find('.gallery-item-dropdown').show(150);
                }

                // rename
                if ($target.is('.gallery-action-rename')) {
                    var x = prompt(api.getOptions().captions.rename, item.title);

                    if (x && item.data.listProps) {
                        $.post('php/ajax.php?type=rename', {name: item.name, id: item.data.listProps.id, title: x}, function(result) {
                            try {
                                var j = JSON.parse(result);

                                // update the file name and url
                                if (j.title) {
                                    item.title = j.title;
                                    item.name = item.title + (item.extension.length ? '.' + item.extension : '');
                                    $item.find('.content-holder h5').attr('title', item.name).html(item.name);
                                    $item.find('.gallery-item-dropdown [download]').attr('href', item.data.url);

                                    if (item.popup.html)
                                        item.popup.html.find('h5:eq(0)').text(item.name);

                                    if (j.url)
                                        item.data.url = j.url;
                                    if (item.appended && j.file)
                                        item.file = j.file;

                                    api.updateFileList();
                                }

                            } catch(e) {
                                alert(api.getOptions().captions.renameError);
                            }
                        });
                    }
                }

                // set main
                if ($target.is('.gallery-action-asmain') && item.data.listProps) {
                    $.post('php/ajax.php?type=asmain', {name: item.name, id: item.data.listProps.id}, function() {
                        api.getFiles().forEach(function(val) {
                            delete val.data.isMain;
                            val.html.removeClass('file-main-0 file-main-1');
                        });
                        item.html.addClass('file-main-1');
                        item.data.isMain = true;

                        api.updateFileList();
                    });
                }
            });
        },
        onRemove: function(item) {
            // send request
            if (item.data.listProps)
                $.post('php/ajax.php?type=remove', {
                    name: item.name,
                    id: item.data.listProps.id
                });
        },
        captions: $.extend(true, {}, $.fn.fileuploader.languages['en'], {
            feedback: 'Просто перетащи сюда',
            setting_asMain: 'Use as main',
            setting_download: 'Скачать',
            setting_edit: 'Изменить',
            setting_open: 'Открыть',
            setting_rename: 'Переименовать',
            rename: 'Введите новое имя файла:',
            renameError: 'Пожалуйста, введите другое имя.',
            imageSizeError: 'Изображение ${name} слишком маленькое.',
        })
    });
    
    // preload the files
    $.post('php/ajax.php?type=preload', null, function(result) {
        var api = $.fileuploader.getInstance($fileuploader),
            preload = [];
        
        try {
            // preload the files
            preload = JSON.parse(result);
            
            api.append(preload);
        } catch(e) {}
    });

    // enable fileuploader plugin
    $('input[name="upload-politic-doc"]').fileuploader({
        addMore: true,
        captions: 'ru'
    });

});

jQuery.extend(jQuery.validator.messages, {
    required: "Обязательное поле",
    equalTo: "Пароли не совпадают",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Пожалуйста, введите не менее {0} символов."),
    // remote: "Please fix this field.",
});

let form = $("#contact");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.after(error); },
    rules: {
        password: {
            minlength : 6
        },
        confirm: {
            minlength : 6,
            equalTo: "#password"
        }
    },
	success: function(label){
	    label.addClass("valid");                        
	},
});

// login
$('#login-form').validate({
    errorPlacement: function errorPlacement(error, element) { element.after(error); },
    rules: {
        phoneNumber: {
            matches: "/^((\+998)[\- ]?)?\(?\d{2}\)?[\- ]?\d{3}[\- ]?\d{2}[\- ]?\d{2}?$/",  // <-- no such method called "matches"!
            minlength: 10,
            maxlength: 10
        },
        password: {
            minlength : 6
        }
    },
	success: function(label){
	    label.addClass("valid");                        
	},
});

// userchange
$('#userchange').validate({
    errorPlacement: function errorPlacement(error, element) { element.after(error); },
	success: function(label) {
	    label.addClass("valid");                        
	}
});

// answer
$('#answerform').validate({
    errorPlacement: function errorPlacement(error, element) { element.after(error); },
    success: function(label) {
        label.addClass("valid");                        
    }
});

// user change info modal
$('#usermodal').popup({
    escape: false,
    blur: false,
    scrolllock: true,
    transition: 'all 0.3s'
});

///////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////  CABINET

// video
const players = Array.from(document.querySelectorAll('.js-player')).map(p => new Plyr(p));

// notifications
let notificationsOpenBtn = $('.notification__btn'),
    notificationsCloseBtn = $('.notifications__close');

notificationsOpenBtn.on('click',function() {
    $('.notifications').addClass('is-active');
    $('body').addClass('overflow');
    $('.overlay').addClass('is-active');
})

notificationsCloseBtn.on('click',function() {
    $('.notifications').removeClass('is-active');
    $('body').removeClass('overflow');
    $('.overlay').removeClass('is-active');
})

// videos
let mediaSlider,
    mediaSliderLength = $('.slider__tabs').length;
if (mediaSliderLength) {
    mediaSlider = new Swiper('.slider__tabs', {
        speed: 600,
        lazy: true,
        slidesPerView: 1,
        spaceBetween: 20,
        breakpoints: {
            992: {
                slidesPerView: 2
            },
            1200: {
                spaceBetween: 62,
                slidesPerView: 3
            },
            1400: {
                spaceBetween: 72,
            },
        }
    });
}

// upload video/photo
$(document).ready(function() {
    
    // enable fileuploader plugin
    $('input[name="files"]').fileuploader({
        addMore: true
    });
    
});   

///////////////////////////////////////////////////////////////////////////////////////
// /////////////////////////////   Countdown

$('[data-countdown]').each(function() {
  let $this = $(this), 
  finalDate = $(this).data('countdown');
  $this.countdown(finalDate, function(event) {
    let $this = $(this).html(event.strftime(''
      + '<div class="countdown__group"><div class="countdown__num">%d</div> <div class="countdown__text days">день</div></div> '
      + '<div class="countdown__group"><div class="countdown__divider">:</div></div>'
      + '<div class="countdown__group"><div class="countdown__num">%H</div> <div class="countdown__text hours">часы</div></div> '
      + '<div class="countdown__group"><div class="countdown__divider">:</div></div>'
      + '<div class="countdown__group"><div class="countdown__num">%M</div> <div class="countdown__text minutes">минуты</div></div> '
      + '<div class="countdown__group"><div class="countdown__divider">:</div></div>'
      + '<div class="countdown__group"><div class="countdown__num">%S</div> <div class="countdown__text secunds">секунды</div></div>'));
  });
});