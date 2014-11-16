<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

	<div id="hotel_card_block" class="subContainer">
		<div class="row">
			<div class="world_best_deals col-lg-4">World best deals</div>
			<div class="hotel_all_search col-lg-8"><img src="/themes/common/img/search.jpeg" width="15"/>Search all HotelClub<b class="caret"></b></div>
		</div>
	</div>	
	<div class="hotel_cards_list subContainer">
	<div class="display-cards row"></div>
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
	</div>
	<br/>
	<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable" id="check_in_dates" style="outline: 0px none; z-index: 1002; height: auto; width: 360px;  top: 711px; left: 452px; display: none;" tabindex="-1" role="dialog" aria-labelledby="ui-id-1" >
		<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
			<span id="ui-id-1" class="ui-dialog-title">{{ t._('check_rates') }}</span>
			<div class="close_btn"><a href="" class="ui-dialog-titlebar-close ui-corner-all" onclick role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
			</div>
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