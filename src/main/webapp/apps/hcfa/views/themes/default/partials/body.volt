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
                           <div class="row" style="color:#ff0000;" id="error-message-val"> {{ m }} </div>
                        {% endfor  %}
						<div class="error-message" style="color:#ff0000;"></div>

                        <form action="register" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                            {% for element in form %}
                                    {{ element }}
                            {% endfor %}
                            {{ submit_button("Register now", "class": "button-primary", "id": "btn-register") }}
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