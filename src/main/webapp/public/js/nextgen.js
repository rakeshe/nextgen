/**
 *
 * @package    nextgen
 * @since      26/11/13 7:25 PM
 * @version    1.0
 */
$(document).ready(function(){

    /** Search Form Dektop date picker  */
    var closeText = "Close";
    var currentText = "Today";
    var checkRates = "Check Rates";
    $('#checkin').datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '+364D',
        minDate: 0,
        numberOfMonths: 2,
        showCurrentAtPos: 0,
        closeText: closeText,
        currentText: currentText,
        showButtonPanel: true,
        firstDay: 0,
        dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
        onSelect: function(dateText, inst){ $('#checkout').datepicker("option", "minDate", $('#checkin').val()); }
    });
    $('#checkout').datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '+364D',
        minDate: 0,
        numberOfMonths: 2,
        showCurrentAtPos: 0,
        closeText: closeText,
        currentText: currentText,
        showButtonPanel: true,
        onSelect: function(dateText, inst){ $('#checkin').datepicker("option", "maxDate", $('#checkout').val()); }
    });
 /** /Search Form Tablet date picker */

     /** Search Form Desktop date picker  */
    var closeText = "Close";
    var currentText = "Today";
    var checkRates = "Check Rates";
    $('#tab_checkin').datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '+364D',
        minDate: 0,
        numberOfMonths: 2,
        showCurrentAtPos: 0,
        closeText: closeText,
        currentText: currentText,
        showButtonPanel: true,
        firstDay: 0,
        dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
        onSelect: function(dateText, inst){ $('#tab_checkout').datepicker("option", "minDate", $('#tab_checkin').val()); }
    });
    $('#tab_checkout').datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '+364D',
        minDate: 0,
        numberOfMonths: 2,
        showCurrentAtPos: 0,
        closeText: closeText,
        currentText: currentText,
        showButtonPanel: true,
        onSelect: function(dateText, inst){ $('#tab_checkin').datepicker("option", "maxDate", $('#tab_checkout').val()); }
    });
 /** /Search Form Tablet date picker */

     /** Search Form Mobile date picker  */
    var closeText = "Close";
    var currentText = "Today";
    var checkRates = "Check Rates";
    $('#mob_checkin').datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '+364D',
        minDate: 0,
        numberOfMonths: 1,
        showCurrentAtPos: 0,
        closeText: closeText,
        currentText: currentText,
        showButtonPanel: true,
        firstDay: 0,
        dayNamesMin: [ "S", "M", "T", "W", "T", "F", "S" ],
        onSelect: function(dateText, inst){ $('#mob_checkout').datepicker("option", "minDate", $('#mob_checkin').val()); }
    });
    $('#mob_checkout').datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        maxDate: '+364D',
        minDate: 0,
        numberOfMonths: 1,
        showCurrentAtPos: 0,
        closeText: closeText,
        currentText: currentText,
        showButtonPanel: true,
        onSelect: function(dateText, inst){ $('#mob_checkin').datepicker("option", "maxDate", $('#mob_checkout').val()); }
    });
 /** /Search Form Mobile date picker */

    /** Carousel controls **/
        $('.carousel').carousel({
            interval: 6000
        });

        $('.carousel').carousel('next');

});

/* Region Tabs-Mobile Toggle Event */
$(document).ready(function(){
		
$( "#regions" ).click(function() {
$( "#mbl_banner .region_panels" ).hide();
$( "#mbl_banner .region_menu" ).show();

});
/* hover mobile responsive*/
$( ".menu-icons" ).hover(
function() {
$( this ).find("b").removeClass( "glyphicon-plus" );
 $( this ).find("b").addClass( "glyphicon-minus" );
}, function() {
 $( this ).find("b").removeClass( "glyphicon-minus" );
  $( this ).find("b").addClass( "glyphicon-plus" );
});
/* Ontouch mobile responsive*/
$( ".region_menu .dropdown-toggle" ).click(function() {
$(this).find("span").toggleClass( "glyphicon-minus");
if($( ".glyphicon" ).hasClass( "glyphicon-minus" ) == true){
$(".btn-default").find("span").removeClass("glyphicon-minus");
$(this).find("span").toggleClass( "glyphicon-minus");
}
var button_count=$( ".region_menu .btn-group-vertical" ).find("button").length; 
var get_id=$(this).attr("id").replace(/[^0-9]/g, ''); 
get_id=get_id-1;
var setpos = get_id*1;
setpos=-setpos;
var getpos= setpos+"px";
$( ".region_menu .dropdown-menu" ).css("top",""+getpos+"");

});
});
function validate_searchform(){
  var flag = false;
  var errFlag = false;
  if ($.trim($('#locationText').val()) == ''){	
  $( ".destination_search" ).html("<p class='error_msg'>Enter location(s)</p>");
  $( ".checkBoxDestinations" ).addClass("errorFocusChk");
  flag = true;
  }else {
  $( ".destination_search" ).empty();
  $(".checkBoxDestinations").removeClass('errorFocusChk');
  }
  if ($.trim($('input[name="checkin"]').val()) == ''){
  $( ".checkBoxDestinations" ).css("outline","0px solid none");		
  $( ".startdate" ).html("<p class='error_msg'>Select date</p>");		
  $("input[name='checkin']").addClass('errorFocus');
  flag = true;
  errFlag = true;
  } else {
  $( ".startdate" ).empty();
  $("input[name='checkin']").removeClass('errorFocus');
  }
  if ($.trim($('input[name="checkout"]').val()) == ''){
  $( ".checkBoxDestinations" ).css("outline","0px solid none");		
  $( ".startdate" ).html("<p class='error_msg'>Select date</p>");		
  $("input[name='checkout']").addClass('errorFocus');
  flag = true;
  } else {
  if (errFlag == false)
  $( ".startdate" ).empty();
  $("input[name='checkout']").removeClass('errorFocus');
  }	
  if (flag == false)
  return true;
  return false;
  }
$("#btnSearch").click(function() {
    validate_searchform();
    var local = $("#locationText").val(),
    checkIn = $("#checkin").val(),
    checkOut = $("#checkout").val(),
    promo = $("#couponCode").val(),
    languageCode = $("#btnSearch").data('local');
    window.location = "http://www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="+promo+"&hotel.keyword.key="+local+"&hotel.rooms[0].adlts=2&hotel.type=keyword&hotel.chkin="+checkIn+"&hotel.chkout="+checkOut+"&search=Search&locale="+languageCode+"&lpid.category=hot-mkt-dated&lpid.priority=1200.0&lpid=hotelGpSearch";
    console.log(local + checkIn + checkOut + promo );
});

$(document).ready(function(){
    function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#locationText" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
           url: "/merch/get-location",
          dataType: "json",
          data: {
             q: request.term
          },
          success: function( data ) {
            console.log(data.suggestion);
            var dataArr = [];
            $.each(data, function(key, val){
              dataArr.push(val.suggestion);
                console.log(key+'--'+val.suggestion);
            });
            response( dataArr );
          }
        });
      },
      minLength: 1,
      select: function( event, ui ) {
        log( ui.item ?
          "Selected: " + ui.item.label :
          "Nothing selected, input was " + this.value);
      },
      open: function() {
        $( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
      },
      close: function() {
        $( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
      }
    });
  });



/* /Region Tabs-Mobile Toggle Event */