(function ($) {
    $(document).ready(function () {
        $(document).ready(function () {
            if ($(window).width() > 1024) {
                $('.footer-section .elementor-tab-title').off('click');

                $('.footer-section .elementor-accordion-item .elementor-accordion-title').click(function (event) {
                    event.preventDefault();
                });
            }
            ;

            if ($(window).width() <= 1024 && $('.footer-section .elementor-accordion-item .elementor-tab-title').hasClass('elementor-active')) {
                $('.footer-section .elementor-accordion-item .elementor-tab-title').removeClass('elementor-active');
                $('.footer-section .elementor-accordion-item .elementor-tab-content').hide();
            }

            var updateUnderLine = function(scrollLeft) {
                var activeProduct = $('.tab-slider .slider-header .slider-menu-bar .slider-menu-item a.active')
                var activeProductBar = $('.tab-slider .slider-header .slider-menu-bar .transition-bar .underline')
                var offset = $(window).width() < 768 ? 10 : 0;
                if(!activeProduct.length) return;
                activeProductBar.css('left', activeProduct.position().left - offset + (scrollLeft ? scrollLeft : 0));
                activeProductBar.css('width', activeProduct.width());
            };

            var updateTabDisplay = function(productTab) {
                var productTabList = $('.tab-slider .slider-header .slider-menu-bar .slider-menu-item a');
                var contentList = $('.tab-slider .sliding-section');
                productTabList.removeClass('active');
                $(productTab).addClass('active');
                contentList.hide();
                contentList.removeClass('active');
                var selectedContent = $('.tab-slider .sliding-section.' + $(productTab).attr('id'));
                selectedContent.css('display', 'inline-flex');
                selectedContent.addClass('active');
            };

            updateUnderLine(null);

            $('.tab-slider .slider-header .slider-menu-bar .slider-menu-item a').click(function (e) {
                e.preventDefault();
                updateTabDisplay(this);
                updateUnderLine($('.slider-menu-bar').scrollLeft());
            });

            updateTabDisplay($('.tab-slider .slider-header .slider-menu-bar .slider-menu-item a.active')[0]);

            $(window).resize(function () {
                updateUnderLine($('.slider-menu-bar').scrollLeft());
            });

            $(".arrow-previous").click(function () {
                var leftPos = $('.slider-menu-bar').scrollLeft();
                $(".slider-menu-bar").animate({scrollLeft: leftPos - 200}, 800);
            });

            $(".arrow-next").click(function () {
                var leftPos = $('.slider-menu-bar').scrollLeft();
                $(".slider-menu-bar").animate({scrollLeft: leftPos + 200}, 800);
            });
        });

        function addEvent(obj, evt, fn) {
            if (obj.addEventListener) {
                obj.addEventListener(evt, fn, false);
            }
            else if (obj.attachEvent) {
                obj.attachEvent("on" + evt, fn);
            }
        }

        var $contentWrap = $('.js-exit-intent-popup .slide-contents-wrap .slide-contents');
        var content = ".slide-content";

        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }

        function moveQuiz(withTimeOut = true){
            origin = $contentWrap.position().left;
            var width = $contentWrap.find(content).outerWidth();
            var left = origin - width;

            $contentWrap.css('transform','translate3d('+ left +'px,0px,0px)');
            if(withTimeOut){
                $contentWrap.css('transition-duration','0.5s');
            }
        }

        function pushEventStarted(){
            $.ajax({
                url: 'https://shop.doordevil.com/p1/email.php',
                method: 'GET',
                data: {
                    url : window.location.href,
                    action: 'event_started'
                },
                success : function(response){

                }
            })
        }

        function pushEventCompleted(){
            $.ajax({
                url: 'https://shop.doordevil.com/p1/email.php',
                method: 'GET',
                data: {
                    url : window.location.href,
                    action: 'event_completed'
                },
                success : function(response){

                }
            })
        }

        function toggleExitIntentPopop(){
            /*if(window.location.href.includes((window.location.origin + '/select/'))){
                var urlParams = new URLSearchParams(window.location.search);
                if(urlParams.get('seen') === "true"){
                    elementorProFrontend.modules.popup.showPopup( { id: 8428 } );
                }else{
                    $('.js-exit-intent-popup').toggleClass('show');
                    pushEventStarted();
                    if(urlParams.has('email') && isEmail(urlParams.get('email'))){
                        $('.exit-intent-popup-content .input-wrap input#email').val(urlParams.get('email'));
                        moveQuiz(false);
                    }
                    if(urlParams.has('mobile')){
                        $('.exit-intent-popup-content .input-wrap input#mobile').val(urlParams.get('mobile'));
                        pushData(urlParams.get('email'), urlParams.get('mobile'));
                        moveQuiz(false);
                    }
                }
            }*/
            //elementorProFrontend.modules.popup.showPopup( { id: 8428 } );
        }

        // Exit intent trigger

        var exit_intent_shown = false;

        addEvent(document, 'mouseout', function(evt) {

            if (evt.toElement == null && evt.relatedTarget == null && !exit_intent_shown) {
                exit_intent_shown = true;
                toggleExitIntentPopop()
            };

        });

        $('.js-exit-intent-popup .js-popup-exit').click(function(e){
            e.preventDefault();
            toggleExitIntentPopop()
        });

        $('.js-exit-intent-popup .footer-links a').click(function(e){
            e.preventDefault();
            toggleExitIntentPopop()
        });

        $(window).scroll(function() {
            wH = $(window).height(),
                wS = $(this).scrollTop();
            dH = $(document).height();

            if((dH/2) < wS && $(window).width() < 992 && !exit_intent_shown){
                exit_intent_shown = true;
                toggleExitIntentPopop()
            }
        });

        const idleDurationSecs = 30;
        let idleTimeout;

        const resetIdleTimeout = function() {
            if(idleTimeout) clearTimeout(idleTimeout);
            idleTimeout = setTimeout(() => {
                if(!exit_intent_shown  && $(window).width() < 992){
                    exit_intent_shown = true;
                    toggleExitIntentPopop()
                }
            }, idleDurationSecs * 1000);
        };

        resetIdleTimeout();

        ['click', 'touchstart', 'mousemove'].forEach(evt =>
            document.addEventListener(evt, resetIdleTimeout, false)
        );

        $(window).resize(function () {
            $contentWrap.find(content).css('max-width',$('.js-exit-intent-popup .slide-contents-wrap').width());
        });

        function pushData(email, phone){
            $.ajax({
                url: 'https://shop.doordevil.com/p1/email.php',
                method: 'GET',
                data: {
                    email : email,
                    phone : phone,
                    id : $('.campaign-form').data('id'),
                    action : 'update_phone'
                },
                success : function(response){
                    if(response.result_code == 1){
                        pushEventCompleted();
                        moveQuiz();
                        return;
                    }
                }
            })
        }

        function pushEmail(email){
            $.ajax({
                url: 'https://shop.doordevil.com/p1/email.php',
                method: 'GET',
                data: {
                    email : email,
                    tag : 'exit-intent-p1',
                    action : 'add_email'
                },
                success : function(response){
                    if(response.result_code == 1){
                        $('.campaign-form').data('id',Object.values(response)[0])
                        vgo('setEmail', email);
                        moveQuiz();
                        return;
                    }else if(Object.values(response)[0] && Object.values(response)[0].id){
                        $('.campaign-form').data('id',Object.values(response)[0].id)
                        vgo('setEmail', email);
                        moveQuiz();
                        return;
                    }
                }
            })
        }


        $('.js-exit-intent-popup .quiz-mover').click(function(e){

            e.preventDefault();

            if($(this).data('model') === 'email'){

                var $email = $('.js-exit-intent-popup #email');

                if($email.val() == ""){
                    return;
                }

                if(!isEmail($email.val())){
                    return;
                }

                $('.campaign-form').data('email',$email.val());
                pushEmail($('.campaign-form').data('email'));

            }else if($(this).data('model') === 'mobile'){

                var $mobile = $('.js-exit-intent-popup #mobile');

                if($mobile.val() == ""){
                    return;
                }

                $('.campaign-form').data('mobile', $mobile.val());

                pushData($('.campaign-form').data('email'), $('.campaign-form').data('mobile'));
            }

        });

        $('.js-exit-intent-popup .goto-select').click(function(e){

            e.preventDefault();

            $('.js-exit-intent-popup').toggleClass('show');
        });

        $(document).click(function(e){
            if(e.target===$('.js-model')[0] || e.target===$('.js-model')[1]){
                $('.js-model').hide();
            }
        });
    });
}(jQuery));
