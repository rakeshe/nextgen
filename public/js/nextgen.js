/**
 *
 * @package    nextgen
 * @author     Rakesh Shrestha
 * @since      26/11/13 7:25 PM
 * @version    1.0
 */
// Date picker widget
$(document).ready(function(){
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

    /** Carousel controls **/
        $('.carousel').carousel({
            interval: 6000
        });

        $('.carousel').carousel('next');

});