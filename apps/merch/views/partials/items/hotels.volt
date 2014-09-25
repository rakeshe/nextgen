{% if city is not defined %}
{% set city = false %}
{% endif %}
{% if country is defined and country != "" %}
<div class="row">
<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 bread-crumb-location">
<ul class="bread-crumb-Links">
    {% set cntFlag = false %}
    {{cntFlag}}
    {% set ddLength = DDMenue[region][country] | length -2 %}
    {% set ddCounter = 1%}
    {% for key, citys in DDMenue[region][country] %}
        {% if key != "name" and key != "sort" %}
        {% if cntFlag == false %}
        <li class="bread-crumb-first-li{% if city == false %} bread-crumb-li-selected{%endif%}">
            <a href="{{ uriBase }}/{{ region }}/{{ country }}">{{ country }}&nbsp;&nbsp;&nbsp;>></a>
        </li>
        {% set cntFlag = true %}
        {% endif %}      
        <li class="{% if ddLength == ddCounter %}bread-crumb-last-li{% else %}bread-crumb-li{%endif%}{% if key == city %} bread-crumb-li-selected{%endif%}">
            <a href="{{ uriBase }}/{{ region }}/{{ country }}/{{ key }}">{{ key }}</a>
        </li>
        {% set ddCounter = ddCounter + 1 %}
        {% endif %}
    {% endfor %}   
</ul>
</div>
</div>
{% endif%}
<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->
<div class="clearfix"></div>
<div id="hotelList" class="">
<div class="row">
<!-- Visible Desktop/Tablets Hotel Item List -->
    
<div class=" tab-pane active" id="tab1">
<!--Forloop Starts-->

<!-- TAB 2 -->
<div class=" tab-pane" id="tab2">
<!--Forloop Starts-->

<!-- SET OF HOTELS-->
{% if( isArray(hotels)) %}
        {% for index, hls in hotels %}            
        
<div class="hotelDeal col-xs-12 col-sm-12 col-md-6 col-lg-6" style="cursor: default;">
    <div class="row">
        <div class="image_section col-xs-4 col-sm-5 col-md-5" id="image_section">
            <a>
                <div>
                    <img src="{{ HotelHelper.getClassicHotelImageUri(hotelDetails[index]['oneg']) }}"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                    <div class=" hidden-xs hotel-image-text" style="">
                        <div class="location-text">{{hotelDetails[index]['country']}}</div>
                        <div class="ce-star star4">
                            <img src="{{ HotelHelper.getStarUri(hotelDetails[index]['rank_country']) }}"
                                 class="img-responsive" id="image_hotel" alt="Responsive image" width=""
                                 height=""/>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="middle-offer-section col-xs-5 col-sm-5 col-md-4">
            <div class="hotelInfo">
                <h3>
                    <!-- HOTEL NAME -->
                    <a>
                        <div class="hidden-sm purple-color" title="{{hotelDetails[index]['name']}}">
						{{substr(hotelDetails[index]['name'],0,11)}}
						{% if hotelDetails[index]['name']|length >=  11 %}
						  ...
						{% endif %}
						
						</div>
						<div title="{{hotelDetails[index]['name']}}" class="visible-sm purple-color">
						{{hotelDetails[index]['name']}}
												
						</div>
                    </a>
                </h3>
				 <div class=" clearfix visible-xs hotel-image-text" style="">
				  <div class="rating">
                    <img src="{{ HotelHelper.getStarUri(hotelDetails[index]['rank_country']) }}"
                                 class="img-responsive" id="image_hotel" alt="Responsive image" width=""
                                 height=""/>
                        </div>
					<div class="hotel-image-text">
						<div class="location-text">{{hotelDetails[index]['country']}}</div>
					</div>
				 </div>
                <div class="hidden-xs campaign-promo-offer">{{hotelDetails[index]['promo_offer']}}</div>
                <input type="hidden" value="Save 50%" id="hotel_inc1_1149971">

                <div class="members-extras-block">
                    <!-- The Big Red Plus Sign -->
                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">

                    <div class="font_red member-extras-text">Member Extras</div>
                </div>
                <div class="sign-in-member-offer offer-for-existing-members font_red">{{hotelDetails[index]['promo_offer']}}</div>
                <div class="sign-out-member-offer" style="display: none;">
                    <span>
                            <!-- Show_JoinHotelClub_Popup()-->
                            <p>Freebies Included</p>
                            <p>Find out more &gt;&gt;</p>
                    </span>
                </div>
            </div>
        </div>

        <div class="saveBookInfo col-xs-3 col-sm-2 col-md-2">
            Save<br> <span class="percentage">{{hotelDetails[index]['discount']}}%</span>

            <div class="clearfix "></div>
            <div class="btn button">
                <a>Book</a>
            </div>
            <br>

            <p class="inclusions">{{hotelDetails[index]['conditions']}}</p>
        </div>
    </div>
    <div class="clearfix "></div>
</div>
<!-- SET OF HOTELS-->
{% endfor %}
    {% endif %}



    </div>
    
    <!--Forloop Ends-->

    <!-- /Visible Phone Hotel Item List -->

</div>
<!-- /Hotel List -->

<!-- END VIEW PARTIAL: hotel/item list -->
</div>
</div>