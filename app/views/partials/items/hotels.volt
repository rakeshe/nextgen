{#@todo only list hotels avail to current tab
> pageData['hotels'] with onegs as index
> pageData['tabs']#}
<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

<div class="clearfix"></div>
<div id="hotelList" class="subContainer">
<div class="row">
<!-- Visible Desktop/Tablets Hotel Item List -->
<div class="tab-content hidden-phone">
<div class=" tab-pane active" id="tab1">
<!--Forloop Starts-->
{% if not(pageData['activeTab']['onegs'] is empty) %}
    {% for oneg in pageData['activeTab']['onegs'] if hotels[oneg] is defined %}
<div id="hotel-{{ oneg }}" class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-xs-4 col-md-5" id="image_section">
            <a>
                <img src="/img/hotels/{{ hotel['img'][0] }}" class="img-responsive"
                     id="image_hotel" alt="Responsive image"/>

                <div class="hotel-image-text">
                    <div class="location-text">{{ hotel['location'] }}</div>
                    <div class="star4">
                        <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                             class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                             height="12"/>
                    </div>
                </div>

            </a>
        </div>

        <div class="middle-offer-section col-xs-8 col-md-7">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">{{ hotel['name'] }}</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save {{ hotel['dicount_percent'] }}%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_{{ oneg }}">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">{{ hotel['promo_offer'] }}</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
            <div class="saveBookInfo col-xs-4 col-md-2">
                Save<br> <span class="percentage">50%</span>

                <div class="clearfix "></div>
                <div class="btn button">
                    <a>Book</a>
                </div>
                <br>

                <p class="inclusions">{{ hotel['conditions'] }}</p>
            </div>
        </div>


    </div>
    <div class="clearfix "></div>
</div>
    {%  endfor %}
{% endif %}
<!--Forloop Ends-->
</div>


<!-- TAB 2 -->
<div class=" tab-pane" id="tab2">
<!--Forloop Starts-->
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_307928.jpg"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Austalia</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Landmark Hotel</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
														<span>
															<!-- Show_JoinHotelClub_Popup()-->
															<p>Freebies Included</p>
															<p>Find out more &gt;&gt;</p>
														</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<!--Forloop Ends-->
</div>

<div class=" tab-pane" id="tab3">
<!--Forloop Starts-->
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_316563.jpg"
                         class="img-responsive" alt="Responsive image" id="image_hotel" width="180" height="120"/>

                    <div class="hotel-image-text">
                        <div class="location-text">UK</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="purple-color" title="Mode Sathorn Hotel">Jupiters Hotel and ...</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<!--Forloop Ends-->
</div>
<div class="tab-pane" id="tab4">
<!--Forloop Starts-->
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<div class="hotelDeal col-xs-12 col-md-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-md-5" id="image_section">
            <a>
                <div>
                    <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_23106.jpg" class="img-responsive"
                         id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class="hotel-image-text">
                        <div class="location-text">Bangkok</div>
                        <div class="star4">
                            <img src="http://www.hotelclub.com/ad-unit/images/ce-hotelstar-brand.png"
                                 class="img-responsive ce-star" id="image_hotel" alt="Responsive image" width="148"
                                 height="12"/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-md-5">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a href="javascript:void(0);">
                        <div class="purple-color" title="Mode Sathorn Hotel">Villa Alessandra</div>
                    </a>
                </h3>
                <div class="campaign-promo-offer">Save 50%</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">Save 55%</div>
                <div class="sign-out-member-offer" style="display: none;">
												<span>
													<!-- Show_JoinHotelClub_Popup()-->
													<p>Freebies Included</p>
													<p>Find out more &gt;&gt;</p>
												</span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-md-2">
            Save<br> <span class="percentage">50%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">Travel: Now - 31/12/2013</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<!--Forloop Ends-->
</div>
</div>
<!-- /Visible Desktop/Tablets Hotel Item List -->
</div>
<!-- Visible Phone Hotel Item List -->

<div class="visible-phone">

    <!--Forloop Starts-->
    <?php for($i=0;$i<=6;$i++){ ?>
    <div id="Phone-Itemcard" class="hotelCard" style="cursor: default;">
        <!-- image -->
        <div class="hote_image" id="image_section">
            <a>
                <img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class=" img-responsive"
                     alt="Hotel Image"/>
            </a>
        </div>
        <!-- details -->
        <div class=" middle-offer-section ">
            <div class="purple-color" title="Mode Sathorn Hotel"><a>Mode Sathorn Hotel</a></div>
            <div class="rating ">
                <img src="img/stars-3.png" class="img-responsive rating-star" id="image_hotel" alt="rating image"/>
            </div>
            <div class="hotel-image-text">
                <div class="location-text">Bangkok</div>
            </div>
            <div class="members-extras-block">
                <!-- The Big Red Plus Sign -->
                <img class="members-extras-logo img-responsive" alt="Member Rewards"
                     src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                <div class="font_red">Member Extras</div>
                <div class="sign-out-member-offer">
                    <p>Freebies Included</p>

                    <p>Find out more &gt;&gt;</p>

                </div>
            </div>
        </div>
        <!-- offer -->

        <div class="deals">
            <div class="offers_rate" style="color:red; padding:3px;">
                <span>save</span>

                <p style="">&nbsp;</p><span class="offers_percentage">80<sup>%</sup></span>
            </div>
            <div class="button_book"><a>Book</a></div>
            <div class="valid_dates">
                <p>Travel dates </p>

                <p>27 june - 27 july </p>
            </div>
        </div>


        <div class="clearfix"></div>
    </div>
    <?php } ?>
    <!--Forloop Ends-->

    <!-- /Visible Phone Hotel Item List -->

</div>
<!-- /Hotel List -->

<!-- END VIEW PARTIAL: hotel/item list -->