<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

	<div id="hotel_gold_card_block" class="hd-main-info">
		<div class="row row_nomargin">
			<div class="world_best_deals  col-xs-4 col-sm-4  col-md-4 col-lg-4 pull-left">{{t._('recommended-deals')}}</div>
			<div class="hotel_all_search  col-xs-6 col-sm-7  col-md-7 col-lg-7 pull-right">
                <span class="search_input_hotel">
                    <span class="magnifyGls"></span>&nbsp;{{t._('search-all-hotel-club')}}
                    <b class="caret"></b>
                </span>
		</div>
	</div>	
	</div>
	<div class="hotel_gold_cards_list">
		<div class="display-cards-gold row"></div>
	</div>

	<div class="hotel_cards_list">
		<div class="display-cards row"></div>
	</div>
	
	<div class="search_footer">
		<div class="search_footer_head">
			<span class="search_not_found">{{t._("not-found-what-you-are-looking-for")}}</span>
			<span class="search_plus"><img src="/themes/common/img/plus.png" alt="plus"/></span>
			<span style="display:none;" class="search_plus"><img src="/themes/common/img/minus-sign.png" alt="plus"/></span>
		</div>
		
		<div class="input-group">
	      <input type="text" class="form-control" placeholder="{{t._('search-all-hotel-club')}}" id="locationText">
	      <span class="input-group-btn">
	      	<a class="btn btn-default search_hotel_near_go" type="button">
	      		<img src="/themes/common/img/icon-geolocation.png" alt="Use current location" height="18" width="18" data-context="icon-geolocation">
	      	</a>
	      </span>
    	</div>
    	
    	<div class="search-toggle" style="display:none;">    	
	    	<div class="row" style="padding:1.5%;">
		    	<div class="col-lg-3 col-sm-4 col-xs-8">		      
		    		{{t._('check-in')}}&nbsp;&nbsp;
			        <input type="text" class="input-sm datepicker" name="checkin" id="choseDatesStartDate1" placeholder="dd/mm/yy">
				</div>
				<div class="col-lg-3 col-sm-4 col-xs-8">
					{{t._('check-out')}}&nbsp;&nbsp;
			        <input type="text" class="input-sm datepicker" name="checkout" id="choseDatesEndDate1" placeholder="dd/mm/yy">
			   </div>
			   <div class="col-lg-4 col-sm-4 col-xs-8">
			   		{{t._('coupon-code')}}&nbsp;&nbsp;
		        	<input type="text" class="input-sm" name="" id="proCode" placeholder="{{t._('coupon-code')}}..." value="{% if coupon is defined %}{{ coupon['code'] }}{% endif %}">
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
	                {#POPUP DESIGN AND FUNCTIONALITIES #}
	
			<div id="choseDates" style="">
			<div class="microcontentBeakLeft" style="left: 0px; top: 8px;"></div>
                <div class="close-btn"><a href="" class="" role="">close</a></div>

                            <input type="hidden" id="choseDatesOneg_hc" value="" />
							<div class="choosedate" style="width:352px">
							<div class="check_in" style="width:36%; float:left;padding-left:8px;">
							<p style="font-size:14px;font-weight:bold;">{{ t._('check_in') }}</p>
							<input type="text" placeholder="dd/mm/yyyy" id="choseDatesStartDate_hc" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
							<div class="secondaryDate"></div>
							</div>
							<div class="checkout" style="width:36%; float:left;padding-left:8px;">
							<p style="font-size:14px;font-weight:bold;">{{ t._('check_out') }}</p>
							<input type="text" placeholder="dd/mm/yyyy" id="choseDatesEndDate_hc" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
							<div class="secondaryDate"></div>
							</div>
							<div class="extraSelNights" style="width:20%; float:left;padding-left:8px;"> <label>Nights</label> <p> o </p></div>
							</div>
							<div class="clearfix" style="clear:both"></div>
							<div class="room">
							{% for i in 1..4 %}
							<fieldset id="visible_room{{ i }}" data-context="hotelGuests" class="hotelGuests first">
								<div class="legend">      Room {{ i }} </div>
								<div class="guests">
								<div class="inlineInputGroup">
								<span class="adultSelect" data-mbox-update="167,adultsClicked=true">                                                                                                                                                        
								<label class="control select custom js-select">
								<span class="primaryLabel"><span class="labelText">Adult
								<span class="secondaryText supplementaryMessage">
								(18+) </span></span></span> <br/>
								<select name="hotel.rooms[{{ i }}].adlts" style="">
								{% for j in 1..6 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>2</span><div></div></span></label></span>
								<span   data-mbox-update="167,childrenClicked=true">                                                                                               <label class="control select custom js-select">
								<span class="primaryLabel"><span class="labelText">Child <span class="secondaryText supplementaryMessage">
								(0-17) </span></span></span> <br/>
								<select name="hotel.rooms[{{ i }}].chlds" id="Childrooms{{ i }}" style="">
									{% for j in 0..5 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>0</span><div></div></span></label>

								</span>
								</div>

								<div class="childTravelers noneBlock">
								<div class="childText">Ages of children at time of trip (for pricing, discounts)</div>
																																												   <label id="ChildLabel1Room{{ i }}"  class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 1</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[0]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
									{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

							<label id="ChildLabel2Room{{ i }}" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 2</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[1]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

																																									
							<label id="ChildLabel3Room{{ i }}"  class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 3</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[2]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

																																									<label id="ChildLabel4Room{{ i }}" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 4</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[3]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
							{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

																																									<label id="ChildLabel5Room{{ i }}" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 5</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[4]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>	
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>
{% if  i == "1" %}
</div><ul id="addRemove{{ i }}" class="pipedList addRemove">
								<li><a id="add_room{{ i }}" class="link addRoom">Add a room</a></li>
								</ul></div>
{% else %}
								</div><ul id="addRemove{{ i }}" class="pipedList addRemove">
								<li id="added_room"><a id="add_room{{ i }}" class="link addRoom">Add a room</a></li>
								<li><a id="remove_room{{ i }}" class="link removeRoom">Remove this room</a></li>
								</ul></div>
								  {% endif %}
							</fieldset>
							{% endfor %}
							
		<div class="hc_room">
		
		</div>
		
		</div>
	<button style="background-color: #562d82;color:#FFFFFF;" aria-label="Left Align" data-code="all" class="btn btn-default hc_find" type="button">Find</button>
			 {#<form method="get" name="searchBot">
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
			</form>#}
		</div> {# dialog box ends#}
		
	
