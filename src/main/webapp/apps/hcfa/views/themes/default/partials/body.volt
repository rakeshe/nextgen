<div class="content">
    <div class="container">
        <div class="row">
            <span class="intro-txt">Agent incentive program</span>
            <h1>A little extra thanks</h1>
        </div><!-- End Row -->
        <div class="content-box">
            <div class="row">
                <div class="seven columns white-bg">
                    <div class="content-dislay">
                        <h2>We think you're doing an extraordinary job and as a thankyou we'd like to offer you a little something extra.</h2>
                        <p>Register now and every booking you make on HotelClubForAgents.com between XX Month and XX Month we'll reward you with HotelClub Member Rewards for use on HotelClub.com. That's right, we're giving you rewards to use on your next holiday. You'll earn 1% of the total booking value in HotelClub Member Rewards for every booking you make on HotelClubForAgents.com. Register now and get booking. Your next holiday stay could be even more extraordinary.</p>
                        <h3>How it works</h3>
                        <img src="/n/themes/hcfa/images/content/how-it-works.png" class="how-it-works-dsk" />
                        <img src="/n/themes/hcfa/images/content/how-it-works-small.png" class="how-it-works-mob" />
                    </div><!-- End Content Display -->
                </div><!-- End Seven -->
                <div class="five columns">
                    <div class="content-dislay">
                        <h2>Start earning HotelClub<br>
                            Member Rewards</h2>

                        {% for m in msg %}
                           <div class="row" style="color:#ff0000;"> {{ m }} </div>
                        {% endfor  %}

                        <form action="index" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
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
                        <div class="modal-row">
                            <p class="cancel-action"><small>X</small></p>
                            <h3>Terms and Conditions</h3>
                        </div>

                            <div class="modal-row">
                                *Only bookings made on the HotelClubforagents.com website between and including the 1st October and 31st December 2015 will be eligible to earn 1% of the gross booking value in HotelClub Member Rewards under the offer in this email.
                            </div>
                            <div class="modal-row">
                                *This offer is only open to travel agents who are registered users of the HotelClubforagents.com website, who also have a registered membership account on Hotelclub.com and who are located outside of Asia.
                            </div>
                            <div class="modal-row">
                                *Within 30 days of 31st December 2015, HotelClub will calculate and credit the amount of Member Rewards to the eligible Member Rewards account holder you nominated when registering for this offer.
                            </div>
                            <div class="modal-row">
                                *The value of any bookings that are cancelled within this offer period shall be deducted from the total of gross booking value for the purpose of calculating the Member Rewards, and no Member Rewards will be provided in respect of such cancelled bookings.
                            </div>
                            <div class="modal-row">
                                *HotelClub reserves the right to withdraw this offer and cancel any Member Rewards due or that have been provided, if there are signs of fraud, abuse or suspicious activity.
                            </div>
                            <div class="modal-row">
                                *Member Rewards granted pursuant to this offer shall be subject to the HotelClub Membership Terms and Conditions.
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- End Container -->
</div><!-- End Content -->