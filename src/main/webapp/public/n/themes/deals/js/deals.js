(function( $, HB ) {


    var deals = {

        init : function() {

            $('.filter').hide();
            this.displayHeader();
            //this.displayFilter();
            //this.displaySortBox();
            //this.displayHotelCards();
            //this.displayRegionHotelCards();
            //this.displayUpsell();
            this.displayFooter();
            this.displayDropDownData();
        },

        displayHeader : function() {
            var template = HB.compile( $("#header-template").html() );
            $('#header-container').append(template());
        },

        displayFilter : function() {
            var template = HB.compile( $("#filter-template").html() );
            $('#filter-box').append(template());
        },

        displayUpsell:function() {
            var template = HB.compile( $("#upsell-template").html() );
            $('#upsel-selection').append(template());
        },

        displaySortBox: function() {
            var template = HB.compile( $("#sort-template").html() );
            $('.section .container #sort-row-uq').append(template());
        },

        displayHotelCards : function() {
            //var template = HB.compile( $("#hotel-card-template").html() );
           // $('.section .hotel-cards-container').append(template());
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
                '7' : 'in the next 7 days',
                '14' : 'in the next 14 days',
                '30' : 'in the next 30 days',
                '31' : '30 days and beyond',
                ':robot' : 'exact dates'
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
