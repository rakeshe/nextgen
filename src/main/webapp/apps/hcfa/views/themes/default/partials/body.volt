<div class="content">
    <div class="container">
        <div class="row">
            <span class="intro-txt">{{ cms['page_title'] }}</span>
            <h1>{{ cms['body_title'] }}</h1>
        </div><!-- End Row -->
        <div class="content-box">
            <div class="row">
                <div class="seven columns white-bg">
                    <div class="content-dislay">
                        {{ cms['body_content'] }}
                    </div><!-- End Content Display -->
                </div><!-- End Seven -->
                <div class="five columns">
                    <div class="content-dislay">
                        <h2>{{ cms['form_title'] }}</h2>

                        {% for m in msg %}
                           <div class="row" style="color:#ff0000;"> {{ m }} </div>
                        {% endfor  %}

                        <form action="register" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                            <input class="u-full-width" type="text"  name="TA_NAME"  placeholder="Travel agency name" id="AgencyInput">
                            <input class="u-full-width" type="text" name="FNAME" placeholder="Your name" id="NameInput">
                            <input class="u-full-width" type="text" name="TA_ID" placeholder="Travel agent ID" id="IDInput">
                            <input class="u-full-width" type="email" name="EMAIL" placeholder="Your email" id="EmailInput">
                            <input class="u-full-width" type="text" name="PHONE" placeholder="Your phone" id="PhoneInput">
                            <input class="button-primary" type="submit" value="Register now">
                        </form>

                        <!--End mc_embed_signup-->
                    </div><!-- End Content Display -->
                </div><!-- End Five -->
            </div><!-- End Row -->
        </div><!-- Content Box -->
        <div class="row" id="popup-model">
            <div class="modal-wrapper" style="top: 15%; left: 10%; z-index: 999;">
                <div class="modal-box">
                    <div class="modal-container">
                        {{ cms['terms'] }}
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End Container -->
</div><!-- End Content -->