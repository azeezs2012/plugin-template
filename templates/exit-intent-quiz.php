<?php

?>

<div class="popup-model js-exit-intent-popup js-model">
    <div class="exit-intent-popup-content">
        <span class="popup-close text-white js-popup-exit"><span class="dashicons dashicons-no-alt"></span></span>
        <div class="content h-100 campaign-form">
            <div class="row section-container h-100">
                <div class="col-md-6 image-section section h-100 w-50 d-flex aligncenter justify-content-center">
                    <img src="<?php echo plugin_dir_url(COMMON_DOORDEVIL_PLUGIN) . 'assets/images/gift_icon_mod.svg' ?>" alt="">
                </div>
                <div class="h-100 w-50 w-sm-100 col-md-6 quiz-section section d-flex flex-column justify-content-center align-items-center text-white text-center p-0">
                    <div class="slide-contents-wrap h-100">
                        <div class="slide-contents slideshow-container h-100">
                            <div class="slide-content h-100">
                                <div class="align-items-center d-flex flex-column h-100 justify-content-center row">
                                    <div>
                                        <p class="qualify">You qualify for a</p>
                                        <h1 class="offers text-white">Mystery Offer</h1>
                                        <p class="email">Enter your email below & be one step closer to the big reveal!</p>
                                    </div>
                                    <div class="input-wrap">
                                        <div action="" class="d-flex flex-column">
                                            <input type="text" placeholder="Email address" id="email" name="email">
                                            <a href="#" id="submit-email" class="quiz-mover" data-model="email">unlock your offer</a>
                                        </div>
                                    </div>
                                    <div class="footer-note position-absolute ">
                                        <a class="text-decoration-none text-uppercase text-white js-popup-exit" href="">No Thanks</a>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-content h-100">
                                <div class="align-items-center d-flex flex-column h-100 justify-content-center row">
                                    <div>
                                        <p class="qualify">You qualify for a</p>
                                        <h1 class="offers text-white">Mystery Offer</h1>
                                        <p class="email">Text with us to reveal your code</p>
                                    </div>
                                    <div class="input-wrap">
                                        <div action="" class="d-flex flex-column">
                                            <input type="text" placeholder="Mobile number" id="mobile" name="mobile" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                            <a href="#" id="submit-email" class="quiz-mover" data-model="mobile">unlock your offer</a>
                                        </div>
                                    </div>
                                    <div class="policy-wrap">
                                        <P class="policy">
                                            Buy signing up via text, you agree to receive recurring automated
                                            marketing messages at the phone number provided. Consent is not
                                            a condition of purchase. Reply STOP to unsubscribe. Msg & data
                                            rates may apply. View our <a href="">Privacy Policy.</a> and
                                            <a href="">Terms of Service.</a>
                                        </P>
                                    </div>
                                </div>
                            </div>
                            <div class="slide-content h-100">
                                <div class="align-items-center d-flex flex-column h-100 justify-content-center row">
                                    <div class="sider-3">
                                        <h1 class="offers">Check your texts</h1>
                                        <p class="email">Reply "Y" to access your savings</p>
                                    </div>
                                    <div class="shop-wrap">
                                        <a href="http://doordevil.com/select" class="text-uppercase text-decoration-none goto-select" id="shop">Shop Now</a>
                                    </div>
                                    <div class="footer-note position-absolute ">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
