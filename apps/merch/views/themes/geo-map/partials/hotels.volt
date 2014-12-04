<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

	<div id="hotel_gold_card_block" class="hd-main-info">
		<div class="row row_nomargin">
			<div class="world_best_deals  col-xs-4 col-sm-4  col-md-4 col-lg-4 pull-left">{{t._('recommended-deals')}}</div>
			<div class="hotel_all_search  col-xs-6 col-sm-6  col-md-7 col-lg-7 pull-right">
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
			<span class="search_plus hidden"><img src="/themes/common/img/plus.png" alt="plus"/></span>
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

    	<div class="search-toggle" >
	    	<div class="row" style="padding:1.5%;">
		    	<div class="col-lg-3 col-sm-4 col-xs-8">
		    		<span class="label_Text">{{t._('check-in')}}&nbsp;&nbsp;</span>
			        <input type="text" class="input-sm datepicker" name="checkin" id="choseDatesStartDate1" placeholder="dd/mm/yy">
				</div>
				<div class="col-lg-3 col-sm-4 col-xs-8">
					<span class="label_Text">{{t._('check-out')}}&nbsp;&nbsp;&nbsp;&nbsp;</span>
			        <input type="text" class="input-sm datepicker" name="checkout" id="choseDatesEndDate1" placeholder="dd/mm/yy">
			   </div>
			   <div class="col-lg-3 col-sm-4 col-xs-8">
			   		<span class="label_Text">{{t._('coupon-code')}}&nbsp;&nbsp;</span>
		        	<input type="text" class="input-sm" name="" id="proCode" placeholder="{{t._('coupon-code')}}..." value="{% if coupon is defined %}{{ coupon['code'] }}{% endif %}">
		    	</div>

                </div><div class="row">
            <div class="col-lg-12 col-sm-4 col-xs-11">
                {% for i in 1..4 %}
                <div id="search_visible_room{{ i }}" data-context="hotelGuests" class="hotelGuests first">
				<div class="legend"> Room {{ i }} </div>
                    <div class="guests col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="row" >
                            <div class="col-xs-2 col-lg-1">
								<span class="adultSelect" data-mbox-update="167,adultsClicked=true">

								<span class="primaryLabel"><span class="">Adult
								<span class="secondaryText supplementaryMessage">
								(18+) </span></span></span>
                                    <select name="search_hotel.rooms[{{ i }}].adlts" class="btn btn-default">
                                        {% for j in 1..6 %}
                                            <option value="{{ j }}">{{ j }}</option>
                                        {% endfor %}
                                    </select>
                                    <span class="button" style=""><span></span><div></div></span></span>
                                </div>
                            <div class="col-xs-2 col-lg-1">
								<span   data-mbox-update="167,childrenClicked=true">
								<span class="primaryLabel">Child <span class="secondaryText supplementaryMessage">
								(0-17)</span></span>
                                        <select name="search_hotel.rooms[{{ i }}].chlds" id="search_Childrooms{{ i }}" class="btn btn-default">
                                            {% for j in 0..5 %}
                                                <option value="{{ j }}">{{ j }}</option>
                                            {% endfor %}
                                        </select>
                                        <span class="button" style=""><span></span><div></div></span>

								</span>
                                </div>
                        </div>

                        <div class="row search_childTravelers noneBlock">
                            {% if i == '1' %}
                                <div class="search_childText">Ages of children at time of trip (for pricing, discounts)</div>
                            {% elseif  i == "2" %}
                                <div class="search_childText">If you are traveling, include yourself in Room 1.</div>
                            {% elseif  i == "4" %}
                                <div class="search_childText">To book more than 4 rooms, call us at <span data-ismobile="false" data-isrtl="false" data-isfreecall="false" data-numbertocall="+611300854585" onclick="SkypeClick2Call.MenuInjectionHandler.makeCall(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" tabindex="-1" dir="ltr" class="skype_c2c_container notranslate" id="skype_c2c_container"><span skypeaction="skype_dropdown" dir="ltr" class="skype_c2c_highlighting_inactive_common"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img width="0" height="0" src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" class="skype_c2c_logo_img"><span class="skype_c2c_text_span">1300-85-45-85</span><span class="skype_c2c_free_text_span"></span></span></span></span></div>
                            {% endif %}
                            <div id="search_ChildLabel1Room{{ i }}" style="padding:5px 0px 0px 5px; margin-left: 10px" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 1</span></span>
                                <select name="search_hotel.rooms[{{ i }}].chldAge[0]" class="btn btn-default">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    {% for j in 1..17 %}
                                        <option value="{{ j }}">{{ j }}</option>
                                    {% endfor %}
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>

                            <div id="search_ChildLabel2Room{{ i }}" style="padding:5px 0px 0px 5px;" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 2</span></span>
                                <select name="search_hotel.rooms[{{ i }}].chldAge[1]" class="btn btn-default">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    {% for j in 1..17 %}
                                        <option value="{{ j }}">{{ j }}</option>
                                    {% endfor %}
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>


                            <div id="search_ChildLabel3Room{{ i }}"  style="padding:5px 0px 0px 5px;" class="search_ChildLabel3Roomcol-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 3</span></span>
                                <select name="search_hotel.rooms[{{ i }}].chldAge[2]" class="btn btn-default">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    {% for j in 1..17 %}
                                        <option value="{{ j }}">{{ j }}</option>
                                    {% endfor %}
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>

                            <div id="search_ChildLabel4Room{{ i }}" style="padding:5px 0px 0px 5px;" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 4</span></span>
                                <select name="search_hotel.rooms[{{ i }}].chldAge[3]" class="btn btn-default">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    {% for j in 1..17 %}
                                        <option value="{{ j }}">{{ j }}</option>
                                    {% endfor %}
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>

                            <div id="search_ChildLabel5Room{{ i }}" style="padding:5px 0px 0px 5px;" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 5</span></span>
                                <select name="search_hotel.rooms[{{ i }}].chldAge[4]" class="btn btn-default">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    {% for j in 1..17 %}
                                        <option value="{{ j }}">{{ j }}</option>
                                    {% endfor %}
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>
                            {% if  i == "1" %}
                        </div><div class="row" style="padding:28px 0px 0px 22px;"><ul id="search_addRemove{{ i }}" class="pipedList addRemove">
                            <li><a id="search_add_room{{ i }}" class="link search_addRoom">Add a room</a></li>
                        </ul></div></div>
						{% elseif  i == "4" %}
                        </div><div class="row" style="padding:28px 0px 0px 22px;"><ul id="search_addRemove{{ i }}" class="pipedList addRemove">
                             <li><a id="search_remove_room{{ i }}" class="link search_removeRoom">Remove this room</a></li>
                        </ul></div></div>
                    {% else %}
            </div><div class="row" style="padding:28px 0px 0px 22px;"><ul id="search_addRemove{{ i }}" class="pipedList addRemove">
                <li id="search_added_room"><a id="search_add_room{{ i }}" class="link search_addRoom">Add a room</a></li>
                <li><a id="search_remove_room{{ i }}" class="link search_removeRoom">Remove this room</a></li>
            </ul></div></div>

            {% endif %}
            </div>
            {% endfor %}

    	</div>
		<div class="row">
	    		<div class="col-lg-12 col-sm-12 col-xs-12">		      
		    		<button type="button" class="btn btn-default search_hotel_near_go_all" data-code="all" aria-label="Left Align" >
					Search
					</button>
				</div>
	    	</div>
        </div>

	<br/>
	                {#POPUP DESIGN AND FUNCTIONALITIES #}

			<div id="choseDates" style="">
			<div class="microcontentBeakLeft" style="left: 0px; top: 8px;"></div>
                <div class="close-btn"><a href="" class="close_dialog" role="">close</a></div>


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

								<div class="childTravelers noneBlock" id="child_travellers{{ i }}">
								{% if i == '1' %}
				<div class="childText">Ages of children at time of trip (for pricing, discounts)</div>
			{% elseif  i == "2" %}
				<div class="childText">If you are traveling, include yourself in Room 1.</div>
				{% elseif  i == "4" %}
				<div class="childText">To book more than 4 rooms, call us at <span data-ismobile="false" data-isrtl="false" data-isfreecall="false" data-numbertocall="+611300854585" onclick="SkypeClick2Call.MenuInjectionHandler.makeCall(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" tabindex="-1" dir="ltr" class="skype_c2c_container notranslate" id="skype_c2c_container"><span skypeaction="skype_dropdown" dir="ltr" class="skype_c2c_highlighting_inactive_common"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img width="0" height="0" src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" class="skype_c2c_logo_img"><span class="skype_c2c_text_span">1300-85-45-85</span><span class="skype_c2c_free_text_span"></span></span></span></span></div>
				{% endif %}
				<label class="ChildLabel1Room{{ i }}"  class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 1</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[0]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
									{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

							<label class="ChildLabel2Room{{ i }}" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 2</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[1]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>


							<label class="ChildLabel3Room{{ i }}"  class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 3</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[2]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

																																									<label class="ChildLabel4Room{{ i }}" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 4</span></span>
								<select name="hotel.rooms[{{ i }}].chldAge[3]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
							{% for j in 1..17 %}
								<option value="{{ j }}">{{ j }}</option>
										{% endfor %}
								</select>
								<span class="button" style=""><span>--</span><div></div></span></label>

																																									<label class="ChildLabel5Room{{ i }}" class="control select noneInlineBlock custom js-select">
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
								{% elseif  i == "4" %}
</div><ul id="addRemove{{ i }}" class="pipedList addRemove">
								<li><a id="remove_room{{ i }}" class="link removeRoom">Remove this room</a></li>
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
<div class="row">
<div class="pull-left col-md-offset-1" style="margin-left: 5%;">
    <p style="font-size:14px;font-weight:bold;">{{t._('coupon-code')}}</p>
    <input type="text" placeholder="{{t._('coupon-code')}}..." id="pp-promo" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
</div>
<div style="padding:20px 40px 0px 0px"><button aria-label="Left Align" data-code="all" class="btn btn-default button hc_find" type="button">Find</button></div>
    </div>

			
		</div> {# dialog box ends#}