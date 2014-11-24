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
	<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-draggable" id="check_in_dates" style="outline: 0px none; z-index: 1002;top: 100px; left: 452px; display: none;position:fixed;" tabindex="-1" role="dialog" aria-labelledby="ui-id-1" >
		{#<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
			<span id="ui-id-1" class="ui-dialog-title">{{ t._('check_rates') }}</span>
			<div class="close_btn"><a href="" class="ui-dialog-titlebar-close ui-corner-all" onclick role="button"><span class="ui-icon ui-icon-closethick">close</span></a>
			</div>
		</div>#}
		{#<div class="ui-dialog-content ui-widget-content" id="choseDates" style="display: block; width: auto; min-height: 0px; height: 246px;" scrolltop="0" scrollleft="0">
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
		</div>#}
		<div class="ui-dialog-content ui-widget-content dialogWrapper microcontent miniHotelForm">
		<div class="dialogTop">
		<div class="dialogTopLeft"></div>
		<div class="dialogTopRight"></div></div>
		<div class="dialogMain"><div class="dialogMainRight"><div class="dialogMainContent"><a class="dialogTopCloseLink dialogCloseLink" href="javascript:void(0);" tabindex="-1">Close</a>
		<div class="dialogTitle"><p>Choose your dates</p></div>
		<div class="dialogMainInfo">                                                                                                                 <div data-context="hotelMiniForm" class="hotelMiniForm">
	             <div data-agent="{
		&quot;type&quot;:&quot;SearchForm&quot;
		 ,&quot;deferred&quot;:&quot;true&quot;  
	}" class="hotelSearchForm searchForm">
		                                    <form class="searchFormForm" novalidate="novalidate" method="get" action="http://www.hotelclub.com/shop/hotelsearch">

	                           <input type="hidden" value="hotel" name="type">

    <input type="hidden" value="keyword" name="hotel.type">
			  <input type="hidden" value="true" name="shs">
			                         <input type="hidden" value="235462" name="hotel.hid">

                                                    <div data-agent="{
		&quot;type&quot;:&quot;DateDuration&quot;
		   ,&quot;params&quot;:{
			&quot;labelContent&quot;: &quot;&lt;span class=\&quot;primaryLabel\&quot;&gt;Nights&lt;/span&gt;\n\t\t\t&lt;span class=\&quot;readOnlyValue\&quot;&gt;0&lt;/span&gt;&quot;
		}
	}" class="group dates inlineInputGroup">
		                                                                                                                                                                                                                                     <span data-agent="{
		&quot;type&quot;:&quot;DateInputManager&quot;
		   ,&quot;params&quot;:{
	&quot;today&quot;: 1416821259674,
	&quot;maxDate&quot;: 1445333259674,
	&quot;pattern&quot;: &quot;dd/MM/yy&quot;,
	&quot;localisedPattern&quot;: &quot;dd/mm/yy&quot;,
	&quot;firstDayOfWeekIndex&quot;: &quot;0&quot;,
	&quot;close&quot;: &quot;Close&quot;,
	&quot;previous&quot;: &quot;&lt;img src=\&quot;http://www.tnetnoc.com/static/28.123/image/brand/hcl/action-prev-md.png\&quot; alt=\&quot;\&quot; data-context=\&quot;action-prev-md\&quot; /&gt;&quot;,
	&quot;next&quot;: &quot;&lt;img src=\&quot;http://www.tnetnoc.com/static/28.123/image/brand/hcl/action-next-md.png\&quot; alt=\&quot;\&quot; data-context=\&quot;action-next-md\&quot; /&gt;&quot;,
	&quot;months&quot;: [&quot;January&quot;,&quot;February&quot;,&quot;March&quot;,&quot;April&quot;,&quot;May&quot;,&quot;June&quot;,&quot;July&quot;,&quot;August&quot;,&quot;September&quot;,&quot;October&quot;,&quot;November&quot;,&quot;December&quot;],
	&quot;abbrMonths&quot;: [&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;,&quot;Sep&quot;,&quot;Oct&quot;,&quot;Nov&quot;,&quot;Dec&quot;],
	&quot;days&quot;: [&quot;S&quot;,&quot;M&quot;,&quot;T&quot;,&quot;W&quot;,&quot;T&quot;,&quot;F&quot;,&quot;S&quot;],
	&quot;abbrDays&quot;: [&quot;Sun&quot;,&quot;Mon&quot;,&quot;Tue&quot;,&quot;Wed&quot;,&quot;Thu&quot;,&quot;Fri&quot;,&quot;Sat&quot;],
	&quot;selectors&quot;: &quot;.dates&quot;,
	&quot;parentClass&quot;: &quot;searchForm&quot;,
	&quot;parentTag&quot;: &quot;&quot;,
	&quot;enableDatePicker&quot;: false,
	&quot;fullScreenView&quot;: false,
	&quot;enableIcon&quot;: false,
	&quot;calendarImage&quot;: &quot;&lt;img src=\&quot;http://www.tnetnoc.com/static/28.123/image/global/icon-calendar.png\&quot; alt=\&quot;\&quot; data-context=\&quot;icon-calendar\&quot; /&gt;&quot;,
	&quot;abbrFullDatePattern&quot;: &quot;EEE,d MMMM yyyy&quot;,
	&quot;monthsToDisplay&quot;: 2,
	&quot;autoFillCheckout&quot;: true,
	&quot;listenToOtherDateInputs&quot;: false,
	&quot;activeFullScreenOnSmallWindow&quot;: false }
	}">
</span>
     <div data-mbox-update="167,startDateClicked=true" class="startDate">                                                                                                                  <label data-component="textInput" class="control textInput textInput-large">
	<span class="primaryLabel"><span class="labelText">Check-in</span></span>
	 <input type="text" placeholder="dd/mm/yy" data-agent="{
		&quot;type&quot;:&quot;Placeholder&quot;
		   
	}" value="" name="hotel.chkin">
	 <div class="secondaryDate"></div></label>

    </div>
				<div data-mbox-update="167,endDateClicked=true" class="endDate">                                                                                                                  <label data-component="textInput" class="control textInput textInput-large">
	<span class="primaryLabel"><span class="labelText">Check-out</span></span>
	 <input type="text" placeholder="dd/mm/yy" data-agent="{
		&quot;type&quot;:&quot;Placeholder&quot;
		   
	}" value="" name="hotel.chkout">
	 <div class="secondaryDate"></div></label>

    </div>
			  <label class="control textInput textInput-large durationLabel"><span class="primaryLabel">Nights</span>
			<span class="readOnlyValue">0</span></label></div>

                                                   <div data-agent="{
		&quot;type&quot;:&quot;SearchForm.HotelTravelers&quot;
		,&quot;childOf&quot;:&quot;SearchForm&quot;   ,&quot;params&quot;:{
			&quot;addRoomText&quot;: &quot;Add a room&quot;,
			&quot;removeRoomText&quot;: &quot;Remove this room&quot;,
			&quot;maxRooms&quot;: 4,
			&quot;dataMboxUpdate&quot;: &quot;&quot;,
			&quot;isMvtHiddenInputEnabled&quot;: &quot;false&quot;,
			&quot;prefixWtTi&quot;: &quot;&quot;,
			&quot;dataWtMt&quot;: &quot;&quot;
		}
	}" class="group travelers">
					<fieldset data-context="hotelGuests" class="hotelGuests first">
			<div class="legend">      Room 1 </div>
			<div class="guests">
				                              <div class="inlineInputGroup">
					   <span class="adultSelect" data-mbox-update="167,adultsClicked=true">                                                                                                                                                        <label data-agent="{
		&quot;type&quot;:&quot;Select&quot;
		   
	}" data-component="selectList" class="control select custom js-select">
	<span class="primaryLabel"><span class="labelText">Adult <span class="secondaryText supplementaryMessage">
							  (18+) </span></span></span>
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
								  (0-17) </span></span></span>
	<select name="hotel.rooms[0].chlds" style="">
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
					                                                                                                                                                                                               <label data-agent="{
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

                                                                                                                                                                                                    <label data-agent="{
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

                                                                                                                                                                                                    <label data-agent="{
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

                                                                                                                                                                                                    <label data-agent="{
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

                                                                                                                                                                                                    <label data-agent="{
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
		</fieldset> </div>
			                                                                                  <div data-component="submit" class="submit button-primary button-small">
			<input type="submit" data-wt-ti="flexMiniSearchForm-hotel-submit" data-agent="{
		&quot;type&quot;:&quot;Interstitial&quot;
		   
	}" name="search" value="Find">
		</div>
	     </form>

   </div>
</div>                                                        </div><a class="dialogBottomCloseLink dialogCloseLink offscreen" href="javascript:void(0);" tabindex="-1">Close</a></div></div></div><div class="dialogBottomCompact"><div class="dialogBottomLeft"></div><div class="dialogBottomRight"></div></div><a class="dialogWrapLink offscreen"></a><p class="offscreen">Please click the close link above before proceeding any farther down the page</p><div class="microcontentBeakLeft" style="left: 0px; top: 8px;"></div></div>
	</div>