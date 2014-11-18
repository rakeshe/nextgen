<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

	<div id="hotel_gold_card_block" class="hd-main-info subContainer">
		<div class="row row_nomargin">
			<div class="world_best_deals  col-xs-4 col-sm-4  col-md-4 col-lg-4">World best deals</div>
			<div class="hotel_all_search  col-xs-6 col-sm-7  col-md-7 col-lg-7"><span class="search_input_hotel"><img src="/themes/common/img/search.jpeg" width="15"/>Search all HotelClub<b class="caret"></b></span>
		</div>
	</div>	
	</div>
	<div class="hotel_gold_cards_list subContainer">
		<div class="display-cards-gold row"></div>
	</div>

	<div class="hotel_cards_list subContainer">
		<div class="display-cards row"></div>
	</div>
	
	<div class="search_footer">
		<div class="search_footer_head">
			<span class="search_not_found">Not found what you're looking for?</span>
			<span class="search_plus"><img src="/themes/common/img/plus.png" alt="plus"/></span>
			<span style="display:none;" class="search_plus"><img src="/themes/common/img/minus-sign.png" alt="plus"/></span>
		</div>
		
		<div class="input-group">
	      <input type="text" class="form-control" placeholder="Search all HotelClub" id="locationText">
	      <span class="input-group-btn">
	      	<a class="btn btn-default search_hotel_near_go" type="button">
	      		<img src="/themes/common/img/icon-geolocation.png" alt="Use current location" height="18" width="18" data-context="icon-geolocation">
	      	</a>
	      </span>
    	</div>
    	
    	<div class="search-toggle" style="display:none;">    	
	    	<div class="row" style="padding:1.5%;">
		    	<div class="col-lg-3 col-sm-4 col-xs-8">		      
		    		Check-in&nbsp;&nbsp;
			        <input type="text" class="input-sm datepicker" name="checkin" id="choseDatesStartDate1" placeholder="dd/mm/yy">
				</div>
				<div class="col-lg-3 col-sm-4 col-xs-8">
					Check-in&nbsp;&nbsp;    
			        <input type="text" class="input-sm datepicker" name="checkout" id="choseDatesEndDate1" placeholder="dd/mm/yy">
			   </div>
			   <div class="col-lg-4 col-sm-4 col-xs-8">
			   		Coupon Code&nbsp;&nbsp;
		        	<input type="text" class="input-sm" name="" id="proCode" placeholder="CouponCode..">       
		    	</div>
	    	</div>
	    	<div class="row">
	    		<div class="col-lg-12 col-sm-12 col-xs-12">		      
		    		<button type="button" class="btn btn-default search_hotel_near_go_all" data-code="all" aria-label="Left Align" style="background-color: #562d82;color:#FFFFFF;">
					Search
					</button>
				</div>
	    	</div>    
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
