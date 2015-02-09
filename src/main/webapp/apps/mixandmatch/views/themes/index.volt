<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Foodcation</title>
    <meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
    <meta name="description" content="Enter for a chance to win a $2500 HotelClub vaction & $2500 in Menulog vouchers.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta property="og:title" content="HotelClub & Menulog Foodcation - Mix & Match competition" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://foodcation.co/index.html" />
    <meta property="og:image" content="http://foodcation.co/assets/img/social-share.jpg" />
    <meta property="og:description" content="Enter for a chance to win a $2500 HotelClub vaction & $2500 in Menulog vouchers." />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@HotelClub" />
    <meta name="twitter:title" content="HotelClub & Menulog Foodcation - Mix & Match competition" />
    <meta name="twitter:description" content="Enter for a chance to win a $2500 HotelClub vaction & $2500 in Menulog vouchers." />
    <meta name="twitter:image" content="http://foodcation.co/assets/img/social-share.jpg" />
    <meta name="twitter:url" content="http://foodcation.co/index.html" />
    <link href="{{ theme }}assets/favicon.ico" type="image/x-icon" rel="shortcut icon" />
    {{ stylesheet_link(theme ~ 'assets/css/style.css?' ~ appVersion ) }}
    {{ stylesheet_link(theme ~ 'assets/css/owl.carousel.css?' ~ appVersion ) }}
    {{ stylesheet_link(theme ~ 'assets/css/jquery-ui.min.css?' ~ appVersion ) }}
    {{ javascript_include(theme ~ 'assets/js/libs/modernizr-2.7.1.min.js?' ~ appVersion ) }}
    <script type="text/javascript">var switchTo5x=true, T_PATH = "{{ theme }}";</script>
    <script src="https://apis.google.com/js/client:platform.js" async defer></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-55814310-2', 'auto');
        ga('send', 'pageview');
    </script>
</head>

<body>
<div class="mobile-lands" style="display:none;">
    <img src="{{ theme }}assets/img/or.png" width="128" height="128">
    <p>Best viewed in portrait mode. Please switch back to portrait orientation.</p>
</div>

<div class="logo">
    <img src="{{ theme }}assets/img/logo.png" alt="">
</div>

<div id="container" class="clear">
    <!-- LOGIN SCREEN -->
    <div id="screen-1" role="main" class="active-page section clear screen-1">
        <div class="logo mobile">
            <img src="{{ theme }}assets/img/logo.png" alt="">
        </div>
        <div class="col-left">
            <div class="bg-image">
                <div class="img b-lazy" data-src="{{ theme }}assets/img/login-bg-1.jpg" data-src-small="{{ theme }}assets/img/login-bg-1-mobile.jpg"></div>
            </div>
        </div>
        <div class="col-right">
            <div class="bg-image">
                <div class="img b-lazy" data-src="{{ theme }}assets/img/login-bg-sg.jpg" data-src-small="{{ theme }}assets/img/login-bg-sg-mobile.jpg"></div>
            </div>
        </div>
        <div class="login-box clear">
            <img src="{{ theme }}assets/img/login-head.png" alt="" class="head">
            <p>Mix &amp; match your foodcation for a chance to win a $2500 HotelClub vacation + $2500 in Menulog takeaway vouchers.</p>
            <span class="enter">Enter now</span>
            <a href="#" class="btn fb-btn facebook-login"><span>Enter with facebook</span></a>
            <p>OR</p>
            <form action="" class="clear">
                <span id="error-email-message">Please enter valid email.</span>
                <input type="email" name="email" placeholder="Enter your email" id="email-textbox">


                <div class="clear"></div>
                <a href="#" class="btn form-btn"><span>Enter now</span></a>
            </form>
                <span class="pro_txt">By providing your email address Menulog and HotelClub may email you great offers. You can unsubscribe at any time.
                   <a href="https://static.cdn.responsys.net/i5/responsysimages/content/hotelclb/Foodcation_TCs.pdf" target="_blank">Terms and conditions.</a>
           
                </span>
        </div>
    </div>
    <!-- END - LOGIN SCREEN -->


    <!-- SELECTION SCREEN -->

    <div id="screen-2" class="clear section screen-2">
        <div class="col-left col-red">
            <input type="hidden" id="selected-place" value="bali">
            <h3 class="side-title hide"><span>STEP 1</span> Select destination</h3>
            <div id="places-slide" class="owl-carousel"></div>
        </div>
        <div class="col-right col-green">
            <input type="hidden" id="selected-food" value="">
            <h3 class="side-title hide"><span>STEP 2</span> Select your food</h3>
            <div id="look-slide" class="owl-carousel"></div>
        </div>
        <div class="nextcont">
            <button type="submit" class="step2nextbtn btn2"><span>next</span></button>
        </div>
    </div>
    <!-- END - SELECTION SCREEN -->

    <!-- SELECTION SCREEN -->
    <div id="screen-3" class="clear section screen-3">
        <input type="hidden" value="" id="resLoc">
        <input type="hidden" value="" id="resLoook">
        <div class="top-result">
            <div class="rel-wrap clear">
                <div class="col-left col-red">
                    <h3 class="side-title hide">
                        Your destination is
                        <span id="result-locaion"></span>
                    </h3>
                    <div class="bg-image">
                        <div class="img result-location-image"></div>
                    </div>
                </div>
                <div class="col-right col-green">
                    <h3 class="side-title hide">
                        Your matching food is
                        <span id="result-look"></span>
                    </h3>
                    <div class="bg-image">
                        <div class="img result-look-image"></div>
                    </div>
                </div>
            </div>

            <div class="rNote"><span>Almost done. One more step for your chance to win. Good luck!</span></div>
        </div>

        <div class="fina-form">
            <form action="" class="clear" name="hotel_club_form" id="hotel_club_form" method="post">
                <p>In 25 words or less tell us why you mixed and matched your dream foodcation.</p>
                <textarea tabindex="1" name="answer" id="answer" cols="30" rows="5" placeholder="Enter your Answer*"></textarea>
                <p>Fill in your details for your chance to win!</p>

                <span class="input-l"><input  type="text" value="" placeholder="Your first name" id="first_name" name="first_name" tabindex="2"></span>
                <span class="input-r"><input  type="text" value="" placeholder="Your last name" id="last_name" name="last_name" tabindex="3"></span>
                <span class="input-l"><input  type="text" value="" placeholder="Your Suburb" id="suburb" name="suburb" maxlength="12" tabindex="4"></span>
                <input type="hidden" name="hidden-email" id="hidden-email"/>
                <input type="hidden" name="hidden-selected-place" id="hidden-selected-place"/>
                <input type="hidden" name="hidden-selected-food" id="hidden-selected-food"/>
                   <span class="input-r dropdown-slide3">
                   <select tabindex="5" id="state" name="state">
                       <option value="">State</option>
                       <option value="QLD">QLD</option>
                       <option value="NSW" >NSW</option>
                       <option value="VIC" >VIC</option>
                       <option value="ACT" >ACT</option>
                       <option value="SA" >SA</option>
                       <option value="WA" >WA</option>
                   </select>
                   </span>

                <button type="submit" class="btn2" tabindex="6"><span>Enter now</span></button>

            </form>
            <p>To change your selection <a href="#screen-2" class="new-selection">go back.</a></p>
        </div>
    </div>
    <!-- END - SELECTION SCREEN -->

    <!-- SELECTION SCREEN -->
    <div id="screen-4" class="clear section screen-4">
        <div class="col-left">
            <h4>Success! Your entry has been received,<br> thank you.</h4>
            <div class="final-shot clear">
                <img src="{{ theme }}assets/img/final-shot.jpg" class="final-shot-img"alt="">
                <span class="f-tip"></span>
            </div>
            <p class="s-txt s-txt-ipad">Why not tell your friends about your foodcation. <br>
                What's theirs? Share and find out.</p>
                    
                    <span class="share-ics share-ics-ipad clear">
                      <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://foodcation.co/index.html" class="facebook_share"><span class='st_facebook_custom i-fb'></span></a>
                     <!-- Replace link for your url at the end of href in url parameter-->
                      <a target="_blank" class="twitter-share-button"  href="https://twitter.com/share?url=http://foodcation.co/index.html?t=1234567" target="_blank"><span class='st_twitter_custom i-twt'></span></a>
                      <a target="_blank" href="https://plus.google.com/share?url=http://foodcation.co/index.html"><span class="st_googleplus_custom i-plus"></span></a>
                    </span>
        </div>
        <div class="col-right">
            <div class="coupon cp-1 zol">
                <div class="coupon-inner" style="background-image: url('{{ theme }}assets/img/cp-1.png')">
                    <a href="https://play.google.com/store/apps/details?id=com.menulog.m&hl=en" class="google-play"></a>
                    <a href="https://itunes.apple.com/au/app/menulog-order-takeaway-food/id327982905?mt=8" class="app-store"></a>
                    <div class="clear"></div>
                    <span class="promo-code">FOODCATION</span>
                    <a class="shop-link" href="http://www.menulog.com.au/" target="_blank"></a>
                </div>
            </div>
            <div class="coupon cp-2 hoc">
                <div class="coupon-inner" style="background-image: url('{{ theme }}assets/img/cp-2.png')">
                    <a href="https://play.google.com/store/apps/details?id=com.hotelclub" class="google-play"></a>
                    <a href="https://itunes.apple.com/au/app/hotelclub-hotel-booking-hotel/id580254072" class="app-store"></a>
                    <div class="clear"></div>
                    <span class="promo-code">FOODCATION</span>
                    <a class="shop-link" href=" http://www.hotelclub.com/?type=hotel&hotel.couponCode=FOODCATION&WT.mc_id=16667&WT.mc_ev=emailclick&WT.tsrc=email" target="_blank"></a>
                </div>
            </div>
        </div>

    </div>
    <!-- END - SELECTION SCREEN -->


</div>


{{ javascript_include(theme ~ 'assets/js/libs/jquery-1.11.0.min.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'assets/js/libs/blazy.min.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'assets/js/libs/owl.carousel.min.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'assets/js/script.js?2014100801&'~ appVersion) }}
{{ javascript_include(theme ~ 'assets/js/libs/jquery-ui.min.js?' ~ appVersion ) }}
{{ javascript_include(theme ~ 'assets/js/libs/jquery.validate.js?' ~ appVersion ) }}
<!--[if lt IE 7 ]>
{{ javascript_include("//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js",false) }}
<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->

<!-- version 1.12 -->
</body>
</html>