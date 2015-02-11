$(function() {
        'use strict';


        // Load Background Lazy
        $(document).ready(function() {
                history.pushState(null, null, "#");
                window.location.hash = '#';

                $('#error-email-message').hide();
                var bLazy = new Blazy({
                        breakpoints: [{
                                width: 500 // Max-width
                                ,
                                src: 'data-src-small'
                        }],
                        success: function(element) {
                                setTimeout(function() {
                                        // We want to remove the loader gif now.
                                        // First we find the parent container
                                        // then we remove the "loading" class which holds the loader image
                                        var parent = element.parentNode;
                                        parent.className = parent.className.replace(/\bloading\b/, '');
                                }, 200);
                        }
                });

                // Facebook
                window.fbAsyncInit = function() {
                        FB.init({
                                appId: '1490092684613879',
                                xfbml: true,
                                version: 'v2.1'
                        });
                };

                (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) {
                                return;
                        }
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                $('.facebook-login').click(function(e) {
                        e.preventDefault();
                        FB.login(function(response) {
                                if (response.authResponse) {

                                        FB.api(
                                                "/v1.0/me",
                                                function(profile_info) {
                                                        if (profile_info && !profile_info.error) {
                                                                $('#first_name').val(profile_info.first_name);
                                                                $('#last_name').val(profile_info.last_name);
                                                                $('#hidden-email').val(profile_info.email);
                                                                $('#email-textbox').val(profile_info.email);

                                                                $("#textField").blur();
                                                                setTimeout(function() {
                                                                    window.scrollTo(document.body.scrollLeft, document.body.scrollTop);
                                                                }, 20);
                                                                loadPlaces();


                                                        } else {
                                                                //alert('Error in fetching your data with facebook please try again.');
                                                        }
                                                }
                                        );
                                } else {
                                        alert('Error in login with facebook please try again.');
                                }
                        }, {
                                scope: 'email,user_likes'
                        });
                });

                //end facebook login

                if (Modernizr.touch) {
                        /* cache dom references */
                        var $body = $('body');

                        /* bind events */
                        $(document)
                                .on('focus', 'input', function(e) {
                                        $body.addClass('fixfixed');
                                })
                                .on('blur', 'input', function(e) {
                                        $body.removeClass('fixfixed');
                                });
                }

        });

        // Layout on Load / Resize / Responsive classes
        var $windowH,
                $windowW,
                $boxH,
                $boxW



        var $screen1 = $('.screen-1');

        var $windowW = $(window).width();
        var $windowH = $(window).height();

        $screen1.height($windowH);

        if (window.innerWidth < 800) {
                if (window.innerHeight > window.innerWidth) {
                        $('body').addClass('portrait');
                } else {
                        $('body').removeClass('portrait');
                }

        }

        if (window.innerWidth < 500) {
                if (window.innerHeight > window.innerWidth) {
                        $('body').addClass('mob');
                } else {
                        $('body').removeClass('mob');
                }

        }


        window.addEventListener("orientationchange", function() {
                // Announce the new orientation number

                $screen1.height(window.innerHeight);

                if (window.orientation == "-90" || window.orientation == "90") {
                        $('body').removeClass('portrait');
                        if (window.innerWidth < 800) {
                                $('.mobile-lands').show();
                        }
                } else {
                        $('.mobile-lands').hide();
                        $('body').addClass('portrait');
                }



        }, false);


        $('.screen-1, .screen-2').addClass('trans');

                $(window).bind("load resize", function() {
                // Window Resize / Load
                $windowW = $(window).width();
                $windowH = $(window).height();

                $('.place-details').attr('style', 'height:auto;');

                if (window.innerWidth < 800) {
                        if (window.innerHeight > window.innerWidth) {
                                $('body').addClass('portrait');
                        } else {
                                $('body').removeClass('portrait');
                        }

                } else {
                        $('body').removeClass('portrait');
                }

                if (window.innerWidth < 500) {
                        if (window.innerHeight > window.innerWidth) {
                                $('body').addClass('mob');
                        } else {
                                $('body').removeClass('mob');
                        }

                }

                setTimeout(function() {
                        $('#places-slide .owl-pagination').each(function() {
                                var trackW = $(this).width();
                                var pages = $(this).children().length - 1;

                                var percen = 100 / pages;

                                if (window.innerWidth < 700) {
                                        var lnt = pages * 12.1;
                                } else {
                                        var lnt = pages * 16.1;
                                }
                                var rckL = (trackW - lnt) / pages;
                                $(this).children().each(function(index, val) {
                                        $(this).css({
                                                marginLeft: (percen * index) + '%'
                                        });
                                });
                                $(this).children().first().css({
                                        marginLeft: 0
                                });
                                setTimeout(function() {
                                        var pDetHeight = -Infinity;
                                        $('#places-slide .place-details').each(function() {
                                                pDetHeight = Math.max(pDetHeight, parseFloat($(this).outerHeight()));
                                        });

                                        var elevationDueToNextButton = (getDetailPanelElevations()[0]*62);
                                        var pageBottom = pDetHeight + 35 + elevationDueToNextButton
                                        var pageBottom2 = pDetHeight + 17 + elevationDueToNextButton; // change/left

                                        $('#places-slide .tick-item').outerHeight(pDetHeight);
                                        $('#places-slide .place-details').outerHeight(pDetHeight);
                                        if (window.innerWidth < 700) {
                                                $('#places-slide .owl-pagination').css('bottom', pageBottom2 + 'px');
                                        } else {
                                                $('#places-slide .owl-pagination').css('bottom', pageBottom + 'px');
                                        }
                                        $('.screen-2 .col-left').removeClass('loading');
                                        $('.col-red .hide, .col-red .place-details, .col-red .tick-item, .col-red .owl-controls').css('opacity', 1);
                                }, 500);
                        });

                        $('#look-slide .owl-pagination').each(function() {
                                var trackW = $(this).width();
                                var pages = $(this).children().length - 1;
                                var percen = 100 / pages;
                                if (window.innerWidth < 700) {
                                        var lnt = pages * 12.1;
                                } else {
                                        var lnt = pages * 16.1;
                                }
                                var rckL = (trackW - lnt) / pages;
                                $(this).children().each(function(index, val) {
                                        $(this).css({
                                                marginLeft: (percen * index) + '%'
                                        });
                                });
                                $(this).children().first().css({
                                        marginLeft: 0
                                });
                                setTimeout(function() {
                                        var pDetHeight = -Infinity;
                                        $('#look-slide .place-details').each(function() {
                                                pDetHeight = Math.max(pDetHeight, parseFloat($(this).outerHeight()));
                                        });
                                        var elevationDueToNextButton = (getDetailPanelElevations()[1]*62);
                                        var pageBottom = pDetHeight + 35 + elevationDueToNextButton
                                        var pageBottom2 = pDetHeight + 17 + elevationDueToNextButton; // change/right

                                        $('#look-slide .tick-item').outerHeight(pDetHeight);
                                        $('#look-slide .place-details').outerHeight(pDetHeight);
                                        if (window.innerWidth < 700) {
                                                $('#look-slide .owl-pagination').css('bottom', pageBottom2 + 'px');
                                        } else {
                                                $('#look-slide .owl-pagination').css('bottom', pageBottom + 'px');
                                        }

                                        $('.screen-2 .col-right').removeClass('loading');
                                        $('.col-green .hide, .col-green .place-details, .col-green .tick-item, .col-green .owl-controls').css('opacity', 1);
                                }, 700);
                        });

                }, 1200);


        });

        // Select Place / Look Functions
        /*
        var $selectedPlace,
                $Gender


        function gotoPage(number) {


                if ($('body').hasClass('portrait')) {
                        var axis = 'X';
                } else {
                        var axis = 'Y';
                }

                history.pushState(null, null, "#screen-" + number);

                var currentPage = $('body').find('.active-page').attr('id');
                var CrpageT = currentPage.substr(currentPage.length - 1);
                if (CrpageT > number) {
                        $('#' + currentPage).css({
                                'transform': 'translate' + axis + '(100%)',
                                '-webkit-transform': 'translate' + axis + '(100%)',
                                '-ms-transform': 'translate' + axis + '(100%)',
                                '-moz-transform': 'translate' + axis + '(100%)'
                        });
                        $('#screen-' + number).css({
                                'transform': 'translate' + axis + '(0)',
                                '-webkit-transform': 'translate' + axis + '(0)',
                                '-ms-transform': 'translate' + axis + '(0)',
                                '-moz-transform': 'translate' + axis + '(0)'
                        });
                } else {
                        $('#' + currentPage).css({
                                'transform': 'translate' + axis + '(-100%)',
                                '-webkit-transform': 'translate' + axis + '(-100%)',
                                '-ms-transform': 'translate' + axis + '(-100%)',
                                '-moz-transform': 'translate' + axis + '(-100%)'
                        });
                        $('#screen-' + number).css({
                                'transform': 'translate' + axis + '(0)',
                                '-webkit-transform': 'translate' + axis + '(0)',
                                '-ms-transform': 'translate' + axis + '(0)',
                                '-moz-transform': 'translate' + axis + '(0)'
                        });
                }


                $('.section').removeClass('active-page');
                $('#screen-' + number).addClass('active-page');
        } */

        window.addEventListener('popstate', function(event) {
                var locationPop = window.location.hash.substr(1);
                var pageT = locationPop.substr(locationPop.length - 1);
                if (locationPop) {
                        gotoPage(pageT);
                } else {
                        gotoPage(1);
                }

        });
        function getDetailPanelElevations() {
          if(window.innerWidth >= 800){
            return [1,1];
          }else if(window.innerWidth >= 700){
            return [0,1];
          }
          return [0,0];
        }
        function loadLook(location, first) {

                $('.screen-2 .col-right').addClass('loading');

                if (first) {
                        $("#look-slide").owlCarousel({
                                jsonPath: T_PATH + 'json/food.html',
                                jsonSuccess: customLookSuccess,
                                singleItem: true,
                                lazyLoad: true,
                                lazyFollow: true,
                                navigation: true,
                                addClassActive: true,
                                slideSpeed: 500,
                                paginationSpeed: 500
                        });
                } else {
                        $("#look-slide").removeAttr('style');
                        $("#look-slide").empty();
                        $("#look-slide").data('owlCarousel').reinit({
                                jsonPath: T_PATH + 'json/food.html',
                                jsonSuccess: customLookSuccess,
                                singleItem: true,
                                lazyLoad: true,
                                lazyFollow: true,
                                navigation: true,
                                addClassActive: true,
                                slideSpeed: 500,
                                paginationSpeed: 500
                        });

                }
                
                function customLookSuccess(data) {
                        var content = "";
                        for (var i in data["items"]) {

                                var img = data["items"][i].img;
                                var alt = data["items"][i].alt;
                                var placeTitle = data["items"][i].title;
                                var placeDetail = data["items"][i].details;
                                var tooltips = "";
                                for (var g in data["items"][i].tooltips) {
                                        var tipTitle = data["items"][i].tooltips[g].tipTitle;
                                        var tipDet = data["items"][i].tooltips[g].tipContent;
                                        var tipClass = data["items"][i].tooltips[g].tipClass;
                                        var posTop = data["items"][i].tooltips[g].PositionTop;
                                        var posLeft = data["items"][i].tooltips[g].PositionLeft;

                                        tooltips += "<div class='" + tipClass + "' style='top:" + posTop + ";left:" + posLeft + ";'><div class='t-wrap'><span></span><div class='t-content'><h5>" + tipTitle + "</h5><p>" + tipDet + "</p></div></div></div>"
                                }
                                content += "<div class=\"item\"><div data-src=\"" + img + "\" class=\"bg-image lazyOwl\"></div><div class=\"place-details\"><h5>" + placeTitle + "</h5><p>" + placeDetail + "</p></div>" + tooltips + "<a href=\"#\" class=\"tick-item\">tick to select</a></div>"
                        }
                        $("#look-slide").html(content).promise().done(function() {

                                setTimeout(function() {
                                        $('#look-slide .owl-pagination').each(function() {
                                                var trackW = $(this).width();
                                                var pages = $(this).children().length - 1;
                                                var percen = 100 / pages;
                                                if (window.innerWidth < 700) {
                                                        var lnt = pages * 12.1;
                                                } else {
                                                        var lnt = pages * 16.1;
                                                }
                                                var rckL = (trackW - lnt) / pages;
                                                $(this).children().each(function(index, val) {
                                                        $(this).css({
                                                                marginLeft: (percen * index) + '%'
                                                        });
                                                });
                                                $(this).children().first().css({
                                                        marginLeft: 0
                                                });
                                                setTimeout(function() {

                                                        var pDetHeight = -Infinity;
                                                        $('#look-slide .place-details').each(function() {
                                                                pDetHeight = Math.max(pDetHeight, parseFloat($(this).outerHeight()));
                                                        });

                                                        var elevationDueToNextButton = (getDetailPanelElevations()[1]*62);
                                                        var pageBottom = pDetHeight + 35 + elevationDueToNextButton
                                                        var pageBottom2 = pDetHeight + 17 + elevationDueToNextButton; // init/right

                                                        $('#look-slide .tick-item').outerHeight(pDetHeight);
                                                        $('#look-slide .place-details').outerHeight(pDetHeight);
                                                        if (window.innerWidth < 700) {
                                                                $('#look-slide .owl-pagination').css('bottom', pageBottom2 + 'px');
                                                        } else {
                                                                $('#look-slide .owl-pagination').css('bottom', pageBottom + 'px');
                                                        }

                                                        $('.screen-2 .col-right').removeClass('loading');
                                                        $('.col-green .hide, .col-green .place-details, .col-green .tick-item, .col-green .owl-controls').css('opacity', 1);
                                                }, 700);
                                        });
                                }, 500);
                        });
                }
        }
        function shiftUnslide2() {
          $('.screen-2 .col-left, .screen-2 .col-right').addClass('trans');
          $('.screen-2 .col-left').css({
                  'transform': 'translateX(0%)',
                  '-webkit-transform': 'translateX(0%)',
                  '-ms-transform': 'translateX(0%)',
                  '-moz-transform': 'translateX(0%)'
          });
          $('.screen-2 .col-right').css({
                  'transform': 'translateX(100%)',
                  '-webkit-transform': 'translateX(100%)',
                  '-ms-transform': 'translateX(100%)',
                  '-moz-transform': 'translateX(100%)'
          });
        }
        function shiftSlide2 () {
          $('.screen-2 .col-left, .screen-2 .col-right').addClass('trans');
          $('.screen-2 .col-left').css({
                  'transform': 'translateX(-100%)',
                  '-webkit-transform': 'translateX(-100%)',
                  '-ms-transform': 'translateX(-100%)',
                  '-moz-transform': 'translateX(-100%)'
          });
          $('.screen-2 .col-right').css({
                  'transform': 'translateX(0%)',
                  '-webkit-transform': 'translateX(0%)',
                  '-ms-transform': 'translateX(0%)',
                  '-moz-transform': 'translateX(0%)'
          });
        }
        function onCompletedChoicesButtonPressed() {
          /*
           * This could either be the step 2 'next' button', or the 'next' button
           * depending on whether the user is looking at the mobile or non-mobile
           * view. This function defines what happens when the user does the 
           * relevant action
           */
          var selectedDestinationIndex    = $("#places-slide .checked").parent().parent().index();
          var selectedLookIndex           = $("#look-slide .checked").parent().parent().index();
          //
          var destinationNotChosen        = selectedDestinationIndex < 0;
          var lookNotChosen               = selectedLookIndex < 0;
          //
          if(destinationNotChosen || lookNotChosen){
            // User did not choose either a look, or destination
            bounceNextButton(destinationNotChosen, lookNotChosen);
          }else{
            // User chose a look and destination
            prepareThirdSlide();
            gotoPage(3);
          }
        }
        function prepareThirdSlide() {
		
          var selectedDestinationIndex    = $("#places-slide .checked").parent().parent().index();
          var selectedLookIndex           = $("#look-slide .checked").parent().parent().index();
          //
          var selectedDestinationName     = $("#places-slide .checked").parent().find('h5').text().toLowerCase().replace(/ /g, "-");
          var selectedLookName            = $("#look-slide .checked").parent().find('h5').text().toLowerCase().replace(/ /g, "-");
          //
          var selectedDestinationTitle    = $("#places-slide .checked").parent().find('h5').text();
          var selectedLookTitle           = $("#look-slide .checked").parent().find('h5').text();
          //
          var selectedDestinationCSS      = $("#places-slide .checked").parent().find('.lazyOwl').attr('style');
          var selectedLookCSS             = $("#look-slide .checked").parent().find('.lazyOwl').attr('style');
          //
          var resultImageRelPath = '';
          var resultIdentifierName='';
          $('#resLoc').val(selectedDestinationCSS);
          $('#resLoook').val(selectedLookCSS);
          //
          $('.screen-3').find('.result-location-image') .attr('style', $('#resLoc').val());
          $('.screen-3').find('.result-look-image')     .attr('style', $('#resLoook').val());
          //
          
          //
          $('#selected-food').val(selectedLookName);
          $('#result-look').text(selectedLookTitle);
          
          $('#selected-place').val(selectedDestinationName);
          $('#result-locaion').text(selectedDestinationTitle);
          /*  
           *  Un-check the checked tick-boxes, because if the user got to this
           *  point, the only thing they can do is return to the first step of
           *  slide 2
           */
          $("#places-slide .checked").removeClass("checked");
          $("#look-slide .checked").removeClass("checked");
        
        }
        function bounceNextButton(bounceLeft, bounceRight) {
          
          if(bounceLeft){
            jQuery("#places-slide .tick-item").fadeIn(100)
              .animate({bottom:"+=30px"},100)
              .animate({bottom:"-=30px"},100)
              .animate({bottom:"+=15px"},100)
              .animate({bottom:"-=15px"},100)
              .animate({bottom:"+=5px"},100)
              .animate({bottom:"-=5px"},100,
              "swing",function(){jQuery("#places-slide .tick-item").data("bouncing", false);});
            }
            if(bounceRight){
              jQuery("#look-slide .tick-item").fadeIn(100)
              .animate({bottom:"+=30px"},100)
              .animate({bottom:"-=30px"},100)
              .animate({bottom:"+=15px"},100)
              .animate({bottom:"-=15px"},100)
              .animate({bottom:"+=5px"},100)
              .animate({bottom:"-=5px"},100,
              "swing",function(){jQuery("#look-slide .tick-item").data("bouncing", false);});
            }
        }
        function loadPlaces() {
                           
                var email     = $('#hidden-email').val();
                var firstname = $('#first_name').val();
                var lastname  = $('#last_name').val();               
                 $.get('https://e.hotelclub.com/pub/rf', {
                                    _ri_: "X0Gzc2X%3DWQpglLjHJlYQGmCEwhd0zeBi8EEu7zf5DzdYzezfegR92VwjpnpgHlpgneHmgJoXX0Gzc2X%3DWQpglLjHJlYQGn74W0kzgzbcYl5Bmc24oOzeAy6CCFu",
                                    EMAIL_ADDRESS_: email,
                                    FIRST_NAME: firstname,
                                    LAST_NAME: lastname,
                                    COUNTRY_: 'Australia',
                                    EMAIL_ACQUISITION_SOURCE: "ML",
                                    MARKET_CODE: "AU",
                                    LANG_LOCALE: "en_AU",
                                    LANGUAGE_ISO2: "EN",
                                  },
                 function(data) {} );   

                

                gotoPage(2);

                $('.screen-3, .screen-4').addClass('trans');
                if ($windowW < 1400) {
                        $('.logo img').css('width', '320px');
                }
                $('.screen-2 .col-left').addClass('loading');
                $('.screen-2 .col-right').addClass('loading').delay(900).promise().done(function() {


                        /* Load Places Slider */
                        $("#places-slide").owlCarousel({
                                jsonPath: T_PATH + 'json/placesData.html',
                                jsonSuccess: customPlaceSuccess,
                                singleItem: true,
                                lazyLoad: true,
                                lazyFollow: true,
                                navigation: true,
                                slideSpeed: 500,
                                addClassActive: true,
                                paginationSpeed: 500
                        });


                        function customPlaceSuccess(data) {
                                var content = "";
                                for (var i in data["items"]) {

                                        var img = data["items"][i].img;
                                        var alt = data["items"][i].alt;
                                        var placeTitle = data["items"][i].title;
                                        var placeDetail = data["items"][i].details;

                                        content += "<div class=\"item\"><div data-src=\"" + img + "\" class=\"bg-image lazyOwl\"></div><div class=\"place-details\"><h5>" + placeTitle + "</h5><p>" + placeDetail + "</p></div><a href=\"#\" class=\"tick-item\">tick to select</a></div>"
                                }
                                $("#places-slide").html(content).promise().done(function() {
                                        loadLook($('#selected-place').val(), true);

                                        setTimeout(function() {
                                                $('#places-slide .owl-pagination').each(function() {
                                                        var trackW = $(this).width();
                                                        var pages = $(this).children().length - 1;

                                                        var percen = 100 / pages;

                                                        if (window.innerWidth < 700) {
                                                                var lnt = pages * 12.1;
                                                        } else {
                                                                var lnt = pages * 16.1;
                                                        }
                                                        var rckL = (trackW - lnt) / pages;
                                                        $(this).children().each(function(index, val) {
                                                                $(this).css({
                                                                        marginLeft: (percen * index) + '%'
                                                                });
                                                        });
                                                        $(this).children().first().css({
                                                                marginLeft: 0
                                                        });
                                                        setTimeout(function() {

                                                                var pDetHeight = -Infinity;
                                                                $('#places-slide .place-details').each(function() {
                                                                        pDetHeight = Math.max(pDetHeight, parseFloat($(this).outerHeight()));
                                                                });

                                                                var elevationDueToNextButton = (getDetailPanelElevations()[0]*62);
                                                                var pageBottom = pDetHeight + 35 + elevationDueToNextButton
                                                                var pageBottom2 = pDetHeight + 17 + elevationDueToNextButton; // init/left

                                                                $('#places-slide .tick-item').outerHeight(pDetHeight);
                                                                $('#places-slide .place-details').outerHeight(pDetHeight);
                                                                if (window.innerWidth < 700) {
                                                                        $('#places-slide .owl-pagination').css('bottom', pageBottom2 + 'px');
                                                                } else {
                                                                        $('#places-slide .owl-pagination').css('bottom', pageBottom + 'px');
                                                                }
                                                                $('.screen-2 .col-left').removeClass('loading');
                                                                $('.col-red .hide, .col-red .place-details, .col-red .tick-item, .col-red .owl-controls, .step2nextbtn').css('opacity', 1);
                                                        }, 500);
                                                });
                                        }, 500);


                                });
                        }
                        $(".step2nextbtn").click(function(){
                          if (window.innerWidth < 700) { 
                            shiftUnslide2();
                          }
                          onCompletedChoicesButtonPressed(); 
                        })
                        $(document).on("click", '#places-slide .tick-item', function(event) {
                          event.preventDefault();
                          var isChecked = $(this).hasClass('checked');
                          if(!isChecked){
                            $("#places-slide .checked").removeClass('checked');
                            $(this).addClass('checked');
                            if (window.innerWidth < 700) { shiftSlide2(); }
                          }else{
                            $(this).removeClass("checked");
                          }
                        });
                        $(document).on("click", '#look-slide .tick-item', function(event) {
                          event.preventDefault();
                          var isChecked = $(this).hasClass('checked');
                          if(!isChecked){
                            $("#look-slide .checked").removeClass('checked');
                            $(this).addClass('checked');
                            if (window.innerWidth < 700) { 
                              onCompletedChoicesButtonPressed(); 
                              shiftUnslide2();
                            }
                          }else{
                            $(this).removeClass("checked");
                          }
                        });
                        $(document).on("click", '.tip span', function(event) {
                          $(this).parent().parent().toggleClass('pop');
                        });
                });

        
          
 
           

        }


        if ($('.screen-4').hasClass('active-page')) {
                $('.logo').fadeOut();
        }

        function validate_email(email_value) {
            var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email_value);
        }

         var page_height = window.innerHeight;

        // Click Event
        $('.form-btn').click(function(e) {
                e.preventDefault();

                $('#email-textbox').removeClass('error-textbox');
            
                $('#error-email-message').hide();
                
            
                var emailValid = false;
             
                if ($('#email-textbox').val() == '') {
                        $('#email-textbox').addClass('error-textbox');
                } else if (!validate_email($('#email-textbox').val())) {
                        $('#email-textbox').addClass('error-textbox');
                        $('#error-email-message').show();
                } else {
                        $('#hidden-email').val($('#email-textbox').val());
                        emailValid = true;
                }
               
                if(emailValid){

                   $("#textField").blur();
                    setTimeout(function() {
                        window.scrollTo(document.body.scrollLeft, document.body.scrollTop);
                    }, 20);
                    loadPlaces();
                  
                }
        }); // Click Event



}());

function only_letters(event) {
  var key = event.keyCode;
  var isLetter = ((key >= 65 && key <= 90) || key == 8 || key == 9);
  if(isLetter){
    return;
  }else{
    event.preventDefault();
  }
};
function only_numbers(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
                // Allow: Ctrl+A
                (event.keyCode == 65 && event.ctrlKey === true) ||
                // Allow: home, end, left, right
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
        } else {
                // Ensure that it is a number and stop the keypress
                if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105)) {
                        event.preventDefault();
                }
        }
}

var $selectedPlace;


function gotoPage(number) {


        if ($('body').hasClass('portrait')) {
                var axis = 'X';
        } else {
                var axis = 'Y';
        }

        history.pushState(null, null, "#screen-" + number);


        var currentPage = $('body').find('.active-page').attr('id');
        var CrpageT = currentPage.substr(currentPage.length - 1);
        if (CrpageT > number) {
                $('#' + currentPage).css({
                        'transform': 'translate' + axis + '(100%)',
                        '-webkit-transform': 'translate' + axis + '(100%)',
                        '-ms-transform': 'translate' + axis + '(100%)',
                        '-moz-transform': 'translate' + axis + '(100%)'
                });
                $('#screen-' + number).css({
                        'transform': 'translate' + axis + '(0)',
                        '-webkit-transform': 'translate' + axis + '(0)',
                        '-ms-transform': 'translate' + axis + '(0)',
                        '-moz-transform': 'translate' + axis + '(0)'
                });
        } else {
                $('#' + currentPage).css({
                        'transform': 'translate' + axis + '(-100%)',
                        '-webkit-transform': 'translate' + axis + '(-100%)',
                        '-ms-transform': 'translate' + axis + '(-100%)',
                        '-moz-transform': 'translate' + axis + '(-100%)'
                });
                $('#screen-' + number).css({
                        'transform': 'translate' + axis + '(0)',
                        '-webkit-transform': 'translate' + axis + '(0)',
                        '-ms-transform': 'translate' + axis + '(0)',
                        '-moz-transform': 'translate' + axis + '(0)'
                });
        }


        $('.section').removeClass('active-page');
        $('#screen-' + number).addClass('active-page');
}

$(function() {
        $("#first_name, #last_name, #suburb").keydown(function(event) {
                only_letters(event);
        });
        $.validator.addMethod("wordlimit", function(value, element) {

                if (!value)
                        return true;
                value = $.trim(value);
                var minLength = 25;
                if (value.split(/\s+/).length <= minLength) {
                        return true;
                }
                return false;
        }, "Please enter only 25 words.");
            $("#hotel_club_form").validate({
                errorClass: 'error_message',
                validClass: '',
                rules: {
                        first_name: {
                                required: true,
                                minlength: 2,
                                maxlength: 15
                        },
                        last_name: {
                                required: true,
                                minlength: 2,
                                maxlength: 15
                        },
                        suburb: {
                                required: true,
                        },
                        state: {
                                required: true,
                        },
                        answer: {
                                required: true,
                                wordlimit: true
                        }
                       
                },
                submitHandler: function(form) {
                        $('#hidden-selected-place').val($('#result-locaion').text());
                        $('#hidden-selected-food').val($('#result-look').text());
                        
                        $.ajax({
                           ///added php mailer as asp mailer is not working on server
                          url: "mixandmatch",
                          type: "POST",
                          data: $(form).serialize() + '&isMail=true',
                          complete: function(response) {
                            //for callimg third party script
                            var email     = $('#hidden-email').val();
                            var firstname = $('#first_name').val();
                            var lastname  = $('#last_name').val();
                            var suburb  = $('#suburb').val();
                            var state  = $('#state').val();
                             
                            $.get('https://e.hotelclub.com/pub/rf', {
                                _ri_: "X0Gzc2X%3DWQpglLjHJlYQGmCEwhd0zeBi8EEu7zf5DzdYzezfegR92VwjpnpgHlpgneHmgJoXX0Gzc2X%3DWQpglLjHJlYQGn74W0kzgzbcYl5Bmc24oOzeAy6CCFu",
                                EMAIL_ADDRESS_: email,
                                FIRST_NAME: firstname,
                                LAST_NAME: lastname,
                                COUNTRY_: 'Australia',
                                EMAIL_ACQUISITION_SOURCE: "ML",
                                MARKET_CODE: "AU",
                                LANG_LOCALE: "en_AU",
                                LANGUAGE_ISO2: "EN",
                                STATE_: state,
                                CITY_: suburb
                              },
                               function(data) {} );
                              /*
                           //added data to database
                            $.ajax({
                                url: "add_database.php",
                                type: "POST",
                                data: $(form).serialize(),
                              });
                      //end
                      */
                            //slide to 4th screen
                            $('.logo').fadeOut();
                            gotoPage(4);
                            return false;
                          }
                        })

                }
        });
});