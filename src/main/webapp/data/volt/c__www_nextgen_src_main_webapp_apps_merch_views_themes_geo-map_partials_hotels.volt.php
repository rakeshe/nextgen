<!-- START VIEW PARTIAL: hotel/item list -->
<!-- Hotel List -->

	<div id="hotel_gold_card_block" class="hd-main-info">
		<div class="row row_nomargin">
			<div class="world_best_deals  col-xs-4 col-sm-4  col-md-4 col-lg-4 pull-left"><?php echo $t->_('recommended-deals'); ?></div>
			<div class="hotel_all_search  col-xs-6 col-sm-6  col-md-7 col-lg-7 pull-right">
                <span class="search_input_hotel">
                    <span class="magnifyGls"></span>&nbsp;<?php echo $t->_('search-all-hotel-club'); ?>
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
			<span class="search_not_found"><?php echo $t->_('not-found-what-you-are-looking-for'); ?></span>
			<span class="search_plus hidden"><img src="/themes/common/img/plus.png" alt="plus"/></span>
			<span style="display:none;" class="search_plus"><img src="/themes/common/img/minus-sign.png" alt="plus"/></span>
		</div>

		<div class="input-group">
	      <input type="text" class="form-control" placeholder="<?php echo $t->_('search-all-hotel-club'); ?>" id="locationText">
	      <span class="input-group-btn">
	      	<a class="btn btn-default search_hotel_near_go" type="button">
	      		<img src="/themes/common/img/icon-geolocation.png" alt="Use current location" height="18" width="18" data-context="icon-geolocation">
	      	</a>
	      </span>
    	</div>

    	<div class="search-toggle" >
	    	<div class="row" style="padding:1.5%;">
		    	<div class="col-lg-3 col-sm-4 col-xs-8">
		    		<span class="label_Text"><?php echo $t->_('check-in'); ?>&nbsp;&nbsp;</span>
			        <input type="text" class="input-sm datepicker" name="checkin" id="choseDatesStartDate1" placeholder="dd/mm/yy">
				</div>
				<div class="col-lg-3 col-sm-4 col-xs-8">
					<span class="label_Text"><?php echo $t->_('check-out'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
			        <input type="text" class="input-sm datepicker" name="checkout" id="choseDatesEndDate1" placeholder="dd/mm/yy">
			   </div>
			   <div class="col-lg-3 col-sm-4 col-xs-8">
			   		<span class="label_Text"><?php echo $t->_('coupon-code'); ?>&nbsp;&nbsp;</span>
		        	<input type="text" class="input-sm" name="" id="proCode" placeholder="<?php echo $t->_('coupon-code'); ?>..." value="<?php if (isset($coupon)) { ?><?php echo $coupon['code']; ?><?php } ?>">
		    	</div>

                </div><div class="row" style="padding:1.5%">
            <div class="col-lg-12 col-sm-11 col-md-11 col-xs-11">
                <?php foreach (range(1, 4) as $i) { ?>
                <div id="search_visible_room<?php echo $i; ?>" data-context="hotelGuests" class="hotelGuests first">
				<div class="legend col-lg-1 col-sm-3 col-md-1 col-xs-3"> Room <?php echo $i; ?> </div>
                    <div class="guests col-lg-11 col-md-11 col-xs-9 col-sm-8">
                        <div class="row" >
                            <div class="col-xs-3 col-lg-1">
								<span class="adultSelect" data-mbox-update="167,adultsClicked=true">

								<span class="primaryLabel"><span class="">Adult
								<span class="secondaryText supplementaryMessage">
								(18+) </span></span></span>
                                    <select name="search_hotel.rooms[<?php echo $i; ?>].adlts" class="btn btn-default child_rooms">
                                        <?php $v2466138002iterator = range(1, 6); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                            <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php $v2466138002incr++; } ?>
                                    </select>
                                    <span class="button" style=""><span></span><div></div></span></span>
                                </div>
                            <div class="col-xs-2 col-lg-1">
								<span   data-mbox-update="167,childrenClicked=true">
								<span class="primaryLabel">Child <span class="secondaryText supplementaryMessage">
								(0-17)</span></span>
                                        <select name="search_hotel.rooms[<?php echo $i; ?>].chlds" id="search_Childrooms<?php echo $i; ?>" class="btn btn-default child_rooms">
                                            <?php $v2466138002iterator = range(0, 5); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                                <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                            <?php $v2466138002incr++; } ?>
                                        </select>
                                        <span class="button" style=""><span></span><div></div></span>

								</span>
                                </div>
                        </div>

                        <div class="row search_childTravelers noneBlock">
                            <?php if ($i == '1') { ?>
                                <div class="search_childText">Ages of children at time of trip (for pricing, discounts)</div>
                            <?php } elseif ($i == '2') { ?>
                                <div class="search_childText">If you are traveling, include yourself in Room 1.</div>
                            <?php } elseif ($i == '4') { ?>
                                <div class="search_childText">To book more than 4 rooms, call us at <span data-ismobile="false" data-isrtl="false" data-isfreecall="false" data-numbertocall="+611300854585" onclick="SkypeClick2Call.MenuInjectionHandler.makeCall(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" tabindex="-1" dir="ltr" class="skype_c2c_container notranslate" id="skype_c2c_container"><span skypeaction="skype_dropdown" dir="ltr" class="skype_c2c_highlighting_inactive_common"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img width="0" height="0" src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" class="skype_c2c_logo_img"><span class="skype_c2c_text_span">1300-85-45-85</span><span class="skype_c2c_free_text_span"></span></span></span></span></div>
								<?php } else { ?>
								<div class="search_childText"></div>
                            <?php } ?>
                            <div id="search_ChildLabel1Room<?php echo $i; ?>" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom ">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 1</span></span>
                                <select name="search_hotel.rooms[<?php echo $i; ?>].chldAge[0]" class="btn btn-default child_rooms">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    <?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php $v2466138002incr++; } ?>
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>

                            <div id="search_ChildLabel2Room<?php echo $i; ?>" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom ">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 2</span></span>
                                <select name="search_hotel.rooms[<?php echo $i; ?>].chldAge[1]" class="btn btn-default child_rooms">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    <?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php $v2466138002incr++; } ?>
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>


                            <div id="search_ChildLabel3Room<?php echo $i; ?>" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom ">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 3</span></span>
                                <select name="search_hotel.rooms[<?php echo $i; ?>].chldAge[2]" class="btn btn-default child_rooms">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    <?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php $v2466138002incr++; } ?>
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>

                            <div id="search_ChildLabel4Room<?php echo $i; ?>" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom ">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 4</span></span>
                                <select name="search_hotel.rooms[<?php echo $i; ?>].chldAge[3]" class="btn btn-default child_rooms">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    <?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php $v2466138002incr++; } ?>
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>

                            <div id="search_ChildLabel5Room<?php echo $i; ?>" class="col-xs-2 col-lg-1 control select noneInlineBlock custom js-select search_ChildLabelRoom ">
                                <span class="primaryLabel offscreen"><span class="labelText">Child 5</span></span>
                                <select name="search_hotel.rooms[<?php echo $i; ?>].chldAge[4]" class="btn btn-default child_rooms">
                                    <option value="">--</option>
                                    <option value="00">&lt; 1</option>
                                    <?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                                        <option value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php $v2466138002incr++; } ?>
                                </select>
                                <span class="button" style=""><span>--</span><div></div></span></div>
                            <?php if ($i == '1') { ?>
                        </div><div class="row" style="padding:28px 0px 0px 0px;"><ul id="search_addRemove<?php echo $i; ?>" class="pipedList addRemove search_addRemove ">
                            <li><a id="search_add_room<?php echo $i; ?>" class="link search_addRoom">Add a room</a></li>
                        </ul></div></div>
						<?php } elseif ($i == '4') { ?>
                        </div><div class="row" style="padding:28px 0px 0px 0px;"><ul id="search_addRemove<?php echo $i; ?>" class="pipedList addRemove search_addRemove ">
                             <li><a id="search_remove_room<?php echo $i; ?>" class="link search_removeRoom">Remove this room</a></li>
                        </ul></div></div>
                    <?php } else { ?>
            </div><div class="row" style="padding:28px 0px 0px 0px;"><ul id="search_addRemove<?php echo $i; ?>" class="pipedList addRemove search_addRemove ">
                <li id="search_added_room"><a id="search_add_room<?php echo $i; ?>" class="link search_addRoom">Add a room</a></li>
                <li><a id="search_remove_room<?php echo $i; ?>" class="link search_removeRoom">Remove this room</a></li>
            </ul></div></div>

            <?php } ?>
            </div>
            <?php } ?>

    	</div>
		</div><br/>
		<div class="row search_buttons">
	    		<div class="col-lg-12 col-sm-12 col-xs-12">		      
		    		<button type="button" class="btn btn-default search_hotel_near_go_all" data-code="all" aria-label="Left Align" >
					Search
					</button>
				</div>
	    	</div>
			<br/>
	                

			<div id="choseDates" style="">
			<div class="microcontentBeakLeft" style="left: 0px; top: 8px;"></div>
                <div class="close-btn"><a href="" class="close_dialog" role="">close</a></div>


                            <input type="hidden" id="choseDatesOneg_hc" value="" />
							<div class="choosedate" style="width:352px">
							<div class="check_in" style="width:36%; float:left;padding-left:8px;">
							<p style="font-size:14px;font-weight:bold;"><?php echo $t->_('check_in'); ?></p>
							<input type="text" placeholder="dd/mm/yyyy" id="choseDatesStartDate_hc" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
							<div class="secondaryDate"></div>
							</div>
							<div class="checkout" style="width:36%; float:left;padding-left:8px;">
							<p style="font-size:14px;font-weight:bold;"><?php echo $t->_('check_out'); ?></p>
							<input type="text" placeholder="dd/mm/yyyy" id="choseDatesEndDate_hc" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
							<div class="secondaryDate"></div>
							</div>
							<div class="extraSelNights" style="width:20%; float:left;padding-left:8px;"> <label>Nights</label> <p> o </p></div>
							</div>
							<div class="clearfix" style="clear:both"></div>
							<div class="room">
							<?php foreach (range(1, 4) as $i) { ?>
							<fieldset id="visible_room<?php echo $i; ?>" data-context="hotelGuests" class="hotelGuests first">
								<div class="legend">      Room <?php echo $i; ?> </div>
								<div class="guests">
								<div class="inlineInputGroup">
								<span class="adultSelect" data-mbox-update="167,adultsClicked=true">
								<label class="control select custom js-select">
								<span class="primaryLabel"><span class="labelText">Adult
								<span class="secondaryText supplementaryMessage">
								(18+) </span></span></span> <br/>
								<select name="hotel.rooms[<?php echo $i; ?>].adlts" style="">
								<?php $v2466138002iterator = range(1, 6); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label></span>
								<span   data-mbox-update="167,childrenClicked=true">                                                                                               <label class="control select custom js-select">
								<span class="primaryLabel"><span class="labelText">Child <span class="secondaryText supplementaryMessage">
								(0-17) </span></span></span> <br/>
								<select name="hotel.rooms[<?php echo $i; ?>].chlds" id="Childrooms<?php echo $i; ?>" style="">
									<?php $v2466138002iterator = range(0, 5); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label>

								</span>
								</div>

								<div class="childTravelers noneBlock" id="child_travellers<?php echo $i; ?>">
								<?php if ($i == '1') { ?>
				<div class="childText">Ages of children at time of trip (for pricing, discounts)</div>
			<?php } elseif ($i == '2') { ?>
				<div class="childText">If you are traveling, include yourself in Room 1.</div>
				<?php } elseif ($i == '4') { ?>
				<div class="childText">To book more than 4 rooms, call us at <span data-ismobile="false" data-isrtl="false" data-isfreecall="false" data-numbertocall="+611300854585" onclick="SkypeClick2Call.MenuInjectionHandler.makeCall(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(this, event)" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" tabindex="-1" dir="ltr" class="skype_c2c_container notranslate" id="skype_c2c_container"><span skypeaction="skype_dropdown" dir="ltr" class="skype_c2c_highlighting_inactive_common"><span id="non_free_num_ui" class="skype_c2c_textarea_span"><img width="0" height="0" src="resource://skype_ff_extension-at-jetpack/skype_ff_extension/data/call_skype_logo.png" class="skype_c2c_logo_img"><span class="skype_c2c_text_span">1300-85-45-85</span><span class="skype_c2c_free_text_span"></span></span></span></span></div>
				<?php } ?>
				<label class="ChildLabel1Room<?php echo $i; ?>"  class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 1</span></span>
								<select name="hotel.rooms[<?php echo $i; ?>].chldAge[0]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
									<?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label>

							<label class="ChildLabel2Room<?php echo $i; ?>" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 2</span></span>
								<select name="hotel.rooms[<?php echo $i; ?>].chldAge[1]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								<?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label>


							<label class="ChildLabel3Room<?php echo $i; ?>"  class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 3</span></span>
								<select name="hotel.rooms[<?php echo $i; ?>].chldAge[2]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								<?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label>

																																									<label class="ChildLabel4Room<?php echo $i; ?>" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 4</span></span>
								<select name="hotel.rooms[<?php echo $i; ?>].chldAge[3]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
							<?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label>

																																									<label class="ChildLabel5Room<?php echo $i; ?>" class="control select noneInlineBlock custom js-select">
								<span class="primaryLabel offscreen"><span class="labelText">Child 5</span></span>
								<select name="hotel.rooms[<?php echo $i; ?>].chldAge[4]" style="">
								<option value="">--</option>
								<option value="00">&lt; 1</option>
								<?php $v2466138002iterator = range(1, 17); $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $j) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
								<option value="<?php echo $j; ?>"><?php echo $j; ?></option>
										<?php $v2466138002incr++; } ?>
								</select>
								<span class="button" style=""><div></div></span></label>
<?php if ($i == '1') { ?>
</div><ul id="addRemove<?php echo $i; ?>" class="pipedList addRemove">
								<li><a id="add_room<?php echo $i; ?>" class="link addRoom">Add a room</a></li>
								</ul></div>
								<?php } elseif ($i == '4') { ?>
</div><ul id="addRemove<?php echo $i; ?>" class="pipedList addRemove">
								<li><a id="remove_room<?php echo $i; ?>" class="link removeRoom">Remove this room</a></li>
								</ul></div>
								
<?php } else { ?>
								</div><ul id="addRemove<?php echo $i; ?>" class="pipedList addRemove">
								<li id="added_room"><a id="add_room<?php echo $i; ?>" class="link addRoom">Add a room</a></li>
								<li><a id="remove_room<?php echo $i; ?>" class="link removeRoom">Remove this room</a></li>
								</ul></div>
								  <?php } ?>
							</fieldset>
							<?php } ?>

		<div class="hc_room">

		</div>

		</div>
<div class="row">
<div class="pull-left col-md-offset-1" style="margin-left: 5%;">
    <p style="font-size:14px;font-weight:bold;"><?php echo $t->_('coupon-code'); ?></p>
    <input type="text" placeholder="<?php echo $t->_('coupon-code'); ?>..." id="pp-promo" style=" margin-bottom: 12px;margin-right:8px;width:100%" value="" class="">
</div>
<div style="padding:20px 40px 0px 0px"><button aria-label="Left Align" data-code="all" class="btn btn-default button hc_find" type="button">Find</button></div>
    </div>

			
		</div> 