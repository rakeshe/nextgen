{% if city is not defined %}
{% set city = false %}
{% endif %}
{% if country is defined and country != "" %}
<div class="row">
    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 bread-crumb-location">
        <ul class="bread-crumb-Links">
            {% if DDMenue[region][country] is defined%}
                {% set cntFlag = false %}           
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
            {% endif %}
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
                                    <img src="{{ HotelHelper.getClassicHotelImageUri(hls['oneg']) }}"
                         class="img-responsive" id="image_hotel" alt="Responsive image" width="180" height="120"/>
                                    <!--<img src="http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_1149971.jpg" class="hotelimg" />-->
                                    <div class=" hidden-xs hotel-image-text" style="">
                                        <div class="location-text">{{hotelDetails[index]['country_name']}}</div>
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
                                        <div class="hidden-sm purple-color" title="{{hotelDetails[index]['hotel_name']}}">
                                            {{substr(hotelDetails[index]['hotel_name'],0,11)}}
                                            {% if hotelDetails[index]['hotel_name']|length >=  11 %}
                                            ...
                                            {% endif %}
						
                                        </div>
                                        <div title="{{hotelDetails[index]['hotel_name']}}" class="visible-sm purple-color">
                                            {{hotelDetails[index]['hotel_name']}}
												
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
                                        <div class="location-text">{{hotelDetails[index]['country_name']}} </div>
                                    </div>
                                </div>
                                {% set discount="0" %}
                                {% for key, offer in hotelDetails[index]['offer'] %}
                                <div class="hidden-xs campaign-promo-offer">                    
                                    {{ offer['offer_text'] }}
                                    {% set discount=offer['percent_off'] %}
                                </div>   
                                {% endfor %}

                                <div class="members-extras-block">
                                    <!-- The Big Red Plus Sign -->
                                    <img class="members-extras-logo img-responsive" alt="Member Rewards"
                         src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">
                                        <div class="font_red member-extras-text">{{ t._('mem_extras')}}</div>
                                </div>
                                {% for key, offer in hotelDetails[index]['offer_moo_t'] %}
                                <div class="sign-in-member-offer offer-for-existing-members font_red">
                                    {{ offer['offer_moo_text'] }}
                                </div>
                                {% endfor %}
                                <div class="sign-out-member-offer" style="display: none;">
                                    <span>
                                        <!-- Show_JoinHotelClub_Popup()-->
                                        <p>{{ t._('mem_inactive_line1') }}</p>
                                        <p>{{ t._('mem_inactive_line2') }} &gt;&gt;</p>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="saveBookInfo col-xs-3 col-sm-2 col-md-2">
                            {{ t._('Save') }}<br> 
                                <span class="percentage">{{ discount }}%</span>

                                <div class="clearfix "></div>
                                <div class="btn button">
                                    <a>{{t._('book')}}</a>
                                </div>
                                <br>

                                    <p class="inclusions">{{hotelDetails[index]['travel_text']}}</p>
                        </div>
                    </div>
                    <div class="clearfix "></div>
                </div>
                <!-- SET OF HOTELS-->
                {% endfor %}
                {% else %}
                <div>Offers are subject to availability and may change without notice prior to reservation confirmation. Specific offer terms and conditions are available on the website. Rates may not be available on some peak dates.</div>
                {% endif %}
            </div>    

        </div>
    </div>
</div>