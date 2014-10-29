/**
 * 
 * @package nextgen
 * @since 26/11/13 7:25 PM
 * @version 1.0
 */
$(document).ready(
		function() {

			/** Search Form Dektop date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#checkin').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#checkout').datepicker("option", "minDate",
									$('#checkin').val());
						}
					});
			$('#checkout').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#checkin').datepicker("option", "maxDate",
									$('#checkout').val());
						}
					});
			/** /Search Form Tablet date picker */

			/** Search Form Desktop date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#tab_checkin').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#tab_checkout').datepicker("option", "minDate",
									$('#tab_checkin').val());
						}
					});
			$('#tab_checkout').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 2,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#tab_checkin').datepicker("option", "maxDate",
									$('#tab_checkout').val());
						}
					});
			/** /Search Form Tablet date picker */

			/** Search Form Mobile date picker */
			var closeText = "Close";
			var currentText = "Today";
			var checkRates = "Check Rates";
			$('#mob_checkin').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 1,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						firstDay : 0,
						dayNamesMin : [ "S", "M", "T", "W", "T", "F", "S" ],
						onSelect : function(dateText, inst) {
							$('#mob_checkout').datepicker("option", "minDate",
									$('#mob_checkin').val());
						}
					});
			$('#mob_checkout').datepicker(
					{
						inline : true,
						dateFormat : 'dd/mm/yy',
						maxDate : '+364D',
						minDate : 0,
						numberOfMonths : 1,
						showCurrentAtPos : 0,
						closeText : closeText,
						currentText : currentText,
						showButtonPanel : true,
						onSelect : function(dateText, inst) {
							$('#mob_checkin').datepicker("option", "maxDate",
									$('#mob_checkout').val());
						}
					});
			/** /Search Form Mobile date picker */

			/** Carousel controls * */
			$('.carousel').carousel({
				interval : 6000
			});

			$('.carousel').carousel('next');

		});

/* Region Tabs-Mobile Toggle Event */
$(document)
		.ready(
				function() {

					$("#regions").click(function() {
						$("#mbl_banner .region_panels").hide();
						$("#mbl_banner .region_menu").show();

					});
					/* hover mobile responsive */
					$(".menu-icons").hover(function() {
						$(this).find("b").removeClass("glyphicon-plus");
						$(this).find("b").addClass("glyphicon-minus");
					}, function() {
						$(this).find("b").removeClass("glyphicon-minus");
						$(this).find("b").addClass("glyphicon-plus");
					});
					/* Ontouch mobile responsive */
					$(".region_menu .dropdown-toggle")
							.click(
									function() {
										$(this).find("span").toggleClass(
												"glyphicon-minus");
										if ($(".glyphicon").hasClass(
												"glyphicon-minus") == true) {
											$(".btn-default").find("span")
													.removeClass(
															"glyphicon-minus");
											$(this).find("span").toggleClass(
													"glyphicon-minus");
										}
										var button_count = $(
												".region_menu .btn-group-vertical")
												.find("button").length;
										var get_id = $(this).attr("id")
												.replace(/[^0-9]/g, '');
										get_id = get_id - 1;
										var setpos = get_id * 1;
										setpos = -setpos;
										var getpos = setpos + "px";
										$(".region_menu .dropdown-menu").css(
												"top", "" + getpos + "");

									});
				});
function validate_searchform() {
	var flag = false;
	var errFlag = false;
	if ($.trim($('#locationText').val()) == '') {
		$(".destination_search").html(
				"<p class='error_msg'>Enter location(s)</p>");
		$(".checkBoxDestinations").addClass("errorFocusChk");
		flag = true;
	} else {
		$(".destination_search").empty();
		$(".checkBoxDestinations").removeClass('errorFocusChk');
	}
	if ($.trim($('input[name="checkin"]').val()) == '') {
		$(".checkBoxDestinations").css("outline", "0px solid none");
		$(".startdate").html("<p class='error_msg'>Select date</p>");
		$("input[name='checkin']").addClass('errorFocus');
		flag = true;
		errFlag = true;
	} else {
		$(".startdate").empty();
		$("input[name='checkin']").removeClass('errorFocus');
	}
	if ($.trim($('input[name="checkout"]').val()) == '') {
		$(".checkBoxDestinations").css("outline", "0px solid none");
		$(".startdate").html("<p class='error_msg'>Select date</p>");
		$("input[name='checkout']").addClass('errorFocus');
		flag = true;
	} else {
		if (errFlag == false)
			$(".startdate").empty();
		$("input[name='checkout']").removeClass('errorFocus');
	}
	if (flag == false)
		return true;
	return false;
}
$("#btnSearch")
		.click(
				function() {
					validate_searchform();
					var local = $("#locationText").val(), checkIn = $(
							"#checkin").val(), checkOut = $("#checkout").val(), promo = $(
							"#couponCode").val(), languageCode = $("#btnSearch")
							.data('local');
					window.location = "http://www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="
							+ promo
							+ "&hotel.keyword.key="
							+ local
							+ "&hotel.rooms[0].adlts=2&hotel.type=keyword&hotel.chkin="
							+ checkIn
							+ "&hotel.chkout="
							+ checkOut
							+ "&search=Search&locale="
							+ languageCode
							+ "&lpid.category=hot-mkt-dated&lpid.priority=1200.0&lpid=hotelGpSearch";
					console.log(local + checkIn + checkOut + promo);
				});

$(document).ready(
		function() {
			function log(message) {
				$("<div>").text(message).prependTo("#log");
				$("#log").scrollTop(0);
			}

			$("#locationText").autocomplete(
					{
						source : function(request, response) {
							$.ajax({
								url : "/merch/get-location",
								dataType : "json",
								data : {
									q : request.term
								},
								success : function(data) {
									console.log(data.suggestion);
									var dataArr = [];
									$.each(data, function(key, val) {
										dataArr.push(val.suggestion);
										console
												.log(key + '--'
														+ val.suggestion);
									});
									response(dataArr);
								}
							});
						},
						minLength : 1,
						select : function(event, ui) {
							log(ui.item ? "Selected: " + ui.item.label
									: "Nothing selected, input was "
											+ this.value);
						},
						open : function() {
							$(this).removeClass("ui-corner-all").addClass(
									"ui-corner-top");
						},
						close : function() {
							$(this).removeClass("ui-corner-top").addClass(
									"ui-corner-all");
						}
					});
		});

$(document).on('click', '.menu-region,.menu-country,.menu-city', function(e) {
	e.preventDefault();
	var cacheObj = $(this),
		url = $(this).attr('href'),
		x = nextgen.init(),
		res = x.sendRequest(url, '');
	
	res.success(function(data){
		x.displayHotels(data); // dispaly hotel cards
		x.selectMenu(cacheObj); // select menu
		x.setUrlToHistory(url); // Change url on browser		
	})
	.error(function(data){		
		console.log('Exception: '+ data.responseText);
	});	
	return false;
});

var nextgen = {
		//initialization here..
		'init' : function(){
			return this;
		},
		//send ajax request
		'sendRequest' : function(url, data) {
			return $.ajax({
				type : 'POST',
				dataType : 'json',
				url : url,
				async : false,
				data : data
			});
		},
		//Display hotel card
		'displayHotels' : function(obj) {			
			var html = '';
			$.each(obj['hotels'], function(index, val) {
				html += '<div class="hotelDeal col-xs-12 col-sm-12 col-md-6 col-lg-6" style="cursor: default;">';
				html += '<div class="row">';
				html += '<div class="image_section col-xs-4 col-sm-5 col-md-5" id="image_section">';
				html += '<a>';
				html += '<div>';
				html += '<img src = "'+ nextgen.classicHotelImageUri(val.oneg) +'" class="img-responsive" id="image_hotel" width="180" height="120 alt="'+deals[index]['hotel_name']+'" />';
						
				html +='<div class=" hidden-xs hotel-image-text" style="">';
				html += '<div class="img-location-text">'+deals[index]['country_name']+'</div>';
				html += '<div class="ce-star star4">';
				html += '<img src="" alt="'+deals[index]['rank_country']+'" class="img-responsive" />';
				html += '</div></div></div></a></div>';
				
				html += ' <div class="middle-offer-section col-xs-5 col-sm-5 col-md-4">';
				html += ' <div class="hotelInfo">';
				html += '<h3>';                  
				html += '<a>';
				html += '<div class="purple-color hotel-title" title="'+deals[index]['hotel_name']+'">';
								
				if (deals[index]['hotel_name'].length > 12)
					html += deals[index]['hotel_name'].substring(0, 11) + '...';
				else
					html += deals[index]['hotel_name'];                         
				
	            html += '</div></a></h3>';                  
	            html +='<div class="hidden-xs campaign-promo-offer">';
	            var discount;
	            $.each(deals[index]['offer'], function(key, val) {
	            	html += val['offer_text'];
	             	discount = val['percent_off']; 
	            });
	            html += '</div>';	
                html += '<div class="members-extras-block">';                   
                html += '<img class="members-extras-logo img-responsive" alt="Member Rewards" src="//www.hotelclub.com/Ad-unit/images/member-rewards_20x20.png" />';
                html += '<div class="font_red member-extras-text">'+trans['mem_extras']+'</div>';
                html += '</div>';
	                
               // members-extras-block
                html += '<div class="sign-in-member-offer offer-for-existing-members font_red">';
    			$.each(deals[index]['offer_moo_t'], function(mkey, mval) {
    				html += mval['offer_moo_text'];				
    			}); 
    		   html += '</div>';                
                 
		       html += '<div class="sign-out-member-offer" style="display: none;">';
		       html += '<span>';                        
		       html += '<p>'+trans['mem_inactive_line1']+'</p>';
		       html += '<p>'+trans['mem_inactive_line2']+'&gt;&gt;</p>';
		       html += '</span>';
		       html += '</div>';
		       html += '</div>';
		       html += '</div>';		
		       html += '<div class="saveBookInfo col-xs-3 col-sm-2 col-md-2">';
		       html += trans['Save']+'<br>';
		       html += '<span class="percentage hc-percentage">'+discount+'%</span>';
		       html += '<div class="clearfix "></div>';
		       html += '<div class="btn button">';
		       html += '<a>'+trans['book']+'</a>';
		       html += '</div>';
		       html += '<br>';
		       html += '<p class="inclusions">'+deals[index]['travel_text']+'</p>';
		       html += '</div></div></div>';
			});
			$('.hc-cards').html(html);
		},
		//Image uri builder
		'classicHotelImageUri' : function(oneg){
			return 'http://www.hotelclub.com/ad-unit/promodeals/images/mp_v1_' + oneg + '.jpg';
		},
		//select menu which is clicked
		'selectMenu' : function($this) {
			if ($this.hasClass('menu-region')) {
				$('li').removeClass('levelActive').addClass('level1');
				$this.parent().addClass('levelActive');
			} else if ($this.hasClass('menu-country')) {
				$('li').removeClass('levelActive').addClass('level1');
				$this.parent().parent().parent().addClass('levelActive');
			}
		},
		//Adding url to browser history entries
		'setUrlToHistory' : function(url) {
			if (window.location != url)
				window.history.pushState({path:url}, '', url);
		}
	
	
};

/* /Region Tabs-Mobile Toggle Event */