<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

	<div id="hotel_gold_card_block" class="hd-main-info">
		<div class="row row_nomargin">
			<div class="world_best_deals  col-xs-4 col-sm-4  col-md-4 col-lg-4 pull-left">Recommended deals</div>
			<div class="hotel_all_search  col-xs-6 col-sm-7  col-md-7 col-lg-7 pull-right">
                <span class="search_input_hotel">
                    <img src="/themes/common/img/search-icon.png" width="18"/>&nbsp;Search all HotelClub
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
	
	<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable" id="check_in_dates" style="outline: 0px none; z-index: 1002;top: 725px; left: 452px; display: none;position:absolute;" tabindex="-1" role="dialog" aria-labelledby="ui-id-1" >
		<div class="ui-dialog-titlebar  ui-corner-all ui-helper-clearfix">
			<span id="ui-id-1" class="ui-dialog-title">{{ t._('Choose your dates') }}</span>
			<div class="close_btn"><a href="" class="ui-dialog-titlebar-close ui-corner-all" onclick role="button"><span class="">close</span></a>
			</div>
		</div>
		<div class="ui-dialog-content ui-widget-content" id="choseDates" style="display: block;  min-height: 0px; " scrolltop="0" scrollleft="0">
							<div class="choosedate" style="width:352px">
							<div class="check_in" style="width:36%; float:left;padding-left:8px;">
							<p style="font-size:14px;font-weight:bold;">{{ t._('check_in') }}</p>
							<input type="text" placeholder="dd/mm/yyyy" id="StartDate" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
							<div class="secondaryDate"></div>
							</div>
							<div class="checkout" style="width:36%; float:left;padding-left:8px;">
							<p style="font-size:14px;font-weight:bold;">{{ t._('check_out') }}</p>
							<input type="text" placeholder="dd/mm/yyyy" id="EndDate" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
							<div class="secondaryDate"></div>
							</div>
							<div class="extraSelNights" style="width:20%; float:left;padding-left:8px;"> <label>Nights</label> <p> o </p></div>
							</div>
							<div class="clearfix" style="clear:both"></div>
							<div class="room">
							<fieldset data-context="hotelGuests" class="hotelGuests first">
			<div class="legend">      Room 1 </div>
			<div class="guests">
				                              <div class="inlineInputGroup">
					   <span class="adultSelect" data-mbox-update="167,adultsClicked=true">                                                                                                                                                        
	<label data-agent="{&quot;type&quot;:&quot;Select&quot;}" data-component="selectList" class="control select custom js-select">
	<span class="primaryLabel"><span class="labelText">Adult
	<span class="secondaryText supplementaryMessage">
							  (18+) </span></span></span> <br/>
	<select name="hotel.rooms[0].adlts" style="">
		     <option value="1">1</option>
		       <option selected="selected" value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		     <option value="6">6</option>
		 </select>
<span class="button" style=""><span>2</span><div></div></span></label>

     </span>

					               <span data-mbox-update="167,childrenClicked=true">                                                                                                                                                           <label data-agent="{
		&quot;type&quot;:&quot;SearchFormChildTravelers&quot;
		   
	},{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select custom js-select">
	<span class="primaryLabel"><span class="labelText">Child <span class="secondaryText supplementaryMessage">
								  (0-17) </span></span></span> <br/>
	<select name="hotel.rooms[0].chlds" id="hotel.rooms[0].chlds" style="">
		       <option selected="selected" value="0">0</option>
		     <option value="1">1</option>
		     <option value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		 </select>
<span class="button" style=""><span>0</span><div></div></span></label>

     </span>
					    </div>

				 <div class="childTravelers noneBlock">
					<div class="childText">Ages of children at time of trip (for pricing, discounts)</div>
					                                                                                                                                                                                               <label id="ChildLabel1" data-agent="{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select noneInlineBlock custom js-select">
	<span class="primaryLabel offscreen"><span class="labelText">Child 1</span></span>
	<select name="hotel.rooms[0].chldAge[0]" style="">
		     <option value="">--</option>
		     <option value="00">&lt; 1</option>
		     <option value="01">1</option>
		     <option value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		     <option value="6">6</option>
		     <option value="7">7</option>
		     <option value="8">8</option>
		     <option value="9">9</option>
		     <option value="10">10</option>
		     <option value="11">11</option>
		     <option value="12">12</option>
		     <option value="13">13</option>
		     <option value="14">14</option>
		     <option value="15">15</option>
		     <option value="16">16</option>
		     <option value="17">17</option>
		 </select>
<span class="button" style=""><span>--</span><div></div></span></label>

                                                                                                                                                                                                    <label id="ChildLabel2" data-agent="{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select noneInlineBlock custom js-select">
	<span class="primaryLabel offscreen"><span class="labelText">Child 2</span></span>
	<select name="hotel.rooms[0].chldAge[1]" style="">
		     <option value="">--</option>
		     <option value="00">&lt; 1</option>
		     <option value="01">1</option>
		     <option value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		     <option value="6">6</option>
		     <option value="7">7</option>
		     <option value="8">8</option>
		     <option value="9">9</option>
		     <option value="10">10</option>
		     <option value="11">11</option>
		     <option value="12">12</option>
		     <option value="13">13</option>
		     <option value="14">14</option>
		     <option value="15">15</option>
		     <option value="16">16</option>
		     <option value="17">17</option>
		 </select>
<span class="button" style=""><span>--</span><div></div></span></label>

                                                                                                                                                                                                    <label id="ChildLabel3" data-agent="{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select noneInlineBlock custom js-select">
	<span class="primaryLabel offscreen"><span class="labelText">Child 3</span></span>
	<select name="hotel.rooms[0].chldAge[2]" style="">
		     <option value="">--</option>
		     <option value="00">&lt; 1</option>
		     <option value="01">1</option>
		     <option value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		     <option value="6">6</option>
		     <option value="7">7</option>
		     <option value="8">8</option>
		     <option value="9">9</option>
		     <option value="10">10</option>
		     <option value="11">11</option>
		     <option value="12">12</option>
		     <option value="13">13</option>
		     <option value="14">14</option>
		     <option value="15">15</option>
		     <option value="16">16</option>
		     <option value="17">17</option>
		 </select>
<span class="button" style=""><span>--</span><div></div></span></label>

                                                                                                                                                                                                    <label id="ChildLabel4" data-agent="{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select noneInlineBlock custom js-select">
	<span class="primaryLabel offscreen"><span class="labelText">Child 4</span></span>
	<select name="hotel.rooms[0].chldAge[3]" style="">
		     <option value="">--</option>
		     <option value="00">&lt; 1</option>
		     <option value="01">1</option>
		     <option value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		     <option value="6">6</option>
		     <option value="7">7</option>
		     <option value="8">8</option>
		     <option value="9">9</option>
		     <option value="10">10</option>
		     <option value="11">11</option>
		     <option value="12">12</option>
		     <option value="13">13</option>
		     <option value="14">14</option>
		     <option value="15">15</option>
		     <option value="16">16</option>
		     <option value="17">17</option>
		 </select>
<span class="button" style=""><span>--</span><div></div></span></label>

                                                                                                                                                                                                    <label id="ChildLabel5" data-agent="{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select noneInlineBlock custom js-select">
	<span class="primaryLabel offscreen"><span class="labelText">Child 5</span></span>
	<select name="hotel.rooms[0].chldAge[4]" style="">
		     <option value="">--</option>
		     <option value="00">&lt; 1</option>
		     <option value="01">1</option>
		     <option value="2">2</option>
		     <option value="3">3</option>
		     <option value="4">4</option>
		     <option value="5">5</option>
		     <option value="6">6</option>
		     <option value="7">7</option>
		     <option value="8">8</option>
		     <option value="9">9</option>
		     <option value="10">10</option>
		     <option value="11">11</option>
		     <option value="12">12</option>
		     <option value="13">13</option>
		     <option value="14">14</option>
		     <option value="15">15</option>
		     <option value="16">16</option>
		     <option value="17">17</option>
		 </select>
<span class="button" style=""><span>--</span><div></div></span></label>

      </div>

				     
				 <ul class="pipedList addRemove"><li><a class="link addRoom" href="#" data-wt-ti="-addRoom" data-wt-mt="">Add a room</a></li></ul></div>
		</fieldset>
		</div>
		<div data-component="submit" class="submit button">
			<a class="hc_find" >Find</a>
		</div>
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
		</div>
		
	</div>