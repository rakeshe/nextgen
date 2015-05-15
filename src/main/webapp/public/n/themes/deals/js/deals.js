(function( $, HB ) {


    var deals = {

        init : function() {

            this.displayDropDownData();
            $('.filter').hide();
           // this.displayHotelCards();
            this.displayRegionHotelCards();
            this.displayFooter();
        },

        displayHotelCards : function() {
            var template = HB.compile( $("#hotel-card-template").html() );
            $('.section .hotel-cards-container').append(template());
        },

        displayRegionHotelCards : function () {

            var template = HB.compile( $("#region-card-template").html() );
            $('.section .region-cards-container').append(template());
        },

        displayFooter : function () {
            var template = HB.compile( $("#footer-template").html() );
            $('.section .footer-container').append(template());
        },

        getWhereDoGoText : function () {

            return {
                '2015-5-20' : 'in the next 7 days',
                '2015-5-29' : 'in the next 14 days',
                '2015-6-20' : 'in the next 30 days',
                '2015-6-20' : '30 days and beyond',
                ':datePopup' : 'exact dates'
            }
        },

        getCityData : function() {
            return $.parseJSON(cData);
        },

        displayDropDownData : function () {

            var dropRegion  = $('.dropdown-region'),
                dropCities  = $('.dropdown-cities')
                dropWhereDo = $('.dropWhereDo');

            $.each(this.getCityData(), function(key, val){

                dropRegion.append( $('<option>', {
                    value : key,
                    text : val.nameUtf8
                }) );

                if (typeof val.cities === 'object') {

                    $.each(val.cities, function (k, v) {
                        dropCities.append( $('<option>', {
                            value : k,
                            text : v.nameUtf8
                        }) );
                    })
                }
            });

            $.each(this.getWhereDoGoText(), function (key, val) {
                dropWhereDo.append(
                  $('<option>', {
                      value : key,
                      text : val
                  })
                );
            })
        }

    }

    deals.init();
   // console.log(deals.getCityData());

})(jQuery, Handlebars);

$(document).on('click', '.filter-button', function(e) {
    $('.filter').slideToggle();
    e.preventDefault();
});