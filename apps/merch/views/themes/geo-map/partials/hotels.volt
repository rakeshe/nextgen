<script type="text/javascript">
var deals = JSON.parse('{{ hotelDetailsJson }}'),
camp = '{{ campaignData }}',
trans = {'mem_extras':'{{t._("mem_extras")}}', 'mem_inactive_line1':'{{t._("mem_inactive_line1")}}',  'mem_inactive_line2':'{{t._("mem_inactive_line2")}}', 'Save':'{{t._("Save")}}', 'book':'{{t._("book")}}'},
lang = '{{languageCode}}',
campName = '{{ campaignName }}';
</script>
{% if city is not defined %}
{% set city = false %}
{% endif %}
{% if country is defined and country != "" %}
{% endif%}
<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->
<div class="clearfix">
	<div id="hotel_card_block">
		<div id="hotel_card_search">
			<div class="world_best_deals">World best deals</div>
			<div class="hotel_all_search"><img src="/themes/common/img/search.jpeg" width="15"/>Search all HotelClub<b class="caret"></b></div>
		</div>
		{% if( isArray(hotels)) %}
	        {% for index, hls in hotels %} 
		<div class="hotel_cards">
			<div class="hotel_cards_heading">
				<span>
                     <a class="hotel_name">
                             {{substr(hotelDetails[index]['hotel_name'],0,11)}}
                             {% if hotelDetails[index]['hotel_name']|length >=  11 %}
                             ...
                             {% endif %}                         
                     </a>
				</span>
				<span class="hotel_city">{{hotelDetails[index]['country_name']}}</span>
				<span class="hotel_review"><img src="{{ HotelHelper.getStarUri(hotelDetails[index]['rank_country']) }}"                                class="img-responsive" alt="hotel rank" width="" height=""/></span>
			</div>
			<div>
				<div id="hotel_image">
					<img src="{{ HotelHelper.getClassicHotelImageUri(hls['oneg']) }}"
                                    class="img-responsive" id="image_hotel" alt="" width="162" height="120"/>
				</div>
				<div id="hotel_content">
					{% set discount="0" %}
					{% for key, offer in hotelDetails[index]['offer'] %}
					<div class="hidden-xs campaign-promo-offer">
						{{ offer['offer_text'] }}
		                                {% set discount=offer['percent_off'] %}
					</div>
					{% endfor %}
					<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png">
					<div class="font_red member-extras-text">
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
					<span class="percentage hc-percentage">{{ discount }}%</span>
					<div class="clearfix "></div>
					<div class="btn button">
						<a class="ht-book" data-oneg="{{hls['oneg']}}">{{t._('book')}}</a>
					</div>
					<br>
					<p class="inclusions">{{hotelDetails[index]['travel_text']}}</p>
				</div>
			</div>
		</div>
		<!-- SET OF HOTELS-->
                {% endfor %}
                {% else %}
                <div>Offers are subject to availability and may change without notice prior to reservation confirmation. Specific offer terms and conditions are available on the website. Rates may not be available on some peak dates.</div>
                {% endif %}		
	</div>		
</div>
<div class="search_footer">
	<div class="search_footer_head">
		<span class="search_not_found">Not found what you're looking for?</span>
		<span class="search_plus"><img src="/themes/common/img/plus.png"/></span>
	</div>
	<input type="text" value="Search all HotelClub" name="search_input_footer" class="search_input_footer"/>
	<div class="search_hotel_near">
		<img src="/themes/common/img/marker.png"/> Nearby tonight <b>></b>
	</div>
</div><br/>
<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable" id="check_in_dates" style="outline: 0px none; z-index: 1002; height: auto; width: 360px; top: 711px; left: 452px; display: none;" tabindex="-1" role="dialog" aria-labelledby="ui-id-1" >
	<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
		<span id="ui-id-1" class="ui-dialog-title">{{ t._('check_rates') }}</span>
		<div class="close_btn"><a href="" class="ui-dialog-titlebar-close ui-corner-all" onclick role="button"><span class="ui-icon ui-icon-closethick">close</span></a></div>
	</div>
	<div class="ui-dialog-content ui-widget-content" id="choseDates" style="display: block; width: auto; min-height: 0px; height: 246px;" scrolltop="0" scrollleft="0">
		<form method="get" name="searchBot">
			<div class="datepicker" id="choseDatesBox">
				<div id="choseDatesBoxHotelInfo"><input type="hidden" value="Cairns" id="hotel_location"></div>
				<div id="choseDatesDates">
					<div class="checkin">
						 <p>{{ t._('check_in') }}</p>
						<input type="text" id="choseDatesStartDate" value="" class="minDate datepicker">
					</div>
					<div class="checkout">
						 <p>{{ t._('check_out') }}</p>
						<input type="text" id="choseDatesEndDate" value="" class="maxDate datepicker">
					</div>
					<div class="extraSelNights"></div>
					<div class="searchbtn">
						<input type="button" class="bigBtn" onclick="ChoseDates(this.form)" value="{{ t._('search') }}" name="search" id="choseDatesSearchBtn">
					</div>
				</div>
				<div class="errorMessage">&nbsp;</div>
			</div>
		</form>
	</div>
</div>