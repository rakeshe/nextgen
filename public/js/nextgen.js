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

     /** Search Form Dektop date picker  */
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
        numberOfMonths: 2,
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
        numberOfMonths: 2,
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
$( this ).find("span").removeClass( "glyphicon-plus" );
 $( this ).find("span").addClass( "glyphicon-minus" );
}, function() {
 $( this ).find("span").removeClass( "glyphicon-minus" );
  $( this ).find("span").addClass( "glyphicon-plus" );
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



/* /Region Tabs-Mobile Toggle Event */