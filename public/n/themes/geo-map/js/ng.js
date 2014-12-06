/**
*
* @package nextgen
* @since 26/11/13 7:25 PM
* @version 1.0
*
*
*/
var linkOffset="";
var linkWidth="";
var linkHeight="";
var scrolltop="";
function log(message) {
		$("<div>").text(message).prependTo("#log");
		$("#log").scrollTop(0);
	}

	$("#locationText").autocomplete({
		source : function(request, response) {
			$.ajax({
				url : "/n/merch/get-location",
				dataType : "json",
				data : {
					q : request.term
				},
				success : function(data) {
					var dataArr = [];
					$.each(data, function(key, val) {
						dataArr.push(val.suggestion);
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


	$(".search_hotel_near_go, .search_hotel_near_go_all").click(function() {
		if ($.trim($("#locationText").val()) == '')
			return false;

        var room = '', k = 0, chlen=0;
        for(var i = 1; i < 5; i++) {
            if ($.trim($("#search_visible_room"+ i ).css('display')) == 'block') {
                room += '&hotel.rooms['+k+'].adlts=' + $('select[name="search_hotel.rooms['+i+'].adlts"] option:selected').val();
                chlen = $('select[name="search_hotel.rooms['+i+'].chlds"] option:selected').val();
                room += '&hotel.rooms['+k+'].chlds=' + chlen;
                if (chlen > 0) {
                    for(var j=0; j< chlen; j++) {
                        room += '&hotel.rooms['+k+'].chldAge['+j+']=' + $('select[name="search_hotel.rooms['+i+'].chldAge['+j+']"] option:selected').val();
                    }
                }
                k++;
            }
        }

		var localText = $("#locationText").val(), checkIn = '', checkOut = '', promo = '', languageCode = nextgen.local;

        checkIn  = $('#choseDatesStartDate1').val();
        checkOut = $('#choseDatesEndDate1').val();
        promo 	 = $('#proCode').val();

		window.location = "http://www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="
				+ promo
				+ "&hotel.keyword.key="
				+ localText
				+ "&hotel.type=keyword&hotel.chkin="
				+ checkIn
				+ "&hotel.chkout="
				+ checkOut
				+ "&search=Search&locale="
				+ local
				+ "&lpid=hotelGpSearch"
                + room;
	});
	$(".hc_find").click(function() {
        var room = '', k = 0, chlen=0;
        for(var i = 1; i < 5; i++) {
            if ($.trim($("#visible_room"+ i ).css('display')) == 'block') {
                    room += '&hotel.rooms['+k+'].adlts=' + $('select[name="hotel.rooms['+i+'].adlts"] option:selected').val();
                    chlen = $('select[name="hotel.rooms['+i+'].chlds"] option:selected').val();
                    room += '&hotel.rooms['+k+'].chlds=' + chlen;
                    if (chlen > 0) {
                        for(var j=0; j< chlen; j++) {
                            room += '&hotel.rooms['+k+'].chldAge['+j+']=' + $('select[name="hotel.rooms['+i+'].chldAge['+j+']"] option:selected').val();
                        }
                    }
                k++;
            }
        }
        checkIn  = $('#choseDatesStartDate_hc').val();
        checkOut = $('#choseDatesEndDate_hc').val();
        oneg 	 = $('#choseDatesOneg_hc').val();
        promo 	 = $('#pp-promo').val();

		window.location = "http://www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="
				+ promo
                + "&locale="
                + local
				+ "&hotel.hid="
				+ oneg
				+ "&hotel.rooms[0].adlts=2&hotel.type=keyword&hotel.chkin="
				+ checkIn
				+ "&hotel.chkout="
				+ checkOut
				+ "&search=Search"
                + room;
	});

/*
$('.search_plus, #locationText').click(function(){
	$('.search-toggle').slideToggle('show');
	$('.search_plus').toggle();
});
*/

$(document).ready(
function() {

	/** Search Form Dektop date picker */
	var closeText = trans['close'];
	var currentText = trans['today'];
	var checkRates = "Check Rates";
	$('.checkin').datepicker(
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
	//var closeText = "Close";
	//var currentText = "Today";
	//var checkRates = "Check Rates";
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
	//var closeText = "Close";
	//var currentText = "Today";
	//var checkRates = "Check Rates";
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

	/** Search Form Desktop - Geo Maps date picker */
	//var closeText = "Close";
	//var currentText = "Today";
	//var checkRates = "Check Rates";
	$('#choseDatesStartDate').datepicker(
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
					$('#choseDatesEndDate').datepicker("option", "minDate",
							$('#choseDatesStartDate').val());
				}
			});
	$('#choseDatesEndDate').datepicker(
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
					$('#choseDatesStartDate').datepicker("option", "maxDate",
							$('#choseDatesEndDate').val());
				}
			});
	/** /Search Form Mobile date picker */

	//var closeText = "Close";
	//var currentText = "Today";
	//var checkRates = "Check Rates";
	$('#choseDatesStartDate1').datepicker(
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
					$('#choseDatesEndDate1').datepicker("option", "minDate",
							$('#choseDatesStartDate1').val());
				}
			});
	$('#choseDatesEndDate1').datepicker(
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
					$('#choseDatesStartDate1').datepicker("option", "maxDate",
							$('#choseDatesEndDate1').val());
				}
			});
	/** /Search Form Mobile date picker */
//var closeText = "Close";
//	var currentText = "Today";
//	var checkRates = "Check Rates";
	$('#choseDatesStartDate_hc').datepicker(
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
					$('#choseDatesEndDate_hc').datepicker("option", "minDate",
							$('#choseDatesStartDate_hc').val());
				}
			});
	$('#choseDatesEndDate_hc').datepicker(
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
					$('#choseDatesStartDate_hc').datepicker("option", "maxDate",
							$('#choseDatesEndDate_hc').val());
				}
			});
	/** /Search Form POPUP date picker */

	/** Carousel controls * */
	$('.carousel').carousel({
		interval : 6000
	});

	$('.carousel').carousel('next');

    /** track currency drop-down items - set incomign value to cookie **/
    $('.currencyItem').click(function() {
        var cookieCurrency = $.cookie('curr');
        var selectedCurrency = $(this).attr("data-currency");
        //$("#currency-selector-menu").html().replace(cookieCurrency, selectedCurrency);
        $("#currency-selector-menu").html($("#currency-selector-menu").html().replace(cookieCurrency, selectedCurrency));
        $.cookie('curr', selectedCurrency);
    });


});

/* Region Tabs-Mobile Toggle Event */
$(document).ready(function() {

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
	$(".region_menu .dropdown-toggle").click(function() {
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

$(".search_input_hotel").click(function() {
	$('html, body').animate({
        scrollTop: $("#locationText").offset().top
    }, 500);
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
$("#btnSearch").click(function() {
	//validate_searchform();
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

});

$(document).ready(function() {
	function log(message) {
		$("<div>").text(message).prependTo("#log");
		$("#log").scrollTop(0);
	}

	$("#locationText").autocomplete({
		source : function(request, response) {
			$.ajax({
				url : "/n/merch/get-location",
				dataType : "json",
				data : {
					q : request.term
				},
				success : function(data) {
					var dataArr = [];
					$.each(data, function(key, val) {
						dataArr.push(val.suggestion);
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


    $( "#coupon_code" ).dialog({  autoOpen: true,
        modal:true,
        //minHeight: 180,
        draggable: false,
        buttons: {
            Ok: function () {
                $(this).dialog(trans['close']);
            }
        }
    });

    bannerPosition = $("#banner_image").position();
    $("#coupon_code").dialog('option', 'position', [bannerPosition.top + 280, bannerPosition.left+150]);

    $(".ui-dialog-titlebar").hide();
$("#search_visible_room1").css("display", "block");

});
/*DIALOG BOX WORKS*/
$( "#choseDates" ).dialog({  autoOpen: false,
        width: 466,
        minHeight: 224,
        title: trans['choose_your_dates'],
        draggable: false,
        //resizable: false,
        dialogClass:'success-dialog'

    });



// Platinum card Toggle Control
$(document).on('click','#platinum-toggle', function(e) {
    e.preventDefault();
    var toggleState = $(".hotel_platinum_cards").hasClass("platinum-collapsed") ? 'collapsed' : 'expanded';
    toggleState == 'collapsed' ?
        $(".hotel_platinum_cards").removeClass("platinum-collapsed").addClass("platinum-expanded"):
        $(".hotel_platinum_cards").removeClass("platinum-expanded").addClass("platinum-collapsed");

});
//hotel book extend this for whole card
$(document).on('click','.ht-book', function(e) {
	e.preventDefault();
	book = hotelBook.init();
	book.onegId = $(this).data('oneg');
	book.locale = nextgen.local;
    $("#choseDatesOneg_hc").val(book.onegId);
    $( "#choseDates" ).dialog( "open" );

    dialogOffset = $(this).offset().top  -  $(window).scrollTop() + 265;
    windowHeight = $(window ).height();

    if(dialogOffset > windowHeight){
        $(".microcontentBeakLeft").removeClass('microcontentBeakLeft').addClass('microcontentBeakBottom');
    } else {
        $(".microcontentBeakBottom").removeClass('microcontentBeakBottom').addClass('microcontentBeakLeft');
    }

    $("#choseDates").dialog("widget").position({
        my: 'right',
        at: 'right+14, top+152',
        //at: 'left-10, top + 184',
        of: this
    }).removeClass('ui-corner-all ui-dialog').addClass('hotel_active_dialog');
    $(".ui-dialog-titlebar").show();
    //$("#card-" + book.onegId).addClass('hotel_active_cards').removeClass('platinum-border')
    //$('.ui-dialog-titlebar-close').html("close");
    $("#visible_room1").css("display", "block");
    //$('.ui-dialog-titlebar-close').replaceWith('<div class="close_btn"><a href="" class="ui-dialog-titlebar-close" href="#" role="button">close</a></div>');
	
});

/*DIALOG CLOSE*/
$(document).on('click','.close_dialog', function(e) {
    e.preventDefault();
$('#choseDates').dialog('close'); 
$(':input').not(":button").val('');
/*$("#visible_room1").css("display", "block");
$("#visible_room2").css("display", "none");
$("#visible_room3").css("display", "none");
$("#visible_room4").css("display", "none");
$('.childTravelers').addClass("noneBlock");
$('.ChildLabel1Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock"); 
$('.ChildLabel2Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");       
$('.ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");*/
    $(".ui-dialog-titlebar").hide();
	
});
/*
$(document).on('click','.hotel_cards', function(e) {
    e.preventDefault();
    book = hotelBook.init();
    book.onegId = $(this).data('oneg');
    book.locale = nextgen.local;
    //$("#check_in_dates").css("display", "block");
});
*/
/*DIALOG CLOSE*/
/**/
//submit the form
var errorMessageLOS = "Please reduce the number of days to 28 or less.";
var calDateFormat = "dd/mm/yy";

function ChoseDates(frm) {
	var hotel_location = $("#hotel_location").val() ;

	if ($("#choseDatesStartDate").val() == "" || $("#choseDatesStartDate").val() == calDateFormat) {
		$("#choseDatesStartDate").focus();
		return false;
	}

	if ($("#choseDatesEndDate").val() == "" || $("#choseDatesEndDate").val() == calDateFormat) {
		$("#choseDatesEndDate").focus();
		return false;
	}

	if (!validateDatesExt("choseDatesStartDate", "choseDatesEndDate")) {
		return false;
	}

	book.checkIn =  $("#choseDatesStartDate").val().split("/")[2]+'-'+ $("#choseDatesStartDate").val().split("/")[1]+'-'+ $("#choseDatesStartDate").val().split("/")[0];
	book.checkOut =   $("#choseDatesEndDate").val().split("/")[2]+'-'+ $("#choseDatesEndDate").val().split("/")[1]+'-'+ $("#choseDatesEndDate").val().split("/")[0];
	book.bookNow();
}//ChoseDates

function validateDatesExt(startDateName, endDateName) {
	if (!ValidateCheckInOutExt(startDateName, endDateName)) {
		$(".errorMessage").text(errorMessageLOS).show();
		return false;
	}
	else {
		//$("#dateVldMsg").hide();
		return true;
	}
}

function RedefineDate(DateValue) {
	if (DateValue == "") return "";
	var resultDate = DateValue;

	var dateSplits = DateValue.split("/");
	var ddmmyyyyReg = /\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}/;
	var yyyymmddReg = /\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}/;
	var strMonth;
	var strDay;
	var strYear;

	if (ddmmyyyyReg.test(DateValue)) {
		strDay = dateSplits[0];
		strMonth = dateSplits[1];
		strYear = dateSplits[2];
	}
	else if (yyyymmddReg.test(DateValue)) {
		strDay = dateSplits[2];
		strMonth = dateSplits[1];
		strYear = dateSplits[0];
	}
	resultDate = strMonth + "/" + strDay + "/" + strYear;
	return resultDate;
}//RedefineDate

function validateDateFormat(Date1, Date2) {
	var ret = false;
	var ddmmyyyyReg = /\d{1,2}(\-|\/|\.)\d{1,2}\1\d{4}/;
	var yyyymmddReg = /\d{4}(\-|\/|\.)\d{1,2}\1\d{1,2}/;

	if ((ddmmyyyyReg.test(Date1) && ddmmyyyyReg.test(Date2)) || (yyyymmddReg.test(Date1) && yyyymmddReg.test(Date2)))
	{ ret = true; }

	return ret;
}//validateDateFormat

function compareDate(date1, date2) {
	return (date2 > date1) ? true : false;
}//compareDate

function GetDateDiff(Date1, Date2) {
	var one_day = 1000 * 60 * 60 * 24;

	var diff = Math.round((Date2.getTime() - Date1.getTime()) / (one_day));
	return diff;
}//GetDateDiff

function ValidateCheckInOutExt(startDateName, endDateName) {
	var startStr = $("#" + startDateName).val();
	var endStr = $("#" + endDateName).val();
	var startDate = new Date(RedefineDate(startStr));
	var endDate = new Date(RedefineDate(endStr));

	var now = new Date();
	var nowDate = new Date((now.getMonth() + 1) + "/" + now.getDate() + "/" + now.getFullYear());
	var ret = true;

	if (!validateDateFormat(startStr, endStr)) {
		ret = false;
		//errorMsg = CAM_FMTMATMsg;
		return ret;
	}
	if (!compareDate(startDate, endDate)) {
		ret = false;
		//errorMsg = CAM_CKMsg;
		return ret;
	}
	if (startDate < nowDate) {
		ret = false;
		//errorMsg = CAM_CICANTBFTODAYMsg;
		return ret;
	}
	if (!compareDate(nowDate, endDate)) {
		ret = false;
		//errorMsg = CAM_COCANTBFTODAYMsg;
		return ret;
	}
	if (GetDateDiff(startDate, endDate) > 25) {
		ret = false;
		//errorMsg = CAM_NOMORE25;
		return ret;
	}
	return ret;
}//ValidateCheckInOutExt

function showDeviceWidth() {
	var thewidth = $(this).width();
}

$(document).on('click','.close_btn', function(e) {
	$("#check_in_dates").css("display", "none");
	return false;
});
/*
$(window).scroll(function() {
    if (nextgen.isPagination == true) {
        if($(window).scrollTop() == $(document).height() - $(window).height()) {
          //  nextgen.pageNumber = +nextgen.pageNumber + +nextgen.pageLimit;
            //nextgen.displayPaginationCards();
        }
    }
});
*/

//Using setTimeout only isn't a correct solution because you have no idea how long it will take for the content to be loaded so it's possible the popstate event is emitted after the timeout.
window.addEventListener('load', function() {
    setTimeout(function() {
        window.addEventListener('popstate', function() {
            window.location.reload();
        });
    }, 0);
});

//The popstate event is fired when the active history entry changes
//event is only triggered by doing a browser action such as a click on the back button (or calling history.back() in JavaScript).
/*var popped = ('state' in window.history && window.history.state !== null), initialURL = location.href;

window.addEventListener('popstate', function(event) {
    var initialPop = !popped && location.href == initialURL
    if ( initialPop ) return
    alert('inside' + popped);
    //window.location.reload();
    return;
});
alert('outside' + popped);*/

$(document).on('click', '.showmorehotels', function() {
    $(this).remove();
    nextgen.pageNumber = +nextgen.pageNumber + +nextgen.pageLimit;
    nextgen.displayPaginationCards();
});

var device = 'desktop';
$(document).ready(function() {
	var url = '', level = 0;
    nextgen.selRegion = region;
	if (region != '')
		level = 1;
	if (country != '')
		level = 2;

	x = nextgen.init();
	x.local = local;
	x.data = JSON.parse(data);
	x.dataP = JSON.parse(dataP);
    console.log('URL =>' + x.dataP['info']['url']);
    console.log('DocNam =>'+  x.dataP['info']['docName']);
	x.drawMenu(nextgen.selRegion);
	x.mobileMenu();

	if (level == 1) {
		x.drawCountry(region, region);
		x.mapAction('');
	} else if(level == 2) {
		x.drawCountry(region, region);
		x.drawCities(region, region + '/' + country);

		var country_code, prop = Object.keys(x.getCountrys);
		if (prop.length > 0 && prop !== 'undefined') {
			$.each(prop, function(i, v) {
				$.each(x.getCountrys[v], function(ii, vv) {
					if (ii == 'url' && vv == region + '/' + country) {
						country_code = v;
					}
				});
			});
		}
		x.mapAction(country_code);
	}
	if ($(this).width() < 768)
		device = 'mobile';

	if (region == '')
		x.drawCards(true);	// draw hotel cards
	else
		x.drawCards();	// draw hotel cards
});
//SPA
$(document).on('click', '.menu-region,.menu-country,.menu-city,.mobile_regions,.mobile-menu-region,.mobile-city', function(e) {
	e.preventDefault();
	var cacheObj = $(this),
	url = $(this).attr('href'),
	x = nextgen.init(),
	res = x.sendRequest(url, 'returnType=json');
	if (cacheObj.data('lavel') == 1) {
		x.drawCountry(cacheObj.data('code'), cacheObj.data('url'));
	} else if(cacheObj.data('lavel') == 2) {
		x.drawCities(x.selRegion, cacheObj.data('url'));
	}
	if($.trim($(this).data('device'))=="mobile"){
		device = 'mobile'
		if (cacheObj.data('lavel') == 1) {
			x.drawMenuCountry(cacheObj.data('code'), cacheObj.data('url'));	}
		else if(cacheObj.data('lavel') == 2) {
			x.drawMenuCities(x.selRegion, cacheObj.data('url'));
		}
	}
	if(($.trim($(this).data("mobcity"))=="mobcity")){
		$(this).parent().parent().parent().parent().find(".dropdown").removeClass('open');
	}
	res.success(function(data){
		x.dataP = data;
        console.log('URL =>' + x.dataP['info']['url']);
        console.log('DocNam =>'+  x.dataP['info']['docName']);
		x.drawCards();
		x.setUrlToHistory(url); // Change url on browser
		x.mapAction(cacheObj.data('cnt-code'));
        x.drawMenu(nextgen.selRegion);
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
		'local' : '',
		'data' : '', //data,
		'dataP' : '',//page data
		'selRegion' : '',
        'getRegion' : '',
		'selCountry' : '',
		'selCity' : '',
		'getRegions' : '',
		'getCountrys' : '',
		'getCities' : '',
		'getLavel' : 1,
        'pageNumber' : '1',
        'pageLimit' : '10',
        'paginationMode' : 'tier_3',
        'isPagination' : false,
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
        'displayPaginationCards' : function() {
           var k = 1, j = 1, showMoreHtls = false;		
            $.each(this.dataP['data'], function(index, value) {
                $.each(value.split(','), function(i, v) {
                    if (index == nextgen.paginationMode) {
                        if (j >= nextgen.pageNumber) {
                            if (k <= nextgen.pageLimit) {
                                if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null) {
                                    $('.display-cards').append(nextgen.displayHotels(nextgen.data['deals'][v]));
                                    k++;
                                }
                            } else {
                                if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null)
                                    showMoreHtls = true;
                                return;
                            }
                        }
                        j++;
                    }
                });
            });
            if (k > 1 && showMoreHtls == true)
                $('.display-cards').append('<div class="showmorehotels">'+ trans['show-more-deals'] +'</div>');

            // Initialize lazy load,
            // Remove the class "lazy" for double initialization for loaded images

            $("img.lazy").lazyload({
                effect : "fadeIn"
            }).removeClass("lazy");

			//magnifying glass icon placing based 
			magnifyingGlassIcon();
        },
		'drawCards' : function(def) {
            isLoggedIn = $.cookie('mid') !== undefined ? true: false;
            mId = $.cookie('mid');
			$('.display-cards').html('');
			$('.display-cards-gold').html('');
			$('.mobile-platinum-card').html('');
            $('.hotel_platinum_cards').removeClass("hidden");
			if (def == true) {
				$('.hd-main-info').attr('id', 'hotel_card_block');
				$('.hotel_gold_cards_list').hide();
                $('.hotel_platinum_cards').addClass("hidden");
			} else {
				$('.hotel_gold_cards_list').show();
				$('.hd-main-info').attr('id', 'hotel_gold_card_block');
			}
			var tire_2_key = 0, tire_1_key = 0;
			$.each(this.dataP['data'], function(index, value) {
                var columnOffset = 1;
				$.each(value.split(','), function(i, v) {
					if (def == true) {
                        if (index == 'tier_1') {
                            if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null) {
                                nextgen.data['deals'][v].borderStyle = ' platinum-border';
                                //$('.display-cards').append(nextgen.displayHotels(nextgen.data['deals'][v]));
                            }
                        }
                    } else {

                        if (index == 'tier_1') {
                            if (tire_1_key == 0) {

								if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null) {
                                    nextgen.data['deals'][v].columnOffset = columnOffset;
									if (device == 'mobile')
										$('.mobile-platinum-card').append(nextgen.platinumCardMobile(nextgen.data['deals'][v])).show();
									else
										$('.hotel_platinum_cards').html(nextgen.PlatinumCard(nextgen.data['deals'][v])).show();
								}
								tire_1_key++;
							}

						}
						if (index == 'tier_2') {
							if (tire_2_key <= 2) {
								if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null) {
                                    nextgen.data['deals'][v].columnOffset = columnOffset;
                                    nextgen.data['deals'][v]['tier'] = "2";
									$('.display-cards-gold').append(nextgen.displayHotels(nextgen.data['deals'][v]));
									tire_2_key++;
								}
							}
						}
						if(tire_2_key==0){ $('.hotel_gold_cards_list').hide(); }
						else{ $('.hotel_gold_cards_list').show(); }
						/*if (index == 'tier_3') {
							if (typeof(nextgen.data['deals'][v]) != "undefined" && nextgen.data['deals'][v] !== null) {
								$('.display-cards').append(nextgen.displayHotels(nextgen.data['deals'][v]));

							}
						}*/

                        columnOffset++;
                        columnOffset = columnOffset > 2 ? 1 : columnOffset;
					}
				});
			});

            //display through pagination
            if (def == true) {
                nextgen.paginationMode = 'tier_1';
            } else {
                nextgen.paginationMode = 'tier_3';
            }
            nextgen.pageNumber = 1; // reset page number
            nextgen.isPagination = true;
            nextgen.displayPaginationCards();


		},

		'PlatinumCard' : function(obj){
			var html = '';
                html += '<div id="platinum-toggle"></div>';
                html += '<div class="Bestdeals">';
                //html += '<div class="col-md-4 col-lg-2" id="Bestdeals">';
                html += '<div id="best_deals"></div>';
                //html += '</div>';
                html += '<div id="platinum_image"><a href="' + obj['psi_url'] +'">';
                html += '<img  width="111" height="76" alt="'+obj['hotel_name']+'" src="'+obj['image_url']+'">';
                html += '</a></div>';
                html += '<div class="col-md-5 col-lg-4" id="hotel_content-platinum">';
                html += '<div class="hotel_gold_cards_heading hidden-xs">';
                html += '<div class="hotel_name col-md-10 col-lg-10"><a href="' + obj['psi_url'] +'">';
            if (obj['hotel_name'].length > 44) {
                html += obj['hotel_name'].substring(0, 41) + '.. ';
            } else {
                html += obj['hotel_name'];
            }
                html += '</a></div>';
                html += '<div class="platinum_review">';
                html += '<img height="" width="" alt="hotel rank" class="img-responsive" src="'+imageHelper.getStarUri(obj['star_rating'])+'">';
                html += '</div>';

                html += '<div class="clearfix "></div>';
                html += '<div class="hotel_city">' + obj['city_name'] + '</div>';
                html += '<div class="campaign-promo-offer pull-left">'+ obj['offer'] + '</div>';
                html += '<div class="font_red member-extras-text hotel_member_extras_icon">';
                    if(isLoggedIn){
                    //html += '<div class="sign-in-member-offer offer-for-existing-members font_red">'+obj['offer_moo']+'</div>';
                    html += obj['offer_moo'];
                } else {

                    //html += '<div style="display:;" class="sign-out-member-offer">';
                    //html += '<span>';
                        html += '<a href="https://www.hotelclub.com/account/login?destinationUrl=' + $(location).attr('href') +'">'
                    html += trans['mem_inactive_line1'] + '&nbsp;' + trans['mem_inactive_line2'] ;
                        html += '</a>';
                    //html += '</span>';
                    //html += '</div>';
                }
                html += '</div>';
                html += '</div>';

				html += '</div>';
				html += '<div class="saveBookInfo-platinum platinum_offer col-md-2 col-lg-2">';
            /** check for different type of deals **/
                if(obj['is_moo'] == '1'){
                    html += trans['members_only'];
                } else{
                    var offerText = trans['promo_pc_off_template'].replace('<br>','');
                    html += offerText.replace('<pc_off>', obj['discount_amount']);
                }
				html += '<div class="hidden-xs btn button">';
				html += '<a class="ht-book" id="'+obj['oneg_id']+'" data-oneg="'+obj['oneg_id']+'">'+trans['select']+'</a>';
				html += '</div>';
				html += '</div>';
				html += '</div>';

			return html;
		} ,
		'platinumCardMobile' : function(obj) {
			var html = '';
				html += '<div class="hotel_mobile_platinum_cards">';
				//html += '<div class="hotel_mobile_platinum_cards col-xs-12  col-sm-12 col-md-11 col-lg-8">';
				html += '<div class="Bestdeals">';
				html += '<div class="platinum_card_images" id="hotel_image">';
				html += '<img width="100%" id="image_gold" class="img-responsive" src="'+obj['image_url']+'" alt="'+obj['hotel_name']+'">';
				html += '</div>';
				html += '<div class="deal_card_images" id="deal_images">';
				html += '<img height="74" width="67" id="image_gold" class="img-responsive" alt="" src="/n/themes/common/img/Bestdeals.png">';
				html += '</div>';
				html += '<div class="clearfix col-xs-12" id="hotel_content">';
				html += '<div class="hotel_cards_heading hidden-lg hidden-md">';
				html += '<div class="hotel_platinum_name "><a href="' + obj['psi_url'] +'">'+obj['hotel_name']+'</a>';
				html += '</div>';
				html += '<div class="platinum_hotel_city">'+ obj["city_name"] +'</div>';
				html += '<div class="gold_hotel_review">';
				html += '<img height="" width="" alt="'+obj['star_rating']+'" class="img-responsive" src="'+imageHelper.getStarUri(obj['star_rating'])+'">';
				html += '</div>';
		        html += '</div></div>';
                html += '<div class="saveBookInfo col-xs-4">';
                if(obj['is_moo'] == '1'){
                    html += trans['members_only'];
                } else{
                    var offerText = trans['promo_pc_off_template'];
                    html += offerText.replace('<pc_off>', obj['discount_amount']);
                }
		        html += '<div class="clearfix "></div>';
		        html += '</div>';
		        html += '<div class="btn platinum_book">';
		        html += '<a class="ht-book" id="'+obj['oneg_id']+'" data-oneg="'+obj['oneg_id']+'">'+trans['select']+'</a>';
		        html += '</div>';
		        html += '</div>';
		        html += '</div>';
	        return html;
		},
		//Display hotel card
		'displayHotels' : function(obj) {

			var html = '';
			//$.each(obj, function(index, val) {
				html += '<div id="card-' + obj['oneg_id'] + '" class="hotel_cards tier-' + obj['tier'] + ' card-column-' + obj['columnOffset'] + obj['borderStyle'] + ' col-xs-11  col-sm-11 col-md-11 col-lg-5" data-oneg="'+obj['oneg_id']+'">';
				html += '<div class="hotel_cards_heading hidden-xs">';
                //hotelNameClass = obj['hotel_name'].length + obj["city_name"].length > 49 ? 'hotel_name_small' : 'hotel_name';
                hotelNameClass = 'hotel_name';
				html += '<span class="' + hotelNameClass + ' visible-lg col-lg-10"><a href="' + obj['psi_url'] +'">';
				if (obj['hotel_name'].length > 37) {
                    html += obj['hotel_name'].substring(0, 35) + '.. ';
                }else {
                    html += obj['hotel_name'] + ', ';
                }
                if (obj['city_name'].length > 10) {
                    html += '</a><span class="hotel_city">' + obj["city_name"].substr(0, 9) + '..</span></span>';
                    // Tablet version of Hotel name Landscape view
                    html += '<span class="hotel_name visible-md col-md-10"><a href="' + obj['psi_url'] +'">';
                }else {
                    html += '</a><span class="hotel_city">' + obj["city_name"] + '</span></span>';
                    // Tablet version of Hotel name Landscape view
                    html += '<span class="hotel_name visible-md col-md-10"><a href="' + obj['psi_url'] +'"  >';
                }
				if (obj['hotel_name'].length > 27)
					html += obj['hotel_name'].substring(0, 26) + '...';
				else
					html += obj['hotel_name']+', ';
					html += '</a><span class="hotel_city">'+ obj["city_name"] +'</span></span>';
					// Tablet version of Hotel name Portrait view
					html += '<span class="hotel_name visible-sm col-sm-10"><a href="' + obj['psi_url'] +'">';
					html += obj['hotel_name']+', ';
					html += '</a><span class="hotel_city">'+ obj["city_name"] +'</span></span>';
					//html += '<span class="hotel_city">'+ obj["city_name"] +'</span>';
					html += '<span class="hotel_review col-xs-3 col-sm-2 col-md-2 col-lg-2"><img src="'+imageHelper.getStarUri(obj['star_rating'])+'" class="img-responsive" alt="hotel rank" width="" height=""/></span>';
					html += '</div>';
					html += '<div class="hotel_details">';
					html += '<div id="hotel_image"  class="col-xs-5 col-sm-3 col-md-4 col-lg-4"><a href="'+ obj['psi_url'] + '">';
					html += '	<img data-original="'+obj['image_url']+'" alt="'+obj['hotel_name']+'" class="lazy img-responsive" id="image_hotel" alt="" />';
					html += '</a></div>';
					html += '<div id="hotel_content"  class="col-xs-5 col-sm-5 col-md-5 col-lg-4">';
				//var discount;
				//$.each(deals[index]['offer'], function(key, val) {
					html += '	<div class="hidden-xs campaign-promo-offer">'+ obj['offer'] + '</div>';
					//discount = val['percent_off'];
				//});
				//Mobile version
				html +='<div class="visible-xs">';
						html += '<div><a class="hotel_name col-xs-7" href="' + obj['psi_url'] + '">';
				if (obj['hotel_name'].length > 28)
					html += obj['hotel_name'].substring(0, 26) + '...';
				else
					html += obj['hotel_name'];
					html += '</a>'+ obj["city_name"] +'</div>';
					//html += '<div class="hotel_city col-xs-4 ">'+ obj["city_name"] +'</div>';
					html += '<div class="clearfix hotel_review col-xs-10 pull-right"><img src="'+imageHelper.getStarUri(obj['star_rating'])+'" class="img-responsive" alt="hotel rank" width="" height=""/></div>';
					html += '<br/>';
					html += '<div class="col-xs-10 member_rewards"><div class="campaign-promo-offer">'+ obj['offer'] + '</div> </div>';
					//html +='<div class="earn  col-xs-10"> Earn <span> $90.98</span></div>';
					html +='</div>';
				// members-extras-block
                if (obj['offer_moo'] !== '') {
                    html += '<div class="hotel_member_extras">' + trans['mem_extras'] + '</div>';
                    html += '<div class="font_red member-extras-text">';
                    //$.each(deals[index]['offer_moo_t'], function(mkey, mval) {
                    if (isLoggedIn) {
                        html += '<div class="hidden-xs sign-in-member-offer offer-for-existing-members font_red">';
                        //});
                        if (obj['offer_moo'] != '' && obj['offer_moo'] != null)
                            html += obj['offer_moo'] + '</div>';
                        else
                            html += ' </div>';
                    } else {

                        html += '<div class="sign-out-member-offer">';
                        html += '<span>';
                        //Show_JoinHotelClub_Popup()
                        html += '<p><a href="https://www.hotelclub.com/account/login?destinationUrl=' + $(location).attr('href') +'">' + trans['mem_inactive_line1'] + '<br />' + trans['mem_inactive_line2'] + '</a></p>';
                        html += '</span>';
                        html += '</div>';
                    }
                }
				html += '</div>';
				html += '</div>';
				html += '<div class="saveBookInfo col-xs-2 col-sm-2 col-md-2 col-lg-2"><div class="discount-block">';
            if(obj['is_moo'] == '1'){
                html += trans['members_only'];
            } else{
                var offerText = trans['promo_pc_off_template'];
                html += offerText.replace('<pc_off>', obj['discount_amount']);
            }
				html += '</div>';
				html += '<div class="clearfix "></div>';
				html += '<div class=" btn button">';
				html += '<a class="col-xs-10 col-sm-12 col-md-12 col-lg-12 ht-book" id="'+obj['oneg_id']+'" data-oneg="'+obj['oneg_id']+'">'+trans['select']+'</a>';
				html += '</div>';
				//html += '<br>';
				html += '<p class="hidden-xs inclusions">'+obj['travel_text']+'</p>';
				html += '</div>';
				html += '</div>';
				html += '</div>'; //end card
				
			//});
				return html;
		},
		'drawMenu' : function(restrictName) {
			var html = '',
				reg  = [];
			html += '<div id="header">';
			html += '<ul id="menu_new">';
			var position = (nextgen.selRegion === 'undefined' || nextgen.selRegion == '') ? 0 : 1; //To find the position of menu (Apply CSS)
			$.each(this.data['urls'], function(index, value){
                if (restrictName != index) {
                    html += '<li class="dropdown-submenu">';
					if(position == 4)
				            html += '<a class="menu-icons menu-region" tabindex="-1" style="border-right:none !important" data-url="' + index + '" data-lavel="1" data-code="' + index + '" href="' + uriBase + '/' + index + '">' + value['name'] + '<b class="menu-glyphicon"></b></a>';
				    else
                        html += '<a class="menu-icons menu-region" tabindex="-1" data-url="' + index + '" data-lavel="1" data-code="' + index + '" href="' + uriBase + '/' + index + '">' + value['name'] + '<b class="menu-glyphicon"></b></a>';
                        html += '</li>';
					
					//condition to display region labels based on langauge with hyperlink
					switch(index){
						case 'pacific':
							$(".world_pacific").empty(); 
							$(".world_pacific").append('<a href="'+ uriBase +'/'+ index +'">'+ value["name"] +'</a>'); 
							break;
						case 'southeast-asia':
							$(".world_south_eastern").empty();
							$(".world_south_eastern").append('<a href="'+ uriBase +'/'+ index +'">'+ value["name"] +'</a>'); 
							break;
						case 'northeast-asia':
							$(".world_north_eastern").empty();
							$(".world_north_eastern").append('<a href="'+ uriBase +'/'+ index +'">'+ value["name"] +'</a>');
							break;
						case 'europe--uae':
							$(".world_europe").empty();
							$(".world_europe").append('<a href="'+ uriBase +'/'+ index +'">'+ value["name"] +'</a>');
							break;
						case 'americas':
							$(".world_america").empty();
							$(".world_america").append('<a href="'+ uriBase +'/'+ index +'">'+ value["name"] +'</a>');
							break;
					}
                    position++;
                }
				reg[value['name_en']] = value['name'];
			

			});
			html += '</ul>';
			html += '</div>';
			this.getRegions = reg;
			//this.getLavel = 1;
			$("ul#menu_new > li:nth-child(5)").children().css( "border-right", "3px double #e21e28" );
			$('#regionTabs').html(html);
			
		},
		'mobileMenu' : function() {

			var html = '',
				reg  = [];
			html += '<div id="mobile_menu">';
			html += '<ul id="mobile_menu_new">';
			$.each(this.data['urls'], function(index, value){
				html += '<li class="mobile_regions">';
				html += '<a class="mobile-menu-icons mobile-menu-region" tabindex="-1" data-device="mobile" data-url="'+index+'" data-lavel="1" data-code="'+ index +'" href="' + uriBase +'/' + index +'">' + value['name'] + '<b class="glyphicon glyphicon-chevron-right pull-right"></b> </a>';
				html += '</li>';
				html += '<li class="mobile_divider"> </li>';
				reg[value['name_en']] = value['name'];
			});
			html += '</ul>';
			html += '</div>';
			this.getRegions = reg;
			this.getLavel = 1;
			$('#mobileTabs').html(html);
		},
		'drawCountry' : function(region, url) {
				$('.display_regions').css('background-color', 'white');	
			var html = '', flag = false, country = [];
			regoinEN = this.data['urls'][region]['name_en'];
			regoinName = this.data['urls'][region]['name'];

			$.each(this.data['urls'][region], function(index, value){

				if (flag == false) {
					html += '<div data-h-name="'+ regoinEN +'"><h4><a class="glyphicon glyphicon-chevron-left back_icon" href="javascript:%20mapBackBtn();"></a>'+ regoinName +'</h4></div>';
					html += '<div class="divider_menu"></div>';
					html += '<div id="vertical-scrollbar">';
					html += '<ul class="country_name">';
				}
				flag = true;
				if (typeof value === 'object') {
					var name = false,name_en = false, lavel = false, country_code= false;
					$.each(value, function(key, val){

						if (key == 'name') name = val;
						if (key == 'level') lavel =val;
						if (key == 'name_en') name_en = val;
						if (key == 'country_code') country_code = val;

						if (name != false && lavel != false && name_en != false && country_code != false && lavel == 2) {

							html += '<li class="country_name_list">';
							html += '<a tabindex="-1" class="menu-icons menu-country" data-cnt-code="'+country_code+'" tabindex="-1" data-url="'+index+'" data-lavel="'+lavel+'" data-code="'+name_en+'" href="'+ uriBase+'/'+ index+'"> '+ name+' </a>';
							html += '</li>';
							html += '<li class="tab_divider"></li>';
							country[country_code] = {'url' : index, 'name_en' : name, 'name' : name};
							name = false,name_en = false, lavel = false, country_code= false;
						}
					});
				}
			});

			html += '</ul>';
			html += '</div>';
			nextgen.selRegion = region;
			this.getCountrys = country;
			this.getLavel = 2;
			$('.display_regions').html(html);
			},
		'drawCities' : function(region, countryUrl) {
			$('.display_regions').css('background-color', 'white');	
			var html = '', flag = false, cities = [], heading = false, headingEn = false;

			$.each(this.data['urls'][region][countryUrl], function(index, value){

				if (index == 'name_en') headingEn = value;
				if (index == 'name') heading = value;

				if (heading != false && headingEn != false && flag == false) {
					html += '<div data-h-name="'+ headingEn +'"><h4><a class="glyphicon glyphicon-chevron-left back_icon" href="javascript:%20mapBackBtn();"></a>'+ heading +'</h4></div>';
					html += '<div class="divider_menu"></div>';
					html += '<div id="vertical-scrollbar">';
					html += '<ul class="country_name">';
					flag = true;
				}

				if (typeof value === 'object') {
					var name = false, name_en = false, lavel = false;
					$.each(value, function(key, val){

						if (key == 'name') name = val;
						if (key == 'level') lavel = val;
						if (key == 'name_en') name_en = val;

						if (name != false && lavel != false && name_en != false && lavel == 3) {

							html += '<li class="city_name_list">';
							html += '<a tabindex="-1" class="menu-icons menu-city" tabindex="-1" data-lavel="'+lavel+'" data-code="'+name_en+'" href="'+ uriBase+'/'+ index+'"> '+ name+' </a>';
							html += '</li>';
							html += '<li class="tab_divider"></li>';
							//cities[name_en] = name;
							cities[name] = {'url' : index, 'name_en' : name_en};
							name = false,name_en = false, lavel = false;
						}
					});
				}
			});

			html += '</ul>';
			html += '</div>';
			this.getCities = cities;
			this.getLavel = 3;
			$('.display_regions').html(html);

		},
			'drawMenuCountry' : function(region, url) {

			var html = '', flag = false, country = [];
			regoinEN = this.data['urls'][region]['name_en'];
			regoinName = this.data['urls'][region]['name'];

			$.each(this.data['urls'][region], function(index, value){

				if (flag == false) {
					html += '<div data-h-name="'+ regoinEN +'"><a onclick="window.history.back();return false;"> <h4><span class="glyphicon glyphicon-chevron-left back-button pull-left"></span>'+ regoinName +'</h4></a></div>';
					html += '<div class="divider_menu"></div>';
					html += '<div id="vertical-scrollbar">';
					html += '<div class="dropdown">';
					html += '<button id="dLabel" class="regions_list" type="button" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">';
					html += '<span class="pull-left">Country</span>';
					html += '<span class="glyphicon glyphicon-chevron-down button-down pull-right"></span>';
					html += '</button>';
					html += '<ul class="dropdown-menu country_name" role="menu" aria-labelledby="dLabel">';

				}
				flag = true;
				if (typeof value === 'object') {
					var name = false,name_en = false, lavel = false, country_code= false;
					$.each(value, function(key, val){

						if (key == 'name') name = val;
						if (key == 'level') lavel =val;
						if (key == 'name_en') name_en = val;
						if (key == 'country_code') country_code = val;

						if (name != false && lavel != false && name_en != false && country_code != false && lavel == 2) {
							html += '<li class="country_name_list">';
							html += '<a tabindex="-1" class="menu-icons menu-country" data-cnt-code="'+country_code+'" data-device="mobile" tabindex="-1" data-url="'+index+'" data-lavel="'+lavel+'" data-code="'+name_en+'" href="'+ uriBase+'/'+ index+'"> '+ name+' </a>';
							html += '</li>';
							html += '<li class="tab_divider"></li>';
							country[country_code] = {'url' : index, 'name_en' : name, 'name' : name};
							name = false,name_en = false, lavel = false, country_code= false;
						}
					});
				}
			});

			html += '</ul>';
			html += '</div>';
			html += '</div>'
			nextgen.selRegion = region;
			this.getCountrys = country;
			this.getLavel = 2;
			$('#mobileTabs').hide();
			$('.display_mobile_regions').html(html);
		},
		'drawMenuCities' : function(region, countryUrl) {

			var html = '', flag = false, cities = [], heading = false, headingEn = false;

			$.each(this.data['urls'][region][countryUrl], function(index, value){

				if (index == 'name_en') headingEn = value;
				if (index == 'name') heading = value;				
				
				if (heading != false && headingEn != false && flag == false) {							
					html += '<div data-h-name="'+ headingEn +'"><a onclick="window.history.back();return false;"><h4><span class="glyphicon glyphicon-chevron-left back-button pull-left"></span>'+ heading +'</h4></a></div>';
					html += '<div class="divider_menu"></div>';
					html += '<div id="vertical-scrollbar">';
					html += '<div class="dropdown">';
					html += '<button id="dLabel"  class="regions_list" type="button" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">';
					html += '<span class="pull-left">City</span>';
					html += '<span class="glyphicon glyphicon-chevron-down button-down pull-right"></span>';
					html += '</button>';
					html += '<ul class="dropdown-menu country_name" role="menu" aria-labelledby="dLabel">';
					flag = true;
				}

				if (typeof value === 'object') {
					var name = false, name_en = false, lavel = false;
					$.each(value, function(key, val){

						if (key == 'name') name = val;
						if (key == 'level') lavel = val;
						if (key == 'name_en') name_en = val;
						if (name != false && lavel != false && name_en != false && lavel == 3) {

							html += '<li class="city_name_list">';
							html += '<a tabindex="-1" class="menu-icons menu-city mobile-city" tabindex="-1" data-mobcity="mobcity" data-lavel="'+lavel+'" data-code="'+name_en+'" href="'+ uriBase+'/'+ index+'"> '+ name+' </a>';
							html += '</li>';
							html += '<li class="tab_divider"></li>';
							//cities[name_en] = name;
							cities[name] = {'url' : index, 'name_en' : name_en};
							name = false,name_en = false, lavel = false;
						}
					});
				}
			});

			html += '</ul>';
			html += '</div>';
			this.getCities = cities;
			this.getLavel = 3;
			$('#mobileTabs').hide();
			$('.display_mobile_regions').html(html);

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
		},
		'mapAction' : function(country_code) {
            menuBg = nextgen.getLavel > 1 ? 'white' : '';
            $('.display_regions').css('background-color', menuBg);

            if(nextgen.getLavel==2){
				data = regionMapConf('country-code', regions[nextgen.selRegion][0]);
				if(regions[nextgen.selRegion][0]=='155'){ eventDataTempVal = '150';  }
				else if(regions[nextgen.selRegion][0]=='021'){ eventDataTempVal = '019';  }
				else{ eventDataTempVal = regions[nextgen.selRegion][0]; }
				options.region = eventDataTempVal;
				options.resolution = 'country';
				options.displayMode = 'text';
				backButton = 1;
				changeResetToRegion();
				magnifyingGlassIcon();
				resetMapSizePos();
				displayRegionName();
				drawRegionsMapOne();

			}else{
				if (typeof(country_code) != "undefined" && country_code !== null) {
					data = regionMapConf('city-code', country_code);
					options.region = country_code;
					options.resolution = 'country';
					options.displayMode = 'text';
					backButton = 1;
					changeResetToRegion();
					magnifyingGlassIcon();
					resetMapSizePos();
					hideRegionName();
					drawRegionsMapOne();
				}
			}	
		}
};
// Image healper
var imageHelper = {
	//Image uri builder
	'CLASSIC_HOTEL_CONTENT_URI' : 'http://www.hotelclub.com/ad-unit/promodeals/images/',
	'ORBITZ_HOTEL_SITE_IMAGES_URI' : 'http://www.tnetnoc.com/siteImages/',
	'classicHotelImageUri' : function(oneg){
		return this.CLASSIC_HOTEL_CONTENT_URI + 'mp_v1_' + oneg + '.jpg';
	},
	'getStarUri' : function(star) {
		//return this.ORBITZ_HOTEL_SITE_IMAGES_URI + 'ORB/icons/stars/star' +star+ '/medium/star' +star+ '-1.png';
		return '/n/themes/common/img/star' +star+ '-50.png';
	}
}
//Hotel booking
var hotelBook = {
	'adult' : '2',
	'onegId' : '',
	'checkIn' : '',
	'checkOut' : '',
	'coupon' : '',
	'locale' : '',
	'type' : 'hotel',
	'init' : function() {
		return this;
	},
	'bookNow' : function() {
		window.location = this.buildUri();
	},
	'buildUri' : function() {
		var uri = 'http://www.hotelclub.com/psi/?type='+ this.type + '&adults='+ this.adult +'&id='+ this.onegId;
		uri += '&checkin='+ this.checkIn + '&checkout=' + this.checkOut +'&coupon=' +this.coupon+'&locale='+this.locale;
		return uri;
	}
}

/** World map specific **/
var regions = {
    'europe--uae': ["155","154","145","039"],
    'pacific': ["053", "054", "057", "061"],
    'southeast-asia': ['035'],
    'northeast-asia': ['030'],
    'americas': ["021","029", "013", "005"],
    'africa': ["015"]
};

//Geochart (Google Map Chart) Initialization
google.load("visualization", "1", {packages:["geochart"]});
google.setOnLoadCallback(drawRegionsMapOne);

//Global Variables
var mapHeight = 430; //map Height
var mapWidth = 900; //map Width
var xAxis = 0; //to increase the Map width
var yAxis = 0; //to increase the Map height
var options = {
		region: 'world',
		resolution: 'subcontinents',
		width: mapWidth,
		height: mapHeight,
		backgroundColor: '#3682B6',  // blue Ocean colour
		//backgroundColor: {stroke : '#ff9900'},  // blue Ocean colour
		legend: 'none',
		tooltip: { trigger: 'none'},
		datalessRegionColor : "#FBE580",  //diabled region color
		enableRegionInteractivity: 'true',
        keepAspectRatio: false
	};

//data to draw the map
function regionMapConf(type, eventDataTemp){
	var data;
	if (type == 'country-code') {
		//fetching all the countries within the clicked region
		countries = [];
		if(typeof eventDataTemp=="undefined"){ var eventDataTemp = options.region; }
		$.each(regions, function(key, val) {
				if(val.indexOf(eventDataTemp)>=0){
					countries.push(['lable','Countries', 'Value']);
					$.each(nextgen.data['urls'][key], function(keyCountry, valCountry) {
						var countryNameTemp = valCountry.name;
						if (typeof(countryNameTemp) != "undefined" && countryNameTemp !== null) {
							countries.push([valCountry.name_en,valCountry.name, 100]);
						}
					});
				}
			});
			
		if (typeof countries !== 'undefined' && countries.length > 0) {
			data = google.visualization.arrayToDataTable(countries);
		}
		/* Apply position fix for Americas */
        if(eventDataTemp==019){ $("#regions_div").css('top', '-500'); }
		options.colors = ['#000000'];
        //options.resolution = 'countries';
        //options.datalessRegionColor = "#559dce";
	}else if (type == 'city-code') {
		//fetching all the cities within the clicked country
		var citys = [];
		citys.push(['lable','Countries', 'Value']);
		if(typeof eventDataTemp=="undefined"){ var eventDataTemp = options.region; }		
		for(var cityName in nextgen.getCities){
			citys.push([nextgen.getCities[cityName].name_en,cityName, 100]);
		}
		if (typeof citys !== 'undefined' && citys.length > 0) {
			data = google.visualization.arrayToDataTable(citys);
		}
		options.colors = ['#000000'];
	} else {
		options.region = 'world';
		options.resolution = 'subcontinents';
		options.backgroundColor = '#3682B6';
		options.datalessRegionColor = "#FBE580";  //disabled countries
		options.displayMode = 'none';
		urls = [];
		urls.push(['Regions','Name', 'Value']);
		$.each(nextgen.data['urls'], function(key, val) {
			$.each(regions[key], function(subRegionKey, subRegionVal) {
				urls.push([subRegionVal,key,100]);
			});
		});
		data = google.visualization.arrayToDataTable(urls);
		options.colors = ['#FBE580'];  // make all regions the same yellowish color
	}
	return data;
}//regionMapConf

var backButton=0;//var is used to identify the back button activities

/**
 * toggle platinum card
 *
 */
function expandPlatinumCard(){
        $(".hotel_platinum_cards").removeClass("platinum-collapsed").addClass("platinum-expanded");
}
//drawing the map
function drawRegionsMapOne(type){

	//Continent ids are provided in array
	if(backButton!=1){ data = regionMapConf(type);	}
	var view = new google.visualization.DataView(data);
	view.setColumns([0, 1]);
	if(mapHeight<510){
		options.width = mapWidth;
		options.height = mapHeight;
		var geochart = new google.visualization.GeoChart(document.getElementById('regions_div'));
		//Creating a geochart based on eventData
		google.visualization.events.addListener(geochart, 'regionClick', function(eventData) {
			if ((eventData.region).length == 2) { //country
				//Checks if regions is not available, not going to dispaly
				if (typeof nextgen.getCountrys[eventData.region] === 'object') {
					res = nextgen.sendRequest(uriBase + '/' + nextgen.getCountrys[eventData.region]['url'], 'returnType=json');
					res.success(function(data){
						nextgen.dataP = data;
						nextgen.drawCards();
						nextgen.drawCities(nextgen.selRegion, nextgen.getCountrys[eventData.region]['url']);
						nextgen.setUrlToHistory(uriBase + '/' + nextgen.getCountrys[eventData.region]['url']); //
						data = regionMapConf('city-code', eventData.region);
						nextgen.mapAction(eventData.region);

						options.displayMode = 'text';
						changeResetToRegion();
						resetMapSizePos();
						hideRegionName();
						nextgen.getLavel=3;
					})
					.error(function(data){
						console.log('Exception: '+ data.responseText);
					});

				}
			}else if((eventData.region).length == 3){ //region
				var eventDataRegionVal;
				if(nextgen.getLavel!=1){
					var eventDataRegionVal;
					switch(eventData.region){
						case '054': eventData.region = 'FJ'; eventDataRegionVal=1; break;//assign the eventData.region to Fiji
						case '154': eventData.region = 'GB'; eventDataRegionVal=1; break;//assign the eventData.region to Great Britain
					} 
				}
				if(eventDataRegionVal==1){//sub region country value is clicked
					res = nextgen.sendRequest(uriBase + '/' + nextgen.getCountrys[eventData.region]['url'], 'returnType=json');
					res.success(function(data){
						nextgen.dataP = data;
						nextgen.drawCards();
						nextgen.drawCities(nextgen.selRegion, nextgen.getCountrys[eventData.region]['url']);
						nextgen.setUrlToHistory(uriBase + '/' + nextgen.getCountrys[eventData.region]['url']); //
						data = regionMapConf('city-code', eventData.region);
						nextgen.mapAction(eventData.region);

						options.displayMode = 'text';
						changeResetToRegion();
						resetMapSizePos();
						hideRegionName();
					})
					.error(function(data){
						console.log('Exception: '+ data.responseText);
					});
				}else{//redraw the original map sun region
					$.each(regions, function(key, val) {
						if(val.indexOf(eventData.region)>=0){
							data = regionMapConf('country-code', eventData.region);
							options.region = eventData.region;
							options.resolution = 'country';
							var region_name = '';
							$.each(regions, function(index, value) {
								$.each(value, function(i, v){
									if (v == eventData.region)
										region_name = index;
									return;
								});
							});

							res = nextgen.sendRequest(uriBase + '/' + region_name, 'returnType=json');
							res.success(function(data){
								nextgen.dataP = data;
								nextgen.drawCards();
								nextgen.drawCountry(region_name, region_name);
								nextgen.selRegion = region_name;
								//x.selectMenu(cacheObj); // select menu
								nextgen.setUrlToHistory(uriBase + '/' + region_name); //
								nextgen.mapAction('');
						
								options.displayMode = 'text';
								changeResetToRegion();
								resetMapSizePos();
								hideRegionName();
								nextgen.drawMenu(nextgen.selRegion);
								nextgen.getLavel=2;
							})
							.error(function(data){
								console.log('Exception: '+ data.responseText);
							});						
						}
					});
				}
			}
		});
		//resetMapSizePos();
		if(nextgen.getLavel==1){ displayRegionName(); }
		else{ hideRegionName(); }
		geochart.draw(data, options);
		myTimer = setInterval(function(){ setCordinateVal(); clearTimerVal(); }, 2500);			
	}
    expandPlatinumCard();
}//drawRegionsMapOne

var countryCodeValTemp;
//URL
$(document).ready(function() {
	var myTimer;
});

//Function to reset map
function resetMap(){
	resetMapSizePos();
	data = regionMapConf();
	drawRegionsMapOne();
}//resetMap
$(document).on('click','text[text-anchor="middle"]',function(){
	var sel = $.trim($(this).text()), url='';
	//nextgen.mapClickRequest('city', $.trim($(this).text()));
	//console.log(nextgen.data['urls'][nextgen.selRegion]);
	$.each(nextgen.data['urls'][nextgen.selRegion], function(index, value){
		if(nextgen.getLavel==3){ //while clicking on city label
			if (typeof value === 'object') {
				$.each(value, function(i, v){
					if (typeof v === 'object') {
						$.each(v, function(ii, vv){
							if (ii == 'name' && vv == sel)
								url = i;
								return;
						});
					}
				});
			}
		}else if(nextgen.getLavel==2){ //while clicking on country label
			if (typeof value === 'object') {
				if(value.name == sel){
					countryCodeVal = value.country_code;
					url = index;
					return;
				}
			}
		}
	});
	res = nextgen.sendRequest(uriBase + '/' + url, 'returnType=json');
	res.success(function(data){
		nextgen.dataP = data;
		nextgen.drawCards();
		//x.selectMenu(cacheObj); // select menu
		nextgen.setUrlToHistory(uriBase + '/' + url); // Change url on browser
		
		if(nextgen.getLavel==2){//while clicking on country label modify the map
			nextgen.drawCities(nextgen.selRegion, nextgen.getCountrys[countryCodeVal]['url']);
			data = regionMapConf('city-code', countryCodeVal);
			nextgen.mapAction(countryCodeVal);

			options.displayMode = 'text';
			changeResetToRegion();
			resetMapSizePos();
			hideRegionName();
		}
		magnifyingGlassIcon();
	})
	.error(function(data){
		console.log('Exception: '+ data.responseText);
	});


});

//Function to zoom-out map from the selected region / country
function mapBackBtn() {
	var optionsRegionTemp = options.region; var eventTempDataVal;
	if(optionsRegionTemp.length==2){

		res = nextgen.sendRequest(uriBase + '/' + nextgen.selRegion, 'returnType=json');
		res.success(function(data){
			nextgen.dataP = data;
			nextgen.drawCards();
			nextgen.drawCountry(nextgen.selRegion, nextgen.selRegion);
			//x.selectMenu(cacheObj); // select menu
			nextgen.setUrlToHistory(uriBase + '/' + nextgen.selRegion); //
			//nextgen.mapAction('');		

			eventTempDataVal = regions[nextgen.selRegion][0];
			data = regionMapConf('country-code',eventTempDataVal);
			options.region = eventTempDataVal;
			changeResetToRegion();
			nextgen.getLavel = 2;
			changeResetToRegion();
			backButton=1;
			resetMapSizePos();
			hideRegionName();
			nextgen.mapAction(optionsRegionTemp);
			//drawRegionsMapOne();
		})
		.error(function(data){
			console.log('Exception: '+ data.responseText);
		});
	}else{

		res = nextgen.sendRequest(uriBase, 'returnType=json');
		res.success(function(data){
			nextgen.dataP = data;
            nextgen.getLavel = 1;
            nextgen.selRegion = '';
            nextgen.drawMenu('');
			nextgen.drawCards(true);
			$('.display_regions').html('');
			//document.getElementById('regions_div').style.top = '-75px';
			//x.selectMenu(cacheObj); // select menu
			nextgen.setUrlToHistory(uriBase); //
			nextgen.mapAction('');
		})
		.error(function(data){
			console.log('Exception: '+ data.responseText);
		});

		data = regionMapConf();
		changeResetToRegion();

		changeResetToRegion();
		resetMapSizePos();
		drawRegionsMapOne();
	}
}//mapBackBtn

function changeResetToRegion(){
	var zoomLevel = 1;//variable to place zoom icons based on levels
	//variable to place zoom icons based on levels
	if(nextgen.getLavel==2){
		zoomLevel = 2;
		$( "#banner_val" ).empty();
		$( "#banner_val" ).append("<a class='map-reset-to-region' href='javascript:%20mapBackBtn();'>< " + trans['world_view'] + "</a><div id='zoom_level'><span class='urlPlusImg' ></span><div class='zoom-indicator-high'><img src='/n/themes/common/img/red-dot.png'/></div><a href='javascript:%20mapBackBtn();' class='urlMinusImg' ></a></div>");
	}
	else if(nextgen.getLavel==3){
		zoomLevel = 3;
		$( "#banner_val" ).empty();

		//var regionName = nextgen.selRegion.replace("-", " ");
		var regionName = nextgen.data['urls'][nextgen.selRegion]['name_en'];
        var regionNameTrans = regionName.replace(/\s+/g, '_').toLowerCase() + '_view';
        $( "#banner_val" ).append("<a class='map-reset-to-region' href='javascript:%20mapBackBtn();'>< "+ trans[regionNameTrans] +"</a><div id='zoom_level'><span class='urlPlusImg' ></span><div class='zoom-indicator-medium'><img src='/n/themes/common/img/red-dot.png'/></div><a href='javascript:%20mapBackBtn();' class='urlMinusImg' ></a></div>");
	}
	else{
		zoomLevel = 1;
		$( "#banner_val" ).empty();//clearing back button and zooming icons
	}
}//changeResetToRegion

function zoomin() {
	if(mapHeight<510){
		mapWidth = mapWidth+40;//zooming map width
		mapHeight = mapHeight+40;//zooming map height
		//checking the clicked event and modifying according to top of the regions_div id
		if(options.region=='019'){ if(mapHeight==470){ yAxis = yAxis-12-80;}else{ yAxis = yAxis-12; } }
		else if(options.region=='150'){ if(mapHeight==470){ yAxis = yAxis-12-45; }else{ yAxis = yAxis-12; } }
		else if(options.region=='030'){ if(mapHeight==470){ yAxis = yAxis-12-65; }else{ yAxis = yAxis-12; } }
		else if(options.region=='035'){ if(mapHeight==470){ yAxis = yAxis-12-60; }else{ yAxis = yAxis-12; } }
		else if(options.region=='CA'){ if(mapHeight==470){ yAxis = yAxis-12-85; }else{ yAxis = yAxis-12; }  }
		else if(options.region=='US'){ if(mapHeight==470){ yAxis = yAxis-12-65; }else{ yAxis = yAxis-12; }  }
		else if(options.region=='FJ'){ if(mapHeight==470){ yAxis = yAxis-12-65; }else{ yAxis = yAxis-12; }  }
		else if(options.region=='VN'){ if(mapHeight==470){ yAxis = yAxis-12-55; }else{ yAxis = yAxis-12; }  }
		else if(options.region=='ES'){ if(mapHeight==470){ yAxis = yAxis-12-55; }else{ yAxis = yAxis-12; }  }
		else if(options.region=='DE'){ if(mapHeight==470){ yAxis = yAxis-12-85; }else{ yAxis = yAxis-12; }  }
		else{ yAxis = yAxis-12; }	
		
		//checking the clicked event and modifying according to left of the regions_div id
		if(options.region=='MY'){  if(mapHeight==470){ xAxis = xAxis+100; }else{ xAxis = xAxis-12 } }
		if(options.region=='US'){  if(mapHeight==470){ xAxis = xAxis+80; }else{ xAxis = xAxis-12 } }
		else{ xAxis = xAxis-12;	}	

		//set the regions_div value based on modified zooming
		document.getElementById('regions_div').style.top = yAxis+'px';
		document.getElementById('regions_div').style.left = xAxis+'px';
		
		//redrawing the map
		if(options.region.length==3){ drawRegionsMapOne(); }
	}
}//zoomin

function resetMapSizePos(){
	xAxis = 0;	yAxis = 0;//variable declaration for placing the map position
	//based on map level setting the top and left of regions_div value
	if(nextgen.getLavel==1){
		document.getElementById('regions_div').style.top = '-90px';
	}else{
		if(options.region=='019'){ document.getElementById('regions_div').style.top = '-80px'; }
		else if(options.region=='150'){ document.getElementById('regions_div').style.top = '-45px'; }
		else if(options.region=='030'){ document.getElementById('regions_div').style.top = '-65px'; }
		else if(options.region=='035'){ document.getElementById('regions_div').style.top = '-60px'; }
		else if(options.region=='CA'){ document.getElementById('regions_div').style.top = '-85px';  }//Canada
		else if(options.region=='US'){ document.getElementById('regions_div').style.top = '-45px';  }//USA
		else if(options.region=='FJ'){ document.getElementById('regions_div').style.top = '-65px';  }//Fiji
		else if(options.region=='VN'){ document.getElementById('regions_div').style.top = '-55px';  }//Vietnam
		else if(options.region=='ES'){ document.getElementById('regions_div').style.top = '-50px';  }//Spain
		else if(options.region=='DE'){ document.getElementById('regions_div').style.top = '-85px';  }//Germany
		else if(options.region=='GB'){ document.getElementById('regions_div').style.top = '-75px';  }//United Kingdom
		else if(options.region=='TH'){ document.getElementById('regions_div').style.top = '-45px';  }//Thailand
		else if(options.region=='ID'){ document.getElementById('regions_div').style.top = '-35px';  }//Indonesia
		else{ document.getElementById('regions_div').style.top = '0px';  }	
	}

	//change the aspectratio to true only in usa else false
	if(options.region=='US'){ options.keepAspectRatio=true; }
	else{ options.keepAspectRatio=false; }

	//condition to check whether the clicked map region is malaysia or not
	if(options.region=='MY'){ document.getElementById('regions_div').style.left = '100px';  } //Malaysia
	else if(options.region=='US'){ document.getElementById('regions_div').style.left = '80px';  } //USA
	else if(options.region=='ES'){ document.getElementById('regions_div').style.left = '-50px';  } //Spain
	else { document.getElementById('regions_div').style.left = 0; }

	//setting the map default height and width
	mapWidth = 900;
	mapHeight = 430;		
}//resetMapSizePos

function hideRegionName(){
	$(".text_on_map").hide();
	$(".banner_default_map").hide();
	//$('.text_on_map').css('display') == 'none';
}//hideRegionName

function displayRegionName(){
	$(".text_on_map").show();
	$(".banner_default_map").show();
	//$('.text_on_map').css('display') == 'block';
}//displayRegionName

//PopUpblocker
/*DIALOG BOX WORKS*/
$(document).ready(function() {	
//fn_load();
/* Date-picker in search form */

//$( "select[name='hotel.rooms[1].chlds']" ).change(function() {
$("select[id*='Childrooms']").change(function() {
getval = $(this).val();
var room_val=$(this).attr("id");
 var room_id= room_val.replace(/[^0-9]/g, '');
if(getval == undefined) getval = 1;
if (getval == "0") {
$('#child_travellers'+room_id).addClass("noneBlock");
$('.ChildLabel1Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock"); 
$('.ChildLabel2Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");       
$('.ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");  
}
if (getval == "1") {
$('#child_travellers'+room_id).removeClass("noneBlock");
$('.ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel2Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");       
$('.ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");           
}
if (getval == "2") {
$('#child_travellers'+room_id).removeClass("noneBlock");
$('.ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");   
$('.ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");           
}
if (getval == "3") {
$('#child_travellers'+room_id).removeClass("noneBlock"); 
$('.ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");       
$('.ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");    
$('.ChildLabel3Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
$('.ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
}
if (getval == "4") {
$('#child_travellers'+room_id).removeClass("noneBlock");
$('.ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
$('.ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");         
$('.ChildLabel3Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel4Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");   
}
if (getval == "5") {
$('#child_travellers'+room_id).removeClass("noneBlock");
$('.ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock"); 
$('.ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");      
$('.ChildLabel3Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel4Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
$('.ChildLabel5Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");  
}
});

var maxAppend = "1";
 $('.addRoom').on('click', function () {
 var id_int= $(this).attr('id');
 var id_val= id_int.replace(/[^0-9]/g, ''); 
 if(id_val == maxAppend){
 var addone="1";
 var toggleVal=Number(id_val)+Number(addone);
 if(toggleVal<=4){

 $("#visible_room"+toggleVal).css("display", "block");
 $("#addRemove"+id_val).css("display", "none");
 $("#addRemove"+toggleVal).css("display", "block");
 }
 }
 maxAppend++;
});
var maxAppend = "1";
 $('.removeRoom').on('click', function () {
 var id_int= $(this).attr('id');
 var id_val= id_int.replace(/[^0-9]/g, ''); 
 if(id_val == maxAppend){
 var addone="1";
 var toggleVal=Number(id_val)-Number(addone);

 $("#visible_room"+id_val).css("display", "none");
 $("#addRemove"+id_val).css("display", "none");
  $("#addRemove"+toggleVal).css("display", "block");
 }
 maxAppend--;
});
   $("select[id*='search_Childrooms']").change(function() {
        getval = $(this).val();
        var room_val=$(this).attr("id");
        var room_id= room_val.replace(/[^0-9]/g, '');
        if(getval == undefined) getval = 1;
        if (getval == "0") {
            $('.search_childTravelers').addClass("noneBlock");
            $('#search_ChildLabel1Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel2Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
        }
        if (getval == "1") {
            $('.search_childTravelers').removeClass("noneBlock");
            $('#search_ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel2Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
        }
        if (getval == "2") {
            $('.search_childTravelers').removeClass("noneBlock");
            $('#search_ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel3Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
        }
        if (getval == "3") {
            $('.search_childTravelers').removeClass("noneBlock");
            $('#search_ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel3Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel4Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
            $('#search_ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
        }
        if (getval == "4") {
            $('.search_childTravelers').removeClass("noneBlock");
            $('#search_ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel3Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel4Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel5Room'+room_id).removeClass("inlineBlock").addClass("noneInlineBlock");
        }
        if (getval == "5") {
            $('.search_childTravelers').removeClass("noneBlock");
            $('#search_ChildLabel1Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel2Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel3Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel4Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
            $('#search_ChildLabel5Room'+room_id).removeClass("noneInlineBlock").addClass("inlineBlock");
        }
    });

    var maxAppend = "1";
    $('.search_addRoom').on('click', function () {
        var id_int= $(this).attr('id');
        var id_val= id_int.replace(/[^0-9]/g, '');
        if(id_val == maxAppend){
            var addone="1";
            var toggleVal=Number(id_val)+Number(addone);
            if(toggleVal<=4){
                $("#search_visible_room"+toggleVal).css("display", "block");
                $("#search_addRemove"+id_val).css("display", "none");
                $("#search_addRemove"+toggleVal).css("display", "block");
            }
        }
        maxAppend++;
    });
    var maxAppend = "1";
    $('.search_removeRoom').on('click', function () {
        var id_int = $(this).attr('id');
        var id_val = id_int.replace(/[^0-9]/g, '');
        if (id_val == maxAppend) {
            var addone = "1";
            var toggleVal = Number(id_val) - Number(addone);
            $("#search_visible_room" + id_val).css("display", "none");
            $("#search_addRemove" + id_val).css("display", "none");
            $("#search_addRemove" + toggleVal).css("display", "block");
        }
        maxAppend--;
    });


 //PopUpblocker
});

//magnifyingGlassIcon
function magnifyingGlassIcon(){
	if(nextgen.getLavel==1){ $('.magnifyGls').empty();$('.magnifyGls').append('<img src="/n/themes/common/img/search-icon.png" width="18"/>'); }
	else{ $('.magnifyGls').empty(); $('.magnifyGls').append('<img src="/n/themes/common/img/search-icon-white.png" width="18"/>'); }
}//magnifyingGlassIcon

//set the cordinate value for overlapping cities cities
function setCordinateVal(){
	$('text[y="150.13434695893721"]').attr('y','142');//Sunshine Coast	
	$('text[y="156.4683643212726"]').attr('y','154');//Brisbane
	$('text[y="160.7397236658385"]').attr('y','170');//Gold Coast
	$('text[y="198.19348283715038"]').attr('y','195');//Port Stephens
	$('text[y="191.64050088533318"]').attr('y','189');//Atlantic City, NJ
	$('text[y="197.79237327011035"]').attr('y','205');//Sunshine Coast
	$('text[y="368.1003383731635"]').attr('y','350');//Toronto	
}//setCordinateVal

//stop the timer value
function clearTimerVal(){
	clearInterval(myTimer);	
}//clearTimerVal
//multi-languages
$(document).on('click', '#open_languages', function(e) {

$(".multi_languages").addClass("open");
	//$("#mbl_menu_logo").removeAttr("data-toggle");
	});

// Load iframe without blocking  the load event
function createIframe(){
    var i = document.createElement("iframe");
    var m = document.createElement("iframe");
    var locale = local;
    // Load banners based on locale
    if( bannerFlowId !== 'undefined'){
        var bannerMobileId = bannerFlowId[0];
        var bannerId = bannerFlowId[1];
    } else {
        var bannerMobileId = '642721';
        var bannerId = '642722';
    }
    i.src = "//html5.host.bannerflow.com/ad_" + bannerId + "_178.html?clicktag=";
    i.scrolling = "no";
    i.frameborder = "0";
    i.width = "100%";
    i.height = "82px";
    document.getElementById("bannerFlow").appendChild(i);

    m.src = "//html5.host.bannerflow.com/ad_" + bannerMobileId + "_178.html?clicktag=";
    m.scrolling = "no";
    m.frameborder = "0";
    m.width = "100%";
    m.height = "121px";
    document.getElementById("bannerFlowMobile").appendChild(m);
};

// Check for browser support of event handling capability
if (window.addEventListener)
    window.addEventListener("load", createIframe, false);
else if (window.attachEvent)
    window.attachEvent("onload", createIframe);
else window.onload = createIframe;

function loginParser() {
    /* Requesting the url to get members value */
    //alert('Parser');
    var hclUrl = "//www.hotelclub.com/?locale=" + local;
    var request = $.ajax(hclUrl);

    request.done(function (msg) {
        // alert(msg);
        var cookieset =  $.cookie('mid') // get cookie tmid value
        if (cookieset != '' && cookieset != null) {
            var Mydata = $.trim(msg);
            /* filter the members value from Requested data*/
            var htmlObject = $($.parseHTML(Mydata));
            var welcomeText = htmlObject.find('#header .aboveNav ul.login li.welcomeText').html();
            var loyaltyTier = htmlObject.find('#header .aboveNav ul.login li.loyaltyTier').html();
            var loyaltyInfo = htmlObject.find('#header .aboveNav ul.login li.loyaltyInfo').html();
            /* if Cookies tmid value is set then displays the data */


            // alert(welcomeText);
            if (welcomeText != '' && loyaltyTier != '' && typeof loyaltyTier != 'undefined' && loyaltyInfo != '' && typeof loyaltyInfo != 'undefined') {
                $('.sign_in-link').hide();
                $('.register-link').hide();
                $('ul.login li.welcomeText').html(welcomeText);
                $("ul.login").append('<li class="loyaltyTier">' + loyaltyTier + '</li>');
                $("ul.login").append('<li class="loyaltyInfo">' + loyaltyInfo + '</li>');
                $("ul.login").append('<li class="signOutLink"><a href="https://www.hotelclub.com/account/logout" class="link" rel="nofollow">' + msgSignOut + '</a></li>');
            }
        }
    });
}
loginParser();