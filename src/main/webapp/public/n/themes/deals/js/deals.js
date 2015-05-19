(function( $, HB ) {

    var Deals = {

        init : function() {

            $('.filter').hide();
            this.displayHeader();
            //this.displayRobot();
            //this.displaySortBox();
            //this.displayFilter();
            //this.displayHotelCards();
            //this.displayRegionHotelCards();
            //this.displayUpsell();
            this.displayFooter();
            this.displayDropDownData();
        },

        reLoadLandingPage: function() {

            $('.section .container #sort-row-uq').html('');
            $('.section .hotel-cards-container').html('');
            this.setDropDownDefaultOption().dropRegion();
            this.setDropDownDefaultOption().dropCities().attr('disabled','disabled');
            this.setDropDownDefaultOption().dropWhereDo().attr('disabled','disabled');
            $('.search-sale-box').show();
        },

        route : function(obj, ctrl) {

            if (typeof this[ctrl] == 'function') {

                if(typeof obj == 'object') {
                    history.pushState({url: obj.city}, obj.city + ' Hotels', obj.city);
                }
                this[ctrl]();
            } else {
                console.log('Controller not found!!');
            }
        },

        hotelCardCtrl : function() {
            $('.search-sale-box').hide();
            this.displaySortBox();
            this.displayHotelCards();
        },

        displayRobot : function() {
            var template = HB.compile( $("#robot-template").html() );
            $('body').append(template()).addClass();
        },

        displayHeader : function() {
            var template = HB.compile( $("#header-template").html() );
            $('#header-container').append(template());
        },

        displayFilter : function() {
            var template = HB.compile( $("#filter-template").html() );
            $('#filter-box').append(template());
            $('#filter-btn').show();
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

        setDropDownDefaultOption : function() {
            return {
                dropRegion : function() {
                   return $('.dropdown-region').append( $('<option>', {
                        value : '0',
                        text : 'Where do you want to go?',
                        'selected' :'selected'
                    }) );

                },
                dropCities : function() {
                    return $('.dropdown-cities').append( $('<option>', {
                        value : '0',
                        text : 'City?',
                        'selected' :'selected'
                    }) );
                },
                dropWhereDo : function() {
                    return $('.dropWhereDo').append( $('<option>', {
                        value : '0',
                        text : 'When do you want to go?',
                        'selected' :'selected'
                    }) );
                }
            }
        },

        displayDropDownData : function () {

            var dropRegion = this.setDropDownDefaultOption().dropRegion(),
                dropCities = this.setDropDownDefaultOption().dropCities(),
                dropWhereDo = this.setDropDownDefaultOption().dropWhereDo();

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
                    });
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


    Deals.init();
   // console.log(deals.getCityData());

    $(document).on('click', '.filter-button', function(e) {
        $('.filter').slideToggle();
        e.preventDefault();
    });

    $(document).ready(function(){

        $(window).bind('popstate', function(event) {

            var state = event.originalEvent.state;

            if (state) {
                Deals.route('', 'hotelCardCtrl');
            } else {
                Deals.reLoadLandingPage();
            }
        });

        //remove default select option
        $('.input-default-value').change(function() {
            //remove default option
            var className = $(this).data('rm-val');
            $('.' + className + ' option[value="0"]').remove();

            //release disable
            switch (className) {
                case 'dropdown-region' :
                    $('.dropdown-cities').removeAttr('disabled').removeClass('disabled-style');
                    break;

                case 'dropdown-cities' :
                    $('.dropWhereDo').removeAttr('disabled').removeClass('disabled-style');
                    break;

                case 'dropWhereDo' :
                    if ($(this).val() == ':robot') {
                        //initialize popup
                        //console.log($(this).val());
                        Deals.displayRobot();
                    } else {
                        //start routing ....
                       var rg = $('.dropdown-region').val(),
                           cy = $('.dropdown-cities').val(),
                           dy = $('.dropWhereDo').val();

                        console.log(typeof rg, typeof cy, typeof dy);
                        if (typeof rg == "string" && typeof cy == "string" && typeof dy == "string") {
                            //start routing ..
                            Deals.route({region:rg, city:cy, when:dy}, 'hotelCardCtrl');
                        }
                    }
                    break;
            }

        });

    });

})(jQuery, Handlebars);