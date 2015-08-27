(function( $, HB ) {

    var resetCounterValue = 0,
        memberPrice = 0,
        manualState = true;

    /* IE 9 and below workarounds
     */
    if(!Object.addEventListener){
        Object.addEventListener = (function(){
           return Object.attachEvent();
        });
    }
    if (!Object.keys) {
        Object.keys = (function () {
            var hasOwnProperty = Object.prototype.hasOwnProperty,
                hasDontEnumBug = !({toString: null}).propertyIsEnumerable('toString'),
                dontEnums = [
                    'toString',
                    'toLocaleString',
                    'valueOf',
                    'hasOwnProperty',
                    'isPrototypeOf',
                    'propertyIsEnumerable',
                    'constructor'
                ],
                dontEnumsLength = dontEnums.length;

            return function (obj) {
                if (typeof obj !== 'object' && typeof obj !== 'function' || obj === null) throw new TypeError('Object.keys called on non-object');

                var result = [];

                for (var prop in obj) {
                    if (hasOwnProperty.call(obj, prop)) result.push(prop);
                }

                if (hasDontEnumBug) {
                    for (var i=0; i < dontEnumsLength; i++) {
                        if (hasOwnProperty.call(obj, dontEnums[i])) result.push(dontEnums[i]);
                    }
                }
                return result;
            }
        })()
    }
    /* End IE 9 and below work arounds */
    HB.registerHelper('displayPrice', function(onegId, currObj, MemberPrice) {
 

        if (typeof currObj['data'] !== 'undefined' && currObj['data'].hasOwnProperty([onegId])) {

            var price = currObj['data'][onegId][0],
                memB = parseInt(memberPrice),
                symbol = currObj['symbol'];

            if (! isNaN(memB) ) {

                var total = price - parseFloat(memberPrice);

                if (total < 0)
                    return 0;
                else
                    return symbol + Math.round(price - parseFloat(memberPrice));
            } else
                return symbol + Math.round(price);

        } else {
            return 'N/A';
        }

    }),

    HB.registerHelper('chString', function(val, options) {

        // console.log(val);

        var AllowLen = 140;
        string = '',
            total = '';

        for(var i=0; i < val.length; i++) {

            var len = val[i].length;

            if (val[i].length == 0)
                continue;

            total = Math.ceil( len / 20 ) * 20;

            if (resetCounterValue >= AllowLen ) {
                return '';
            }

            var totalCount = resetCounterValue = total + resetCounterValue;

            if (totalCount >= AllowLen) {

                var ch = totalCount - AllowLen,
                    chChar = 20 - ch;

                if (chChar > 0)
                    string += new Handlebars.SafeString('<li>' + val[i].substring(0, chChar) + '.. </li>');

            } else {

                string += new Handlebars.SafeString('<li>' + val[i] + '</li>');

            }
        }
        return string;
    });

    HB.registerHelper('isMemberExclusive', function(promotion, logged, options) {

        if (promotion.length > 1 && logged == true) {
            return options.fn(this);
        }
    });

    HB.registerHelper('displayExclusiveBanner', function(promotion, logged, options) {

        if (promotion.length > 1 && logged == true) {
            return new Handlebars.SafeString('<div class="card-member">'+ Deals.t('member_exclusive_offer') + '</div>');
        } else if (promotion.length > 1 && logged == false) {
            return new Handlebars.SafeString('<div class="card-non-member">'+ Deals.t('member_exclusive_offer_available') + '</div>');
        }
    });

    HB.registerHelper('displayPromotions', function(promotion, logged, options) {

        //console.log(promotion)
        var TPValuesKey1 = new Array,//'<ul class="card-feat-list">',
            VAValuesKey1 = new Array, //' <ul class="card-normal-list">',
            TPValuesKey2 = new Array,
            VAValuesKey2 = new Array,
            promoLen = promotion.length,
            isDisplay = true,
            shortMarkTextKey1 = new Array,
            shortMarkTextKey2 = new Array,
            promo = JSON.parse(JSON.stringify(promotion));

        if (promoLen == 2 && logged == true) {
            var vkey = 0;
        } else {
            var vkey = 0;
        }

        for (var key in promo) {


            if (promo.hasOwnProperty(key)) {
                var obj = promo[key];

                for (var prop in obj) {
                    // important check that this is objects own property
                    // not from prototype prop inherited
                    if (obj.hasOwnProperty(prop)) {

                        if (typeof obj[prop] == 'object') {
                            //console.log(obj[prop]);
                            for (var ar in obj[prop]) {

                                if (key == 0) {

                                    if (prop == 'PO' || prop == 'DO' || prop == 'FN') {

                                        if ( undefined != obj["PO"] || null != obj["PO"] ) {

                                            shortMarkTextKey1.push(obj["PO"][Object.keys(obj["PO"])[0]]); // take out first line
                                            obj["PO"][Object.keys(obj["PO"])[0]] = null; // delete first line

                                        } else if (undefined !=  obj["FN"] || null !=  obj["FN"]) {

                                            shortMarkTextKey1.push(obj["FN"][Object.keys(obj["FN"])[0]]); // take out first line
                                            obj["FN"][Object.keys(obj["FN"])[0]] = null; // delete first line

                                        } else if (undefined !=  obj["DO"] || null !=  obj["DO"]) {

                                            shortMarkTextKey1.push(obj["DO"][Object.keys(obj["DO"])[0]]); // take out first line
                                            obj["DO"][Object.keys(obj["DO"])[0]] = null; // delete first line
                                        }

                                        if (obj[prop][ar] != null) {
                                            TPValuesKey1.push(obj[prop][ar]);
                                        }
                                    } else if (prop == 'VA') {
                                        VAValuesKey1.push(obj[prop][ar]);
                                    }

                                } else if (key == 1) {

                                    if (prop == 'PO' || prop == 'DO' || prop == 'FN') {

                                        if ( undefined != obj["PO"] || null != obj["PO"] ) {

                                            shortMarkTextKey2.push(obj["PO"][Object.keys(obj["PO"])[0]]); // take out first line
                                            obj["PO"][Object.keys(obj["PO"])[0]] = null; // delete first line

                                        } else if (undefined !=  obj["FN"] || null !=  obj["FN"]) {

                                            shortMarkTextKey2.push(obj["FN"][Object.keys(obj["FN"])[0]]); // take out first line
                                            obj["FN"][Object.keys(obj["FN"])[0]] = null; // delete first line

                                        } else if (undefined !=  obj["DO"] || null !=  obj["DO"]) {

                                            shortMarkTextKey2.push(obj["DO"][Object.keys(obj["DO"])[0]]); // take out first line
                                            obj["DO"][Object.keys(obj["DO"])[0]] = null; // delete first line
                                        }

                                        if (obj[prop][ar] != null) {
                                            TPValuesKey2.push(obj[prop][ar]);
                                            //console.log('prop =>' + prop + '=>' + vkey);
                                            // console.log(obj["PO"][Object.keys(obj["PO"])[0]]);
                                        }
                                    } else if (prop == 'VA') {
                                        VAValuesKey2.push(obj[prop][ar]);
                                    }
                                }
                            }
                        }
                    }
                }
            }

        }

        if (logged == true && promoLen == 2) {

            shortMarkTextKey2 = '<p class="hotel-offer">'+ Handlebars.helpers.chString(shortMarkTextKey2, '').replace('<li>', '').replace('</li>', '') + '</p>';
            TPValuesKey2 = '<ul class="card-feat-list">'+ Handlebars.helpers.chString(TPValuesKey2, '') +'</ul>';
            VAValuesKey2 = '<ul class="card-feat-list">'+ Handlebars.helpers.chString(VAValuesKey2, '') + '</ul>';
            var VAValuesKey1Var = '<ul class="card-normal-list">'+ Handlebars.helpers.chString(VAValuesKey1, '') +'</ul>';
            resetCounterValue = 0; //reset counter
            return new Handlebars.SafeString(shortMarkTextKey2 + TPValuesKey2 + VAValuesKey2 + VAValuesKey1Var);

        } else {

            shortMarkTextKey1 = '<p class="hotel-offer">'+ Handlebars.helpers.chString(shortMarkTextKey1, '').replace('<li>', '').replace('</li>', '') + '</p>';
            TPValuesKey1 = '<ul class="card-feat-list">'+ Handlebars.helpers.chString(TPValuesKey1, '') +'</ul>';
            VAValuesKey1 = '<ul class="card-normal-list">'+ Handlebars.helpers.chString(VAValuesKey1, '') +'</ul>';
            resetCounterValue = 0; //reset counter
            return new Handlebars.SafeString(shortMarkTextKey1 + TPValuesKey1 + VAValuesKey1);
        }
    });

    HB.registerHelper('resetCounter', function(val, options) {
        resetCounterValue = 0
    });

    HB.registerHelper('whenEqual', function(val1, val2, options) {
        if (val1 == val2) {
            return options.fn(this);
        }
    });

    HB.registerHelper('whenNotEqual', function(val1, val2, options) {
        if (val1 != val2) {
            return options.fn(this);
        }
    });

    HB.registerHelper('isTrue', function(val, options) {
        //console.log('hac' + val);
        if (val == true) {
            return options.fn(this);
        }
    });

    HB.registerHelper('destinationInfoPosition', function(key) {
        if (key % 2 === 0)
            return 'pull-left';
        else
            return 'pull-right';
    });

     HB.registerHelper('regionCardTopDestination', function(obj) {

         var html = '<ul>';
         for (var key in obj) {

             if (obj.hasOwnProperty(key)) {
                 html += '<li><a href="/'+MNME + '/' +obj[key].url+'">'+obj[key].title+'</a></li>';
             }

         }
         html += '</ul>';
         return new Handlebars.SafeString(html);

    });

     HB.registerHelper('regionCardTopHotels', function(obj) {

         var html = '<ul>';
         var baseUrl = "//www.hotelclub.com/shop/hotelsearch?type=hotel&locale=" + locale
             + "&hsv.showDetails=true"
             + "&hotel.type=keyword"
             + "&hotel.chkin="
             + "&hotel.chkout="
             + "&hotel.rooms[0].adlts=2"
             + "&search=Search";

         for (var key in obj) {

             if (obj.hasOwnProperty(key)) {
                 var hotelUrl = baseUrl + "&hotel.hid="+ obj[key].oneg
                 + "&hotel.hname="+obj[key].title
                 + "&hotel.keyword.key="+obj[key].city;

                 html += ' <li class="destination-card-child"><a href="' + hotelUrl +'" target="_blank">';
                 html += ' <div class="destination-card-img-holder">';
                 html += ' <div class="destination-card-img">';
                 html += ' <img src="'+obj[key].image+'" />';
                 html += ' </div>';
                 html += '  </div>';
                 html += '  <div class="destination-card-info">';
                 html += '  <p class="destination-card-title">'+obj[key].title+'</p>';
                 html += '  <div class="new-star-sprite-'+obj[key].starRating+'" style="float:left;"></div>';
                 html += ' <div class="destination-card-city">'+obj[key].city+'</div>';
                 html += '  <p class="destination-card-offer">'+obj[key].shortMarketingText+'</p>';
                 html += '  </div></a>';
                 html += '  </li>';
             }
         }
         html += '</ul>';
         return new Handlebars.SafeString(html);

    });

    HB.registerHelper('regionCardExploreDestination', function(obj) {

         var html = '<ul>';
         for (var key in obj) {

             if (obj.hasOwnProperty(key)) {
                 html += '<li><a class="region-explore-dest" data-value="'+key+'" title="Visit '+obj[key].title+'">'+obj[key].title+'</a></li>';
             }
         }
         html += '</ul>';
         return new Handlebars.SafeString(html);

    });

    HB.registerHelper('trimString', function(string, value) {

        if (string.length > value ) {
            var string = string.substring(0, value) + '..';
        }
        return new Handlebars.SafeString( string )
    });

    HB.registerHelper('displayLocaleDropDown',function(obj) {


        var html = '<ul class="locale-list">';
        for( key in obj) {
            if (obj.hasOwnProperty(key)) {

                html += '<li>';
                html += '<a data-locale="'+key+'">';
                html += '<div class="flag-pos">';
                html += '<img src="/n/themes/deals/images/assets/blank.gif" class="flag '+obj[key].class+'" alt="'+obj[key].name+'" /></div>';
                html += '<div class="flag-txt-pos">'+obj[key].name+'</div>';
                html += '</a>';
                html += '</li>';
            }

        }
        html += '</ul>';

        return new Handlebars.SafeString(html);
    });

    HB.registerHelper('displayDefaultLocale', function(obj, locale) {

        var html = '<a><span class="user-club-info">',
            l = obj[locale]

            html += '<img src="/n/themes/deals/images/assets/blank.gif" class="flag '+ l.class+'" alt="'+ l.name+'" />';
            html += '</span></a>';

        return new Handlebars.SafeString(html);

    });

    HB.registerHelper('displayCurrencyDropDown', function(obj) {


        var html = '<ul class="currencySelector selector multiColumn">';

        var firstColl = 3,
            secondColl = 2,
            thirdColl = 2,
            counter = 1,
            tempKey = '',
            footTag = false;

        for(key in obj) {

            if (obj.hasOwnProperty(key)) {


                for(k in obj[key]) {

                    if (obj.hasOwnProperty(key)) {

                       // closing tags div and ul
                        if (tempKey != key && footTag == true) {
                            footTag = false;
                            html += ' </ul>';
                            html += '</div>';


                            if (counter == 1) {
                                html += '</li>';
                               // console.log('1 closing => ' + counter);
                            } else if (counter == 4) {
                                html += '</li>';
                               // console.log('2 closing => ' + counter);
                            } else if (counter == 6) {
                                html += '</li>';
                                //console.log('3 closing => ' + counter);
                            }

                        }

                        if (tempKey != key) {
                            if (counter == 1) {
                                html += '<li class="currency-col">';
                                //console.log('1 => ' + counter);
                            } else if (counter == 4) {
                                html += '<li class="currency-col currency-col-space currency-col-divide">';
                               // console.log('2 => ' + counter);
                            } else if (counter == 6) {
                                html += '<li class="currency-col currency-col-space">';
                                //console.log('3 => ' + counter);
                            }

                            html += ' <div class="cur-section">';
                            html += '<h5 class="Countries">'+key+'</h5>';
                            html += '<ul>';
                            counter++;
                        }


                        html += ' <li data-component="currencySelectorItem">';
                        html += '<span class="current" title="'+obj[key][k]+'" data-curr="'+k+'"><span class="desc"> '+obj[key][k]+'</span></span>';
                        html += ' </li>';

                        tempKey = key;
                        footTag = true;

                        //console.log(obj[key][k]);
                        //console.log(k);



                    }
                }

            }
        }

        html += '</ul>';

        return new Handlebars.SafeString(html);

    });

    HB.registerHelper('displayDefaultCurrency', function(obj, curr) {

        for(key in obj) {
            if (obj.hasOwnProperty(key)) {
                for(k in obj[key]) {
                    if (k == curr) {
                        console.log(obj[key][curr].split('-')[0].trim());
                        var html = '<span class="user-club-info drop-down-arrow">' + obj[key][curr].split('-')[0].trim() + '</span>';
                        return new Handlebars.SafeString(html);
                    }
                }
            }
        }
    });

    HB.registerHelper('t', function(obj, value) {

        if (obj &&  typeof obj[value] !== 'undefined') {

            return new Handlebars.SafeString(obj[value]);
        }

        return new Handlebars.SafeString(value);
    });




    var Deals = {

        init : function() {

            this.city = city;

            this.region = '';

            this.when = when;

            this.cityNameUtf;

            this.setSeoData();

            this.setCityData();

            this.setDealData();

            this.setHomePageData();

            this.setHeroImages();

            this.setTranslation();

            this.cityImage = new Array();

            this.isLoggedIn = false;

            this.setSortBy(sBy);

            this.setSortType(sTy);

            this.setCurrencyDoc();

            $('.filter').hide();

            this.displayHeader();

            this.updatePromotion();


            var self = this;
            this.displayUserInfo().always(function(){

                self.initRoute();
                //this.displayOrbot();
                //this.displaySortBox(); //don't display in init..
                //this.displayFilter();
                //this.displayHotelCards();
                //self.displayRegionHotelCards();
                self.displayFooter();

                self.updateFooterText();
                //self.displayDropDownData('value');
                //self.setCityImage();
                //self.initURLUpdate();
                //self.hotelCardCtrl();

            });



 /*           $.get("https://www.hotelclub.com/account/login", null, function (data) {
                $('body').html(data);
                //alert(data);
            })*/
        },

        setDealData : function() {

            try {
                this.hData = $.parseJSON(hData);
            } catch (e ) {
                this.hData = false;
            }
        },

        setSeoData : function() {

            try {
                this.seoData = $.parseJSON(docSeo);
            } catch (e ) {
                this.seoData = false;
            }
        },

        setHomePageData : function() {

            try {
                this.hPageData = $.parseJSON(hPageData);
            } catch (e ) {
                this.hPageData = false;
            }
        },

        setHeroImages : function() {
            try {
                this.heroImages = $.parseJSON(hImages);
            } catch (e ) {
                this.heroImages = false
            }
        },

        setTranslation : function() {

            try {
                this.trans = $.parseJSON(t);
            } catch (e ) {
                this.trans = false;
            }

        },

        setCurrencyDoc : function() {

            try {
                this.currDoc = $.parseJSON( currD );
            } catch (e ) {
                this.currDoc = false
            }
        },

        // get translation by key
        t : function( key ) {

            if (this.trans[key] !== undefined) {
                return this.trans[key];
            }
            return key;

        },

        setCurrData : function(data) {
            this.currDoc = data;
        },

        getDataById : function(onegId) {

            if ( $.isEmptyObject(this.currDoc) && typeof this.currDoc[onegId] == 'undefined') {
                return {
                    currency : '',
                    'symbol' : '',
                    'price' : 'N/A'
                }
            } else {
                return this.currDoc[onegId];
            }
        },


        setSortBy : function(sBy) {
            this.sortBy = sBy
        },

        setSortType : function(sTy) {
            this.sortType = sTy
        },

        setMemberBalance : function(price) {
            this.memberBalance = price;
        },

        getMemberBalance : function() {
            return this.memberBalance;
        },

        setCity : function(city) {
           this.city = city
        },

        setRegion : function(region) {
            this.region = region
        },

        setWhen : function(when) {
            this.when = when;
        },

        setHData : function(data) {
            this.hData = data;
        },

        initURLUpdate : function () {

            if (apnd != '') {
                var host = window.location.protocol +'//'+ window.location.hostname,
                    curl = host + '/' + MNME,
                    url = '';

                if (curl[curl.length -1] !== undefined && curl[curl.length -1] == '/') {
                    url = curl + apnd;
                } else {
                    url = curl + '/' + apnd;
                }
                manualState = false;
                History.pushState({url: url}, ' Hotels', url);
            }
        },

        initRoute : function() {


          if ($.isEmptyObject(this.hData) == true) {

              this.setMetadata('home');

              if (noHData == 'true') {
                  this.displayDropDownData('value');
                  this.setCityImage();
                  this.updatePromotion();
                  this.displayNoHotelOrbot();
              } else {
                  this.setHeroesImage(); // set heroes image
                  //root to landing page
                  this.displayDropDownData('default');
                  this.displayRegionHotelCards();
              }
          } else {

              this.setMetadata('destination');
              // root to second page
              this.displayDropDownData('value');
              this.setCityImage();
              this.updatePromotion();
              $('#breadcrumb-city').html(city); // Set breadcrumb
              this.hotelCardCtrl();

          }
        },

        setMetadata : function(type) {

            try {
                var dest = '';
                if (this.city != '') {
                    dest = this.seoData[type]['description'].replace('[Destination]', this.city);
                } else {
                    dest = this.seoData[type]['description'];
                }

                document.title = this.seoData[type]['title'];
                $('meta[name="description"]').attr('content', dest);
                $('meta[name="robots"]').attr('content', this.seoData[type]['robot']);

            } catch(e) {
                console.log('meta type is unknown');
            }
        },

        reLoadLandingPage: function() {

            $('.section .container #sort-row-uq').html('');
            $('.section .hotel-cards-container').html('');
            this.setDropDownDefaultOption().dropRegion();
            this.setDropDownDefaultOption().dropCities().attr('disabled','disabled');
            this.setDropDownDefaultOption().dropWhereDo().attr('disabled','disabled');
            $('.search-sale-box').show();
        },

        doRequest : function(obj) {
            return $.ajax({
                type : 'POST',
                dataType : 'json',
                url : obj.url,
                async : false,
                data : obj.data
            });
        },

        route : function(obj, ctrl) {

            if (typeof this[ctrl] == 'function') {

                if(typeof obj == 'object') {

                    var host = window.location.protocol +'//'+ window.location.hostname,
                        url = host + '/' + MNME + '/' + obj.city + '/' + obj.when;

                    if (getParameterByName('curr') != '') {
                        url += '/?curr=' + getParameterByName('curr');
                    }

                    if ( url !== window.location.href ) {
                        manualState = false
                        var c ='';

                        console.log(url);
                        History.pushState({url: url}, obj.city + ' Hotels', url);


                    }
                }
                this[ctrl](obj);
            } else {
                console.log('Controller not found!!');
            }
        },

        defaultCtrl : function(render) {

            this.setHeroesImage(); // set heroes image
            this.displayDropDownData('default');
            $('.promotion-box').hide();
            $('.hotelcards').remove();
            $('.err-hotel-not-found').remove();
            $('.orbot-in-page').remove();

            if (render === true) {
                this.displayRegionHotelCards();
            } else {
                $('.region-hotel-card-box').show();
            }

        },

        hotelCardCtrl : function(obj) {

            $('.region-hotel-card-box').hide();

            if ($('.promotion-box').length == 0) {
                this.updatePromotion();
            } else {
                $('.promotion-box').show();
            }
            //set city image
            this.setCityImage();

            if (typeof obj == 'object') {

                this.city = obj.city,
                this.cname = obj.region,
                this.when = obj.when;
                obj['cname'] = cName;

                var data = this.doRequest( {url:window.location.origin + '/' + MNME + '/', data: $.param(obj) } );

                if ($.isEmptyObject(data.responseJSON['hData']) === false) {

                    this.displaySortBox();
                    this.setHData(data.responseJSON['hData']);
                    //this.setCurrData(data.responseJSON['currData']);
                    this.currDoc = data.responseJSON['currData'];

                    //this.displayHotelCards({hData: this.hData, isLoggedIn: this.isLoggedIn});
                    // Display hotels using sort our picks in descending order, ie deals with highest score (sortOrder) on top
                    //Deals.sortByNumber('sortOrder', 'des');

                    if (this.sortBy == 'ourPicks') {
                        Deals.sortByNumber('sortOrder', 'des');
                    } else if (this.sortBy == 'price') {
                        Deals.sortByNumber('price', this.sortType);
                    } else if (this.sortBy == 'name') {
                        Deals.sortByText('hotelNameUtf8', this.sortType);
                    } else if (this.sortBy == 'rating') {
                        Deals.sortByNumber('starRatingiu', this.sortType);
                    }

                    var desIcon = ' &or;',
                        ascIcon = ' &and;',
                        typeIcon = this.sortType == 'asc' ? ascIcon : desIcon;
                    $('.sort-button').css({'font-weight': 'normal','color':'#a1a1a1'});

                    if (this.sortBy != 'ourPicks')
                        $('a[data-sort="'+this.sortBy+'"]').append($('<span class="sort-indicator-image">' + typeIcon + '</span>'))
                            .attr('data-order', this.sortType );

                    $('a[data-sort="'+this.sortBy+'"]').css({'font-weight': 'bold','color':'#333'});

                    if (obj.dropDownRefresh === true)
                        this.displayDropDownData('value');
                } else {
                    this.displayNoHotelOrbot();
                }

            } else {

                if ($.isEmptyObject(this.hData) === false) {

                     this.displaySortBox();

                     if (this.sortBy == 'ourPicks') {
                        Deals.sortByNumber('sortOrder', 'des');
                     } else if (this.sortBy == 'price') {
                        Deals.sortByNumber('price', this.sortType);
                     } else if (this.sortBy == 'name') {
                        Deals.sortByText('hotelNameUtf8', this.sortType);
                     } else if (this.sortBy == 'rating') {
                        Deals.sortByNumber('starRatingiu', this.sortType);
                     }

                    var desIcon = ' &or;',
                        ascIcon = ' &and;',
                        typeIcon = this.sortType == 'asc' ? ascIcon : desIcon;
                    $('.sort-button').css({'font-weight': 'normal','color':'#a1a1a1'});

                    if (this.sortBy != 'ourPicks')
                        $('a[data-sort="'+this.sortBy+'"]').append($('<span class="sort-indicator-image">' + typeIcon + '</span>'))
                            .attr('data-order', this.sortType );

                    $('a[data-sort="'+this.sortBy+'"]').css({'font-weight': 'bold','color':'#333'});
                    //this.displayHotelCards({hData: this.hData, isLoggedIn: this.isLoggedIn, memBalance : memberPrice});
                } else {
                    this.displayNoHotelOrbot();
                }
            }

        },

        setHeroesImage : function () {
            if ($.isEmptyObject(this.heroImages) == false){
                var heroImageCount = this.heroImages.length;
                var index = Math.floor((Math.random() * heroImageCount));
                if (typeof this.heroImages[index]['image'] == 'string') {
                    $('.hero').css('background-image', 'url("/' + this.heroImages[index]['image'] + '")');
                }
            }
        },

        displayNoHotelOrbot : function() {
            $('#sort-row-uq').html(''); // remove all content in sort box
            var template = HB.compile( $("#orbot-template").html() );

            $('.section .hotel-cards-container').html('').append(
                $('<div class="err-hotel-not-found">Sorry! No deals match your selection right now. Search all of our inventory here</div>') )
                .append(template( {city : this.city, trans : this.trans} ));

            $('.modal-wrapper').addClass ('orbot-in-page');
            $('.modal-box').removeClass('modal-box');
            $('.modal-row-button').addClass('no-hotel-orbot');
            $('.cancel-action').remove();

            var dateToday = new Date();
            var checkRates = "Check Rates";
            $("#check-in").datepicker({
                inline : true,
                minDate : 0,
                showCurrentAtPos : 0,
                dateFormat: dFormat,
                firstDay : 0,
				altField: "#alt-check-in",
				altFormat: "D,d M yy",
                dayNamesMin : [ Deals.t('sunday'), Deals.t('monday'), Deals.t('tuesday'), Deals.t('wednesday'), Deals.t('thursday'), Deals.t('friday'), Deals.t('saturday') ],
				monthNames: [Deals.t('january'), Deals.t('february'), Deals.t('march'), Deals.t('april'), Deals.t('may'), Deals.t('june'), Deals.t('july'), Deals.t('august'), Deals.t('september'), Deals.t('october'), Deals.t('november'), Deals.t('december')],
                onSelect : function(dateText, inst) {
                    var date2 = $('#check-in').datepicker('getDate');
                    date2.setDate(date2.getDate() + 1);
                    $('#check-out').datepicker('setDate', date2);
                    $('#check-out').datepicker('option', 'minDate', date2);
                }
            });//initialize the date-picker for check-in
            $("#check-out").datepicker({
                inline : true,
                minDate : 0,
                showCurrentAtPos : 0,
                dateFormat: dFormat,
				altField: "#alt-check-out",
				altFormat: "D,d M yy",
                onSelect : function(dateText, inst) {
                    $('#check-in').datepicker("option", "maxDate",
                        $('#check-out').val()
                    );
                }
            });//initialize the date-picker for check-out

        },

        updatePromotion : function() {

            try {
               var club = $.parseJSON(clubPromo),
                   pm = $.parseJSON(pmPromo);
                $('.promotion-box').show();
                $('.promo-one-title').html(club.title);
                $('.promo-one-body').html(club.text);
                $('.promo-two-title').html(pm.title);
                $('.promo-two-dody').html(pm.text);
                $('.promo-two-img').attr('src', pm.image);

            } catch(e) {

            }
        },

        displayUserInfo : function() {

            /**
             * Re-enable this once member service until then use parse login
             */
            /*if (uInfo != 'null' && typeof $.parseJSON(uInfo) === 'object') {

                this.userInfo = $.parseJSON(uInfo);
                this.isLoggedIn = true;

                $('.user-member-name').html(
                    this.userInfo.name.first_name.charAt(0).toUpperCase() + this.userInfo.name.first_name.substring(1)
                    +' '+
                    this.userInfo.name.last_name.charAt(0).toUpperCase() + this.userInfo.name.last_name.substring(1)
                );
                $('.user-club-info-card-type').html(
                    this.userInfo.tierType.charAt(0).toUpperCase() + this.userInfo.tierType.substring(1).toLowerCase()
                    + ' Member'
                );

                $('.usr-rewards-point').prepend(this.userInfo.availAmount.value + ' ');
                $('.logged-in-user').show();

            } else {
                $('.logged-out-user').show();
            }*/

            var df = $.Deferred();

            // Check cookie for logged in state
            var cookieset =  $.cookie('mid'); // get cookie tmid value
            //var cookieset = '266414671';  // use mine
            if (cookieset != '' && cookieset != null) {
                this.isLoggedIn = true;
                var locale = 'en_AU';
                var hclUrl = "http://www.hotelclub.com/?locale=en_AU&curr=" + curr;
                //var hclUrl = "/n/logged-in.html";
                var request = $.ajax({
                    type : "Get",
                    url : hclUrl,
                    jsonp: false
                });
				ga('send', 'Member - ID', {
				  'metric2':  cookieset
				}); //Google Member ID Val
                request.done(function (msg) {

                    var Mydata = $.trim(msg);
                    var htmlObject = $($.parseHTML(Mydata));
                    var userName = htmlObject.find('#header .aboveNav ul.login li.welcomeText').html();
                    var userTier = htmlObject.find('#header .aboveNav ul.login li.loyaltyTier').html();
                    var userBalance = htmlObject.find('#header .aboveNav ul.login li.loyaltyInfo').html();
                    //console.log('userBalance raw' + userBalance);
                    if(null != userBalance) userName = userName.replace('Welcome ', '');
                    if(null != userTier) userTier = userTier.replace(':', '');

                    var UserBalanceRegx = new RegExp('.*?(\\(.*\\))',["i"]);
                    var m = UserBalanceRegx.exec(userBalance);
                    if(null != m) {
                        userBalance = m[1];
                        userBalance = userBalance.replace('(', '');
                        userBalance = userBalance.replace(')', '');
                        var memberPriceRegx = new RegExp('\\d*[,.]?\\d+',["i"]);
                        var n = memberPriceRegx.exec(userBalance);
                        memberPrice = n= undefined !== n[0] ? n[0] : 0;
                    }
                    userName = undefined == userName ? '' : userName;
                    userBalance = undefined == userBalance ? 0 : userBalance;
                    userTier = undefined == userTier ? '' : Deals.t(userTier.toLowerCase().replace(' ', '_'));
                    //var userBalance = htmlObject.find('.userBalance').html();
                    //var userName = htmlObject.find('.userName').html();
                    //var userTier = htmlObject.find('.userTier').html();
                    //console.log('memberPrice:' +userTier);

                    $('.user-member-name').html(userName);
                    $('.user-club-info-card-type').html(userTier + '<br /><a class="sign-out" href="https://www.hotelclub.com/account/logout?destinationUrl=http://hotelclub.com/'+ MNME +'">Sign out</a>');
                    $('.usr-rewards-point').html(userBalance);
                    $('.logged-in-user').show();

                    df.resolve();
                });
                request.fail(function () {
                    df.reject();
                });
                $('.logged-in-user').show();
                $('.logged-out-user').hide();
				ga('send', 'Session - Anon ID', {
				  'dimension12':  $.cookie('anon')
				}); // Google Session - Anon ID
            } else {
                df.reject();
                $('.logged-in-user').hide();
                $('.logged-out-user').show();
				ga('send', 'Session - Visit ID', {
				  'dimension17':  $.cookie('JSESSIONID')
				}); // Google Session - Visit ID
            }
            return df.promise();
        },

        displayOrbot : function() {
			// Check if on page orbot is exists
            if ($('.orbot-in-page').length > 0) {
                $('.section .hotel-cards-container').html('');
            }
            //scroll to top of the page
            $("html, body").animate({ scrollTop: 0 }, 300);
			$(".modal-wrapper").fadeIn('slow');
			var docHeight = $(document).height();
            var template = HB.compile( $("#orbot-template").html() );
			$('body').append( template( {city : this.city, trans : this.trans} ) );//append the popup template

            //console.log(this.city);
			var dateToday = new Date();
			var checkRates = "Check Rates";
			$("#check-in").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				dateFormat: dFormat,
				firstDay : 0,
				altField: "#alt-check-in",
				altFormat: "D,d M yy",
				dayNamesMin : [ Deals.t('sunday'), Deals.t('monday'), Deals.t('tuesday'), Deals.t('wednesday'), Deals.t('thursday'), Deals.t('friday'), Deals.t('saturday') ],
				monthNames: [Deals.t('january'), Deals.t('february'), Deals.t('march'), Deals.t('april'), Deals.t('may'), Deals.t('june'), Deals.t('july'), Deals.t('august'), Deals.t('september'), Deals.t('october'), Deals.t('november'), Deals.t('december')],
				onSelect : function(dateText, inst) {
					var date2 = $('#check-in').datepicker('getDate');
					var gaCheckInDate = $('#check-in').datepicker('option', 'dateFormat', dFormat);
					ga('send', 'event', 'search-bar', 'orbot-select', 'check-in', gaCheckInDate.val());					
					date2.setDate(date2.getDate() + 1);

					$('#check-out').datepicker('setDate', date2);
					$('#check-out').datepicker('option', 'minDate', date2);
					var gaCheckOutDate = $('#check-out').datepicker('option', 'dateFormat', dFormat);
					ga('send', 'event', 'search-bar', 'orbot-select', 'check-out', gaCheckOutDate.val());				
				}
			});//initialize the date-picker for check-in
			$("#check-out").datepicker({
				inline : true,
				minDate : 0,
				showCurrentAtPos : 0,
				dateFormat: dFormat,
				altField: "#alt-check-out",
				altFormat: "D,d M yy",
				dayNamesMin : [ Deals.t('sunday'), Deals.t('monday'), Deals.t('tuesday'), Deals.t('wednesday'), Deals.t('thursday'), Deals.t('friday'), Deals.t('saturday') ],
				monthNames: [Deals.t('january'), Deals.t('february'), Deals.t('march'), Deals.t('april'), Deals.t('may'), Deals.t('june'), Deals.t('july'), Deals.t('august'), Deals.t('september'), Deals.t('october'), Deals.t('november'), Deals.t('december')],
				onSelect : function(dateText, inst) {
					var gaCheckOutDate = $('#check-out').datepicker('option', 'dateFormat', dFormat);
					ga('send', 'event', 'search-bar', 'orbot-select', 'check-out', gaCheckOutDate.val());
					$('#check-in').datepicker("option", "maxDate",
						$('#check-out').val()
					);
					var gaCheckInDate = $('#check-in').datepicker('option', 'dateFormat', dFormat);
					ga('send', 'event', 'search-bar', 'orbot-select', 'check-in', gaCheckInDate.val());				
				}
			});//initialize the date-picker for check-out

			$("body").append("<div id='overlay'></div>");
			$("#overlay")
				.height(docHeight)
				.css({
				 'opacity' : 0.6,
				 'position': 'absolute',
				 'top': 0,
				 'left': 0,
				 'background-color': 'black',
				 'width': '100%',
				 'z-index': 200
			});
			$(".modal-wrapper").css({
				//'position': 'absolute',
				'top': '150px',
				'left': '150px',
				'z-index': 999
			});
/*			$("#check-in").css({
				//'position': 'absolute',
				'top': '171px',
				'left': '17px',
				'z-index': 9999,
				'width':'116px',
				'padding-left':'2%'
			});
			$("#check-out").css({
				//'position': 'absolute',
				'top': '171px',
				'left': '156px',
				'z-index': 9999,
				'width':'116px',
				'padding-left':'2%'
			});*/
        },

        displayHeader : function() {

            var ldin, crdin;
            try {
                ldin = $.parseJSON(lD);
                crdin = $.parseJSON(crD);
            } catch(e) {

            }
            var template = HB.compile( $("#header-template").html() );
            $('#header-container').append(template(
                {trans: $.extend({}, this.trans, this.hPageData['translation']), locale : locale, localOptions : ldin, 'currencyOptions' : crdin, curr : curr, defaultUrl : MNME}
            ));
        },

        displayFilter : function() {
            var template = HB.compile( $("#filter-template").html() );
            $('#filter-box').append(template());
            $('#filter-btn').show();
        },


        displaySortBox: function() {
            var template = HB.compile( $("#sort-template").html() );
            $('.section .container #sort-row-uq').html(template({city : this.cityNameUtf, trans : this.trans}));
        },

        displayHotelCards : function( data ) {

            var template = HB.compile( $("#hotel-card-template").html() );
            data['currDoc'] = this.currDoc;
            $('.section .hotel-cards-container').html(template( data ));

            $("img.lazy").lazyload({
                effect : "fadeIn"
            }).removeClass("lazy");
        },

        displayRegionHotelCards : function () {
            var template = HB.compile( $("#region-card-template").html() );
            $('.section .region-cards-container').append(template({regionCardData : this.hPageData['data'], trans: $.extend({}, this.trans, this.hPageData['translation'])}));
            $('.region-hotel-card-box').show();
        },

        displayFooter : function () {
            var template = HB.compile( $("#footer-template").html() );
            $('.section .footer-container').append(template());
        },

        updateFooterText : function() {
            $(".footer-intro #footer-intro-title").text( this.t('footer_intro_title'));
            $(".footer-intro #footer-intro-text").text( this.t('footer_intro_text'));
        },


        getWhereDoGoText : function () {

            return {
                '7-days' : this.t('in_the_next_7_days'),
                '30-days' : this.t('in_the_next_30_days'),
                '30-beyond' : this.t('30_days_and_beyond'),
                ':robot' : this.t('exact_dates')
            }
        },

        getLastDestination : function() {
            return $('<option>', { value : ":orbot-dest", text : this.t('all_other_destinations')} );
        },

        setCityData : function() {

            try{
                this.cityData = $.parseJSON(cData);
            } catch(e) {
                this.cityData = false
            }
        },

        getCityData : function() {
            this.cityData;
        },

        setDropDownDefaultOption : function() {
            var self = this;
            return {
                dropRegion : function() {
                   return $('.dropdown-region').html('').append( $('<option>', {
                        value : '0',
                        text : self.t('Where_you_want_to_go'),
                        'selected' :'selected'
                    }) );

                },
                dropCities : function() {
                    return $('.dropdown-cities').html('').attr('disabled','disabled').addClass('disabled-style')
                        .append( $('<option>', {
                        value : '0',
                        text : self.t('what_city'),
                        'selected' :'selected'
                    }) );
                },
                dropWhereDo : function() {
                    return $('.dropWhereDo').html('').attr('disabled','disabled').addClass('disabled-style')
                        .append( $('<option>', {
                        value : '0',
                        text : self.t('when_want_to_go'),
                        'selected' :'selected'
                    }) );
                }
            }
        },

        displayWhenGo : function(defaultText) {

            if (defaultText === true) {

                dropWhereDo = $('.dropWhereDo').html('').append( $('<option>', {
                        value : '0',
                        text : this.t('when_want_to_go'),
                        'selected' :'selected'
                    }) );
            } else {
                dropWhereDo = $('.dropWhereDo').html('');
            }

            $.each(this.getWhereDoGoText(), function (key, val) {

                var opt =  opt = {
                    value : key,
                    text : val
                };
                dropWhereDo.append( $('<option>', opt ) );
            })

            return dropWhereDo;
        },

        displayDropDownData : function (selectType) {

           if (selectType == 'default') {

               var dropRegion = this.setDropDownDefaultOption().dropRegion(),
                   dropCities = this.setDropDownDefaultOption().dropCities(),
                   dropWhereDo = this.setDropDownDefaultOption().dropWhereDo();
           } else if (selectType == 'value') {

               var dropRegion  = $('.dropdown-region').html(''),
                   dropCities  = $('.dropdown-cities').html(''),
                   dropWhereDo = $('.dropWhereDo').html('');
           }

            var self = this;

            var chopArr = new Array, regionFlag = false, cityFlag = false, RegionOpt, regionVal, loopThrough = true;

            if (typeof this.cityData != 'undefined') {

                $.each(this.cityData, function (key, val) {

                    var RegionOpt = {
                        value: key,
                        text: val.nameUtf8
                    };
                    dropRegion.append($('<option>', RegionOpt));

                    if (typeof val.cities === 'object' && loopThrough !== false) {


                        $.each(val.cities, function (k, v) {

                            if (regionFlag === key) {

                            } else {
                                // console.log('city flag ' + cityFlag);
                                if (cityFlag == true) {
                                    //console.log(chopArr);
                                    //console.log('re val' + key);
                                    loopThrough = false;
                                    return false;
                                    //console.log('working..');
                                } else {
                                    chopArr.length = 0;
                                    regionVal = '';
                                }
                                regionFlag = key;
                            }

                            if (k === self.city) {
                                cityFlag = true;
                                regionVal = key;
                                //console.log('found ' + self.city);
                            }
                            chopArr.push(v);
                            // dropCities.append( $('<option>', opt ) );

                        });
                    }
                });
            }

            // display city
            var sortable = [];
            for (var city in chopArr) {
                sortable.push([chopArr[city]['code'], chopArr[city]['image'], chopArr[city]['nameUtf8'], chopArr[city]['name_en']]);
            }

            sortable.sort(function(a, b) {

                if (a[2] > b[2]) {
                    return 1;
                }
                if (a[2] < b[2]) {
                    return -1;
                }
                return 0;
            });

            //console.log(sortable);

            $.each(sortable, function (key, val) {

                var opt =  opt = {
                    value : val[3],
                    text : val[2]
                };

                self.cityImage[val[3]] = val[1];

                if (selectType == 'value' && val[3] == self.city) {
                    opt.selected = "selected";
                    self.cityNameUtf = val[2];

                }
                dropCities.append( $('<option>', opt ) );
            });
            //get last destinatoin
            dropCities.append( this.getLastDestination() );

            if (selectType == 'value')
                $('.dropdown-region').val(regionVal).attr("selected", "selected");

            $.each(this.getWhereDoGoText(), function (key, val) {

                var opt =  opt = {
                    value : key,
                    text : val
                };
                if (selectType == 'value' && key == self.when) {
                    opt.selected = "selected";
                }
                dropWhereDo.append( $('<option>', opt ) );
            })
        },

        displayDropDownCity : function(region) {

            if(undefined === self.cityImage || null === self.cityImage ) self.cityImage = '';

            if (typeof this.cityData[region] == "object") {

                this.cityImage.length = 0;
                self = this;
                $('.dropdown-cities option').remove()
                var dropCities = this.setDropDownDefaultOption().dropCities();
                this.displayWhenGo(true).attr('disabled','disabled').addClass('disabled-style');


                var sortable = [];

                $.each(this.cityData[region], function (k, v) {

                    if (typeof v === "object") {

                        $.each(v, function (k1, v1) {
                           sortable.push([ v1['code'], v1['image'], v1['name_en'], v1['nameUtf8'] ]);
                        });
                    }
                });

                sortable.sort(function(a, b) {

                    if (a[2] > b[2]) {
                        return 1;
                    }
                    if (a[2] < b[2]) {
                        return -1;
                    }
                    return 0;
                });

                $.each(sortable, function (key, val) {

                    var opt =  opt = {
                        value : val[2],
                        text : val[3]
                    };
                    self.cityImage[val[2]] = val[1];
                    dropCities.append( $('<option>', opt ) );
                });

                dropCities.append( this.getLastDestination() );
            }


        },

        setCityImage : function() {

            if (typeof this.cityImage[this.city] !== 'undefined' && this.cityImage[this.city] != "") {

                $('.hero').css('background-image', 'url(' + this.cityImage[this.city] + ')');

            } else {
                this.setHeroesImage();
            }
        },

        sortByNumber : function(fName, type) {

            var newArr = Array(),
                self = this;

            $.each(this.hData, function (key, val) {

                //only for sort by price
                if (fName == 'price') {

                    //get the price from currency document and update to deals price value
                    if (typeof self.currDoc['data'][key] !== 'undefined') {
                        val['price'] = self.currDoc['data'][key][0];
                    }
                }
                newArr.push(val);
            });

            newArr.sort(function (a, b) {

                if (type == 'asc') {
                    return a[fName] - b[fName];
                } else {
                    return b[fName] - a[fName];
                }
            });
            //console.log(newArr);

            this.displayHotelCards( { hData : newArr, isLoggedIn : this.isLoggedIn, memBalance : memberPrice, trans : $.extend({}, this.trans, this.hPageData['translation'])});
        },

        sortByText : function(fName, type) {

            var newArr = new Array();
            $.each(this.hData, function (key, val) {
                newArr.push(val);
            });

            newArr.sort(function (a, b) {

                if (type == 'asc') {

                    if (a[fName] > b[fName]) {
                        return 1;
                    }
                    if (a[fName] < b[fName]) {
                        return -1;
                    }
                    return 0; // a must be equal to b

                } else {

                    if (a[fName] < b[fName]) {
                        return 1;
                    }
                    if (a[fName] > b[fName]) {
                        return -1;
                    }
                    return 0; // a must be equal to b
                }

            });

            this.displayHotelCards( { hData : newArr, isLoggedIn : this.isLoggedIn, memBalance : memberPrice, trans :$.extend({}, this.trans, this.hPageData['translation']) });
        },

        orbotValidation : function() {

            var validForm = true;
                cityName = $('.robot-city-name'),
                checkIn = $('#check-in'),
                checkOut = $('#check-out'),
                valMessage = $('.orbot-validation-message'),
                checkInDate = (checkIn.val() == 'dd/mm/yy') ? '' : checkIn.val(),
                checkoutDate = (checkOut.val() == 'dd/mm/yy') ? '' : checkOut.val()

            valMessage.html(''); // clear validation messages
            cityName.css('outline',' 2px solid #dddee0');
            checkIn.css('outline',' 2px solid #dddee0');
            checkOut.css('outline',' 2px solid #dddee0');

            if ($.trim(cityName.val()) == '') {
                cityName.css('outline',' 1px solid red');
                valMessage.append('<p>'+Deals.t('city_name_validation')+'</p>')
                validForm = false;
            }

            if ($.trim(checkInDate) == '') {
                checkIn.css('outline',' 1px solid red');
                valMessage.append('<p>'+Deals.t('check_in_validation')+'</p>')
                validForm = false;
            }

            if ($.trim(checkoutDate) == '') {
                checkOut.css('outline',' 1px solid red');
                valMessage.append('<p>'+Deals.t('check_out_validation')+'</p>')
                validForm = false;
                return false;
            }

            if (dFormat == 'y/mm/dd') {

                var chD = checkInDate.split('/'),
                    chD = chD[1]+'/'+chD[2]+'/'+chD[0],

                    chOD = checkoutDate.split('/'),
                    chOD = chOD[1]+'/'+chOD[2]+'/'+chOD[0];

            } else if (dFormat == 'yy-mm-dd') {

                var chD = checkInDate.split('-'),
                    chD = chD[1]+'/'+chD[2]+'/'+chD[0],

                    chOD = checkoutDate.split('/'),
                    chOD = chOD[1]+'/'+chOD[2]+'/'+chOD[0];

            } else if (dFormat == 'dd/mm/y') {
                var chD = checkInDate.split('/'),
                    chD = chD[1]+'/'+chD[0]+'/'+chD[2],

                    chOD = checkoutDate.split('/'),
                    chOD = chOD[1]+'/'+chOD[0]+'/'+chOD[2];
            } else {
                var chD = '',
                    chOD = '';
            }

            var  cInTimestamp  = new Date(chD).getTime(),
                 cOutTimestamp = new Date(chOD).getTime();

            if (isNaN(cInTimestamp) == true) {
                checkIn.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-in date</p>')
                validForm = true;
            }

            if (isNaN(cOutTimestamp) == true) {
                checkOut.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-out date</p>')
                validForm = false;
            }

            var d = new Date(),
                obj = new Date((d.getMonth() + 1) +'/'+ d.getDate() +'/'+ d.getFullYear());

            if ( obj.getTime() > new Date(chD).getTime() ) {
                checkIn.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-in date</p>')
                validForm = true;
            }

            if ( cInTimestamp >= cOutTimestamp ) {
                checkOut.css('outline',' 1px solid red');
                valMessage.append('<p>Please enter valid Check-out date</p>')
                validForm = false;
            }

            if (validForm == true)
                return true;
            else
                return false
        },
		selectDateValidation : function() {
            var validSelectForm = true, selectCheckIn = $('#select-check-in'), selectCheckOut = $('#select-check-out'), selectValMessage = $('.select-validation-message');
            selectCheckInDate = (selectCheckIn.val() == 'dd/mm/yy') ? '' : selectCheckIn.val();
            selectCheckOutDate = (selectCheckOut.val() == 'dd/mm/yy') ? '' : selectCheckOut.val();
			selectValMessage.html(''); // clear validation messages

			if ($.trim(selectCheckInDate) == '') {
                selectCheckIn.css('outline',' 1px solid red');
                selectValMessage.append('<p>'+Deals.t('check_in_validation')+'</p>');
				$('#alternate-check-in').val('');
                validSelectForm = false;
            }
			if ($.trim(selectCheckOutDate) == '') {
                selectCheckOut.css('outline',' 1px solid red');
                selectValMessage.append('<p>'+Deals.t('check_out_validation')+'</p>');
				$('#alternate-check-out').val('');
                validSelectForm = false;
            }
			if (validSelectForm == true){
				selectValMessage.empty();
				selectCheckIn.css('outline','0');
				selectCheckOut.css('outline','0');
                return true;
			}
            else
                return false;
		},
        /**
         * This is from merch.js, temporary implementation until member service is fixed
         */
        parseLogin : function(){}
    }

    Deals.init();

    $(document).on('click', '.filter-button', function(e) {
        $('.filter').slideToggle();
        e.preventDefault();
    });

	/*document ready*/
    $(document).ready(function(){
		/*card hover design*/
/*        $('.card-img, .hotel-name-head, .hotel-card-button').hover(function() {
            $(this).parents('.card').css('border','1px solid #e80f1e');
        }, function () {
            $(this).parents('.card').css('border','1px solid #d0d9d7');
        });*/

        /*if(Deals.isLoggedIn){
            $('.member-info').show();
            $('.member-price-title').show();
        } else {
            $('.member-info').hide();
            $('.member-price-title').hide();
        }*/
		/*drop down for language selection*/
		$(".club-id .locale-drop-down-arrow").click(function(e) {

            e.preventDefault();
            $(".locale-wrapper").toggle();

		});

		$(".locale-wrapper ul li a").click(function(e) {

            e.preventDefault();

            var u = MNME.split('/'),
                url = '',
                cLocale = $(this).attr('data-locale');

            if (u[1].match(/^([a-z]{2})+_([A-Z]{2})+$/)) {
                u[1] = $(this).attr('data-locale');
                $.each(u, function(index, val){

                    url += val;
                    if (u[index + 1] !== undefined)
                        url += '/';
                });

            } else {
                if($(this).attr('data-locale') != 'en_AU') {
                    url = '';
                    var uArr = MNME.split('/');
                    $.each(uArr, function(index, val) {
                        if (index == 0) {
                            url += uArr[0] + '/' + cLocale;
                        } else {
                            url += '/' + uArr[index];
                        }
                    });
                    //console.log(url); return;
                } else {
                    url = MNME;
                }
            }
            if (Deals.city != '')
                url += '/' + Deals.city;

            if (Deals.when != '')
                url += '/' + Deals.when   ;

            //console.log(Deals.city + ' where => '+ Deals.when);
            if (window.location.href.split('?')[1] !== undefined) {
                url += '?' + window.location.href.split('?')[1];
            }

            // Also set cookie
            $.cookie('AustinLocale', cLocale,{ path: "/" });

            window.location = window.location.protocol + '//' + window.location.host + '/' + url;

		});

		$(document).bind('click', function(e) {
			var $clicked = $(e.target);
			//console.log($clicked.parents().hasClass("club-id"));
			if(!$clicked.parents().hasClass("club-id")){
				$(".club-id .locale-wrapper").hide();
			}
			if(!$clicked.parents().hasClass("club-id-currency")){
                /**
                 * disabled: Phase 1, 2
                $(".currency-wrapper").hide();
                */
                $(".currency-wrapper").hide();
			}
		});
		/*end drop down for language selection*/

		/*promo-code-val clear data starts here*/
		$('#promo-code-val').on('click', function() {
            if ($(this).val() == $(this).attr('data-value')) {
                $(this).val('');
            }
		});

        $('#promo-code-val').on('blur', function() {
           if ($(this).val() == '') {
               $(this).val($(this).attr('data-value'));
           }
		   ga('send', 'event', 'hotel-card', 'orbot-select', 'promo-code', '"'+$(this).val()+'"');       
        });
		/*promo-code-val clear data ends here*/

		/*drop down for currency selection*/
		$(".club-id-currency").click(function() {

            $(".currency-wrapper").toggle();

        });

		$(".currency-box ul li ul li").click(function() {
            var loc = '';
            if (location.href.indexOf('?') === -1) {
                loc = window.location.href + '?curr=' + $(this).children().attr('data-curr')
            } else {
                //console.log(updateQueryStringParameter(window.location.href, 'locale', $(this).attr('data-locale')));
                loc = updateQueryStringParameter(window.location.href, 'curr', $(this).children().attr('data-curr'));
            }
            // Also set cookie
            $.cookie('curr', $(this).children().attr('data-curr'),{ path: "/" });
            window.location = loc;

/*            var text = $(this).html();
            //console.log(text);
            $(".user-space .drop-down-arrow").html(text);
            $(".user-space .drop-down-arrow .desc").remove();
            $(".currencySelectorItem").html(text);*/

		});
		/*end drop down for currency selection*/

		/* member-info starts here.. */
		/*$(".member-info").hover(function(){
			//console.log($(this).next());
			var divToShow = $(this).next();
			divToShow.css({
				'display': 'block'
			});
		},function (){
			$(".member-info-desc").hide();
		});*/
		$(document).on('click', '.member-info', function() {

            if ($(this).next().css('display') == 'none') {
                $('.member-info-desc').css('display', 'none');
                var divToShow = $(this).next();
                divToShow.css({
                    'display': 'block'
                });
            } else {
                $(this).next().css('display','none');
            }
		});
        $(document).on('click','.member-info-close', function() {
			$(this).parent().parent().css('display','none');
		});
		/* member-info ends here.. */

		$('.select-dates-input-child').on('change', function() {
		 // console.log( this.value ); // or $(this).val()
		  if(this.value>=1){
			$('.roomVal').remove();
			$(".room").css("display","block");
			var cntVal, i;
			cntVal = '<div class="roomVal"><div class="select-date-ages-label">*' + Deals.t('ages_of_children_at_time_of_trip_note') + '</div>';
			for(i=0;i<this.value;i++){
				cntVal+="<select name='room-1-child-"+i+"' class='select-dates-input child-room' id='room-1-child-"+i+"'><option value='00'><1</option><option value='01'>1</option><option>2</option><option>3</option><option>4</option> <option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option></select>";
			}
			//console.log(cntVal);
			cntVal+="<div>";
			$(".room").append(cntVal).html();
		}  else{
			 $('.roomVal').remove();
			}
		});

        //Using setTimeout only isn't a correct solution because you have no idea how long it will take for the content to be
        // loaded so it's possible the popstate event is emitted after the timeout.
/*        window.addEventListener( 'load' , function() {
            setTimeout( function() {
                window.addEventListener( 'popstate' , function( event ) {

                    if ( event.state ) {
                        var urlArr = event.state.url.split( '/' );
                            when = urlArr[ urlArr.length -1 ],
                            city = urlArr[ urlArr.length -2 ];
                        Deals.route( {region : '', city : city, when: when, dropDownRefresh : true}, 'hotelCardCtrl' );

                    } else {
                        Deals.defaultCtrl( '' );
                    }
                });
            }, 0);
        });*/

        // Bind to StateChange Event
        History.Adapter.bind(window, 'statechange', function() {
			ga('send', 'Page - ID', {
			  'dimension1':  'hclphp100'
			});//Google - Page ID value

			ga('send', 'Page - Locale', {
			  'dimension20':  $.cookie('AustinLocale')
			});//Google - Page Locale value

			ga('send', 'Page currency code', {
			  'dimension21':  $.cookie('curr')
			});//Google - Page Currency code value

			ga('send', 'Page template name', {
			  'dimension24':  'sale-deals-landing'
			});//Google - Page Currency code value

            var State = History.getState();
            if (State && manualState == true) {
                var urlArr = State.cleanUrl.split( '/'),
                    when = urlArr[ urlArr.length -1 ],
                    city = urlArr[ urlArr.length -2];

                if (when.indexOf('?') != '-1') {
                    when = when.split('?')[0];
                }

                Deals.setCity(city);
                Deals.setWhen(city);

                //console.log('city => '+city + ' when=> '+when);

                if (when == '' || city == '' || typeof Deals.getWhereDoGoText()[when] == "undefined") {

                    if($(".region-hotel-card-box").length == 0) {
                        Deals.defaultCtrl(true);
                    } else {
                        Deals.defaultCtrl(false);
                    }

                    Deals.setMetadata('home');

                } else {
                    var sortBy = getParameterByName('sort'),
                        sortType = getParameterByName('type');

                    if (sortBy != '')
                        Deals.sortBy = sortBy;

                    if (sortType != '')
                        Deals.sortType = sortType;

                    Deals.setMetadata('destination');
                    Deals.hotelCardCtrl( {region : '', city : city, when: when, curr: curr, dropDownRefresh : true} );
                }

            }
            manualState = true;
        });

        //remove default select option
        $('.input-default-value').change(function() {
            //remove default option
            var className = $(this).data('rm-val');
            $('.' + className + ' option[value="0"]').remove();

            var rg = $('.dropdown-region').val(),
                cy = $('.dropdown-cities').val(),
                dy = $('.dropWhereDo').val();

            Deals.setRegion(rg);
            Deals.setCity(cy);
            Deals.setWhen(dy);

            Deals.cityNameUtf = $(".dropdown-cities option:selected").text();

            //release disable
            switch (className) {
                case 'dropdown-region' :

                    Deals.displayDropDownCity(rg);
                    $('.dropdown-cities').removeAttr('disabled').removeClass('disabled-style');
                    $('.dropdown-cities').focus();
                    ga('send', 'event', 'search-bar', 'region-select', rg);
                    // do not reset image, keep prev image
                    //$('.hero').css('background-image', 'url(/n/themes/deals/images/backgrounds/resort-desktop.jpg)');
                    break;

                case 'dropdown-cities' :

                    if (cy == ":orbot-dest") {
						if($(document).width()<768){
							window.open('//www.hotelclub.com/', '_blank');
							return false;
						}
                        Deals.setCity('');
                        Deals.cityNameUtf = '';
                        Deals.displayOrbot();
                    } else if (dy != 0) {
                        Deals.displayWhenGo(true);
                    }

                    $('.dropWhereDo').removeAttr('disabled').removeClass('disabled-style');
                    $('.dropWhereDo').focus();
                    ga('send', 'event', 'search-bar', 'destination-select', cy);
                    //set city image only afer user selects last option
                    //Deals.setCityImage();
                    break;

                case 'dropWhereDo' :

                    if ($(this).val() == ':robot') {
                        //initialize popup
                        //console.log($(this).val());
                        if($(document).width()<768){
							window.open('//www.hotelclub.com/', '_blank');
							return false;
						}
                        if (cy == ":orbot-dest")
                            Deals.setCity('');
                            Deals.cityNameUtf = '';
							Deals.displayOrbot();

                        ga('send', 'event', 'search-bar', 'date.range-select', 'exact date');
                    } else {
                        //start routing ....
                       // console.log(typeof rg, typeof cy, typeof dy);
                        if (typeof rg == "string" && typeof cy == "string" && typeof dy == "string") {
                            //start routing ..
                            Deals.setMetadata('destination');
                            Deals.route({region:rg, city:cy, when:dy, curr : curr}, 'hotelCardCtrl');
                            Deals.setCityImage();
                            $('.region-hotel-card-box').hide();
                             Deals.updatePromotion();
                            // Set breadcrumb
                            $('#breadcrumb-city').html( Deals.cityNameUtf );

                            var tVal = '';
                            if (dy == '7-days')
                                tVal = 'next-7-days';
                            else if (dy == '30-days')
                                tVal = 'next-30-days';
                            else if (dy == '30-beyond')
                                tVal = 'over-30-days';

                            ga('send', 'event', 'search-bar', 'date.range-select', tVal);
                        }
                    }
                    break;
            }
        });

        /** Make soem adjustments for mobile **/

        /** Shorten name for Australia, New Zealand & Pacific **/
        if($(document).width()<479){
            var firstRegionOption = $('.dropdown-region > option:first-child').text();
            firstRegionOption = firstRegionOption == 'Australia, New Zealand & Pacific' ? 'Australia, NZ & Pacific' : firstRegionOption;
            $('.dropdown-region > option:first-child').text(firstRegionOption);
        }

    });

	/*start of fetching adult in select dates*/
	$(document).on('change','.select-dates-input-popup', function(event){
		var roomNumVal = $(this).attr('id').split("-");
		var roomNumTemp = roomNumVal[2];
		ga('send', 'event', 'hotel-card', 'orbot-select', 'adult', {roomNumTemp:'"'+this.value+'"'});
	});
	/*end of fetching adult in select dates*/

	/*start of display child candidates*/
	$(document).on('change','#child-input-2', function(event){
		ga('send', 'event', 'hotel-card', 'orbot-select', 'children', {2:this.value});
		roomChildVal(2, this.value);
	});
	$(document).on('change','#child-input-3', function(event){
		ga('send', 'event', 'hotel-card', 'orbot-select', 'children', {3:this.value});
		roomChildVal(3, this.value);
	});
	$(document).on('change','#child-input-4', function(event){
		ga('send', 'event', 'hotel-card', 'orbot-select', 'children', {4:this.value});
		roomChildVal(4, this.value);
	});
	$(document).on('change','#child-input-5', function(event){
		ga('send', 'event', 'hotel-card', 'orbot-select', 'children', {5:this.value});
		roomChildVal(5, this.value);
	});
	/*end of displaying child candidates*/

	$(document).on('change', '.orbot-select-adult', function(){
		gaDataRowVal = parseInt($(this).parents('div.six.columns').attr('data-row'));
		ga('send', 'event', 'search-bar', 'orbot-select', 'adults', {gaDataRowVal:$(this).val()});
	});

    $(document).on('change', '.orbot-select-children', function(){
		var child = '',
            option = '<option value="00"><1</option><option value="01">1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option>',
            text = '<p style="font-size:12px;text-align: right;">' + Deals.t('ages_of_children_at_time_of_trip_note') + '</p>',
			dataRow1 = $(this).parents('div.six.columns').attr('class'),
			dataRow2 = parseInt($(this).parents('div.six.columns').attr('data-row'));
			ga('send', 'event', 'search-bar', 'orbot-select', 'children', {dataRow2:$(this).val()});

		for(var i=1; i <= $(this).val(); i++) {
            child += '<div class="two columns orb-child-age-sty">';
            child += '<select class="modal-dropdown-select-child orb-child-age-'+(dataRow2-1)+'-'+(i)+'">'+ option + '</select>';
            child += '</div>';
        }
		$('.orbot-child-' + dataRow2).remove();
		$(this).parents('div.six.columns').after('<div class="modal-row or-sub-option orbot-child-'+dataRow2+'"><div class="six columns">&nbsp;</div><div class="six columns data-row="'+dataRow2+'">' + text + child + '</div></div>');
    });

	$(document).on('click','.orbot-remove-rooms', function(){
		var i = $('.orbot-select-rooms').parent().prev().children(':last-child').attr('data-row');
		$('.orbot-select-rooms').parent().prev().children(':last-child').attr('class'), $('.orbot-select-rooms').parent().prev().children(':last-child').remove();

		if((i-1)<=5){ $('.orbot-select-rooms, .orbot-divider').css('display', 'block'); }		
		if(i==2){ $('.orbot-remove-rooms, .orbot-divider').css('display', 'none'); }
		selectExactDateScroll('remove', i);
	});
    $(document).on('click', '.orbot-select-rooms', function() {
		var i = parseInt($('.orbot-select-rooms').parent().prev().children(':last-child').attr('data-row'));

        var child = '',
            parentObj = $(this).parents('.modal-row'),
            optionChild = '<option>--</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>',
            optionAdult = '<option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option>';

        // remove if any child element exists
        /*for (var i = 0; i <= 5; i++) {
            $('.orbot-child-'+(i-1)).remove();
        }*/
        //$('.orb-child-0').val('--');

        //for(var i=1; i < $(this).val(); i++) {

            child += '<div data-row="'+(i+1)+'" class="modal-row orb-rooms-dy"><div class="six columns">&nbsp;</div><div class="six columns" data-row="'+(i+1)+'">';

            child += '<div class="four columns">'+ Deals.t('room') +' '+(i+1)+'</div>';
            child += '<div class="four columns">';
            child += '<select class="modal-dropdown-select orbot-select-adult orb-adults-'+i+'">'+ optionAdult + '</select>';
            child += '</div>';

            child += '<div class="four columns">';
            child += '<select class="modal-dropdown-select orbot-select-children orb-child-'+i+'">'+ optionChild + '</select>';
            child += '</div>';

            child += '</div></div>';
        //}

		$('.orbot-select-rooms').parent().parent().prev().children(':last-child').attr('data-row', (i+1));
		$('.orbot-select-rooms').parent().prev().children(':last-child').after( child );
		if(i>=1){ $('.orbot-remove-rooms, .orbot-divider').css('display', 'block'); }
		if((i+1)>=5){ $('.orbot-select-rooms, .orbot-divider').css('display', 'none'); }
		selectExactDateScroll('add', (i+1));

    });

    /*display popup - on date selection starts here*/
    $( document ).on( 'click', '.hotel-card-button', function () {

       var template = HB.compile( $("#select-popup-template").html() );
       $('.section .hotel-cards-container').append(template({trans : Deals.trans}));

		var hotelId = $(this).attr('data-onegid');
        var hotelName = $(this).attr('data-hotel');
        var cityName = $('.dropdown-cities').val();
		var date = new Date();
		var dropWhereDoVal = (($('.dropWhereDo').val()) == '30-beyond') ? 1:0;
		var minDate = new Date(date.getFullYear(), date.getMonth()+ dropWhereDoVal, date.getDate());

        ga('send', 'event', 'hotel-card', 'orbot-activate', hotelName);

		var browserWidth = $(window).width();
		if(browserWidth<768){
            /* This use-case is for mobile device: setup redirect url and bypass pop up */
            var searchUrl = "//www.hotelclub.com/shop/hotelsearch?type=hotel"
                + "&locale=" + locale
                + "&hotel.hid="+ hotelId
                + "&hotel.hname="+hotelName
                + "&hsv.showDetails=true"
                + "&hotel.type=keyword"
                + "&hotel.chkin="
                + "&hotel.chkout="
                + "&hotel.keyword.key="+cityName
                + "&hotel.rooms[0].adlts=2"
                + "&search=Search";
            console.log(searchUrl);
            window.open(searchUrl, '_blank');
			return false;
		}
        $('#selected-oneg').val(hotelId);
        $(".select-dates").fadeIn('slow');
		$('.select-date-hotel-name').empty();
		$('.select-date-hotel-name').append(hotelName.substring(0, 30));
        var docHeight = $(document).height();
        $("body").append("<div id='overlay'></div>");
        $("#overlay")
            .height(docHeight)
            .css({
                'opacity' : 0.6,
                'position': 'absolute',
                'top': 0,
                'left': 0,
                'background-color': 'black',
                'width': '100%',
                'z-index': 200
            });
        $(".select-dates").css({
            'position': 'fixed',
            'top': '6%',
            'left': '34%',
            'display':'block',
            'z-index': 999
        });
        $("#select-check-in").datepicker({
            inline : true,
            minDate : minDate,
            showCurrentAtPos : 0,
            firstDay : 0,
            dateFormat: dFormat,
			altField: "#alternate-check-in",
			altFormat: "D,d M yy",
			dayNamesMin : [ Deals.t('sunday'), Deals.t('monday'), Deals.t('tuesday'), Deals.t('wednesday'), Deals.t('thursday'), Deals.t('friday'), Deals.t('saturday') ],
			monthNames: [Deals.t('january'), Deals.t('february'), Deals.t('march'), Deals.t('april'), Deals.t('may'), Deals.t('june'), Deals.t('july'), Deals.t('august'), Deals.t('september'), Deals.t('october'), Deals.t('november'), Deals.t('december')],
            onSelect : function(dateText, inst) {
                var date2 = $('#select-check-in').datepicker('getDate');
                var gaCheckInDate = $('#select-check-in').datepicker('option', 'dateFormat', dFormat);
				ga('send', 'event', 'hotel-card', 'orbot-select', 'check-in', gaCheckInDate.val());
                date2.setDate(date2.getDate() + 1);
                $('#select-check-out').datepicker('setDate', date2);
                $('#select-check-out').datepicker('option', 'minDate', date2);
				var gaCheckOutDate = $('#select-check-out').datepicker('option', 'dateFormat', dFormat);
				ga('send', 'event', 'hotel-card', 'orbot-select', 'check-out', gaCheckOutDate.val());
                dateCalculate();
            },
            onClose: function() {
            }
        });//initialize the date-picker for check-in
        $("#select-check-out").datepicker({
            inline : true,
            minDate : minDate,
            showCurrentAtPos : 0,
            dateFormat: dFormat,
			altField: "#alternate-check-out",
			altFormat: "D,d M yy",
			dayNamesMin : [ Deals.t('sunday'), Deals.t('monday'), Deals.t('tuesday'), Deals.t('wednesday'), Deals.t('thursday'), Deals.t('friday'), Deals.t('saturday') ],
			monthNames: [Deals.t('january'), Deals.t('february'), Deals.t('march'), Deals.t('april'), Deals.t('may'), Deals.t('june'), Deals.t('july'), Deals.t('august'), Deals.t('september'), Deals.t('october'), Deals.t('november'), Deals.t('december')],
            onSelect : function(dateText, inst) {
                var gaCheckOutDate = $('#select-check-out').datepicker('option', 'dateFormat', dFormat);
				ga('send', 'event', 'hotel-card', 'orbot-select', 'check-out', gaCheckOutDate.val());
				$('#select-check-in').datepicker("option", "maxDate",
                    $('#select-check-out').val()
                );
				var gaCheckInDate = $('#select-check-in').datepicker('option', 'dateFormat', dFormat);
				ga('send', 'event', 'hotel-card', 'orbot-select', 'check-in', gaCheckInDate.val());
                dateCalculate();
            },
            onClose: function() {
            }
        });//initialize the date-picker for check-out

		$('.select-dates-button').on('click', function (){
			var checkIn = $('#select-check-in').val(), checkOut = $('#select-check-out').val(),
                roomValTemp, room = '',
                chlen=0,
                promoCodeVal = ($('#promo-code-val').val() == $('#promo-code-val').attr('data-value')) ? '' :$('#promo-code-val').val();

			if (Deals.selectDateValidation() == false) {
				return false;
			}

			var hotel = new Array();
			if($('.room-divide5').is(":visible")){ roomValTemp = 5;	}
			else if($('.room-divide4').is(":visible")){ roomValTemp = 4; }
            else if($('.room-divide3').is(":visible")){ roomValTemp = 3; }
            else if($('.room-divide2').is(":visible")){ roomValTemp = 2; }
            else if($('.room-divide1').is(":visible")){ roomValTemp = 1; }

			for(var i=1;i<=roomValTemp;i++){
				room += '&hotel.rooms%5B'+(i-1)+'%5D.adlts=' + $('#adult-input-'+i).val();
                chlen = $('#child-input-'+i).val();
                room += '&hotel.rooms%5B'+(i-1)+'%5D.chlds=' + chlen;
				if (chlen > 0) {
                    for(var j=1; j<= chlen; j++) {
                        room += '&hotel.rooms%5B'+(i-1)+'%5D.chldAge%5B'+(j-1)+'%5D=' + $('#room-'+i+'-child-'+j).val();
                    }
                }
			}

			var hotelName = $('.select-date-hotel-name').html(), cityName = $('.dropdown-cities').val();
			//close the select-dates popup

            var onegId = $('#selected-oneg').val();

            $('.select-dates').remove();
			$("#overlay").remove();

			//redirect to hotelclub site with the all the input value
			var searchUrl = "//www.hotelclub.com/shop/hotelsearch?type=hotel"
                + "&hotel.couponCode="+promoCodeVal
                + "&locale=" + locale
                + "&hotel.hid="+onegId
				+ "&hotel.hname="+hotelName
                + "&hsv.showDetails=true"
                + "&hotel.type=keyword"
                + "&hotel.chkin="+checkIn
                + "&hotel.chkout="+checkOut
				+ "&hotel.keyword.key="+cityName
                + "&search=Search"
                + room;
			//console.log(searchUrl);
            window.open(searchUrl, '_blank');
		});
        /*add-room functionality*/
        $('.add-room').on('click',function(event) {
            var roomVal = 1;
            if(!$('.room-divide2').is(":visible")){
                roomVal = 2;
                $('.remove-room').css("display","block");
                $('.divider-room').css("display","block");
            }
            else if(!$('.room-divide3').is(":visible")){
                roomVal = 3;
                $('.remove-room').css("display","block");
                $('.divider-room').css("display","block");
            }
            else if(!$('.room-divide4').is(":visible")){
                roomVal = 4;
                $('.add-room').css("display","block");
                $('.divider-room').css("display","block");
            }
			else if(!$('.room-divide5').is(":visible")){
				roomVal = 5;
 				$('.add-room').css("display","none");
 				$('.divider-room').css("display","none");
 			}
			selectDateScroll('add', roomVal);
            var roomCompVal='';
			roomCompVal="<div class='select-dates-row room-divide"+roomVal+"'><div class='horizontal-line'></div><div class='select-dates-room'><p>"+ Deals.t('room') + " " +roomVal+"</p></div><div class='select-dates-humans'><p>"+ Deals.t('adult') +" <small>(18+)</small><br /><select name='adult-input-"+roomVal+"' class='select-dates-input-popup' id='adult-input-"+roomVal+"'><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></p></div><div class='select-dates-humans room"+roomVal+"'><p>Child <small>(0-17)</small><br /><select name='child-input-"+roomVal+"' class='select-dates-input-child' id='child-input-"+roomVal+"'><option value='0'>---</option><option value='1'>1</option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option><option value='5'>5</option></select></p></div><div class='room-"+roomVal+"'></div></div>";
            $(".room-divide"+(roomVal-1)).append(roomCompVal).html();
        });

        /*remove-room functionality*/
        $('.remove-room').on('click',function(event) {
            if($('.room-divide5').is(":visible")){
				roomVal = 5;
				$('.add-room').css("display","block");
				$('.remove-room').css("display","block");
				$('.divider-room').css("display","block");
			}
			else if($('.room-divide4').is(":visible")){
                roomVal = 4;
                $('.add-room').css("display","block");
                $('.remove-room').css("display","block");
                $('.divider-room').css("display","block");
            }
            else if($('.room-divide3').is(":visible")){
                roomVal = 3;
                $('.add-room').css("display","block");
                $('.remove-room').css("display","block");
                $('.divider-room').css("display","block");
            }
            else if($('.room-divide2').is(":visible")){
                roomVal = 2;
                $('.add-room').css("display","block");
                $('.divider-room').css("display","none");
                $('.remove-room').css("display","none");
				$('.horizontal-line').remove();
            }
            $('.room-divide'+roomVal).remove();
			selectDateScroll('remove', roomVal);
        });

        /*drop down selection for children ages*/
        $("#child-input-1").on('change', function(event){
			ga('send', 'event', 'hotel-card', 'orbot-select', 'children', {1:this.value});
			roomChildVal(1, this.value);
		});

    });

    $(document).on('click', '.close-select-dates', function (){
        $('.select-dates').remove();
        $("#overlay").remove();
    });

	/*on click '.cancel-function' class close the popup */
	$(document).on('click','.cancel-action',function(){
		$(".modal-wrapper").remove();
		$("#overlay").remove();
        Deals.displayWhenGo(true);
	});

    $(document).on('click', '.no-hotel-orbot, .modal-row-button', function(e) {


        if (Deals.orbotValidation() == false) {
            return false;
        }

        e.preventDefault();
        var rooms = '', orbotTempVal = $('.orbot-select-rooms').parent().prev().children(':last-child').attr('data-row');
        for(var i=0; i< orbotTempVal; i++) {

            rooms += '&hotel.rooms%5B'+i+'%5D.adlts='+$('.orb-adults-'+i).val();
            var chLen = $('.orb-child-'+i).val();
            if (chLen > 0) {
                rooms += '&hotel.rooms%5B'+i+'%5D.chlds='+chLen;
                for (var j = 1; j <= chLen; j++) {
                    rooms += '&hotel.rooms%5B'+i+'%5D.chldAge%5B'+(j-1)+'%5D='+$('.orb-child-age-'+i+'-'+j).val();
                }
            }
        }

        var checkIn  = $('#check-in').val(),
            checkOut = $('#check-out').val(),
            hotelName = $('.search-hotel-name').val() == 'e.g. Sydney Hilton' ? '' : $('.search-hotel-name').val(),
            promo = ($(".search-promo-code").val() == $(".search-promo-code").attr('data-value')) ? '' : $.trim($(".search-promo-code").val()),
            local = locale,
            cityName = $('.robot-city-name').val();

        var searchUrl = "//www.hotelclub.com/shop/hotelsearch?type=hotel&hotel.couponCode="
        + promo
        + "&locale="
        + local
        + "&hotel.hname="
        + hotelName
        + "&hotel.type=keyword&hotel.chkin="
        + checkIn
        + "&hotel.chkout="
        + checkOut
       // + "&hotel.rooms[0].adlts=2"
        + "&hotel.keyword.key="
        + cityName
        + "&search=Search"
        + rooms;

        ga('send', 'event', 'search-bar', 'orbot-select', 'search-click');
        window.open(searchUrl, '_blank');
    });

    $(document).on('click','.sort-box-price, .sort-box-name, .sort-box-rating, .sort-box-picks', function(e) {

        e.preventDefault(); // prevent default option

        var self = $(this),
            order = self.attr('data-order'),
            type = '',
            typeIcon = '',
            desIcon = ' &or;',
            ascIcon = ' &and;';
        $('.sort-button').css({'font-weight': 'normal','color':'#a1a1a1'});
        // Because our picks cannot be re-sorted
        if (self.data('sort') == 'ourPicks')
            type = 'des';
        else if (order == 'des')
            type = 'asc';
        else if (order == 'asc')
            type = 'des';

        else
            type = 'asc';

        typeIcon = type == 'asc' ? ascIcon : desIcon;

        var tName = ''
        if ($(this).data('sort') == 'price' || $(this).data('sort') == 'rating') {
            tName = (type == 'asc') ? 'lowest' : 'highest';
        } else if ($(this).data('sort') == 'name') {
            tName = (type == 'asc') ? 'A-Z' : 'Z-A';
        }

        if ($(this).data('sort') == 'ourPicks') {

            Deals.sortByNumber('sortOrder', type);
            ga('send', 'event', 'sort', 'sort-picks-activate', '');

        } else if ($(this).data('sort') == 'price') {

            Deals.sortByNumber('price', type);
            ga('send', 'event', 'sort', 'sort-price-activate', '');

        } else if ($(this).data('sort') == 'name') {

            Deals.sortByText('hotelNameUtf8', type);
            ga('send', 'event', 'sort', 'sort-name-activate', '');

        } else if ($(this).data('sort') == 'rating') {

            Deals.sortByNumber('starRatingiu', type);
            ga('send', 'event', 'sort', 'sort-rating-activate', '');
        }

        $('.sort-indicator-image').remove();

        if ($(this).data('sort') != 'ourPicks') {
            self.append('<span class="sort-indicator-image">' + typeIcon + '</span>');
            ga('send', 'event', 'sort', 'sort-'+$(this).data('sort')+'-select', tName);
        }
        self.css({'font-weight': 'bold', 'color':'#333'});
        self.attr('data-order', type)

        //var url = window.location.origin + '/' + MNME + '/' + Deals.city + '/' + Deals.when + '?sort='+$(this).data('sort')+'&type='+type;
        var host = window.location.protocol +'//'+ window.location.hostname,
            url = host + '/' + MNME + '/' + Deals.city + '/' + Deals.when + '?sort='+$(this).data('sort')+'&type='+type;
        //console.log(url);
        if ( url !== window.location.href ) {
            manualState = false;
            History.pushState({url: url}, Deals.city + ' Hotels', url);
        }

    });

    $(document).on('focus', '.search-hotel-name', function() {

        if ($(this).val() == $(this).attr('data-value')) {
            $(this).val('');
        }
    });

    $(document).on('blur', '.search-hotel-name', function() {

        if ($(this).val() == '') {
            $(this).val($(this).attr('data-value'));
        }
		ga('send', 'event', 'search-bar', 'orbot-select', 'promo-code', $(this).val());
   });

    $(document).on('focus', '.search-promo-code', function() {

        if ($(this).val() == $(this).attr('data-value')) {
            $(this).val('');
        }
    });

    $(document).on('blur', '.search-promo-code', function() {

        if ($(this).val() == '') {
            $(this).val($(this).attr('data-value'));
        }
		ga('send', 'event', 'search-bar', 'orbot-select', 'promo-code', $(this).val());
    });

    $(document).on('click', '.region-explore-dest', function() {

        $('html,body').animate({
                scrollTop: $("#region-card-promo-" + $(this).attr('data-value')).offset().top },
            'slow');
    });

	/*function to calculate and display the date difference*/
	function dateCalculate(){
		var fromDate = $("#select-check-in").datepicker('getDate');
		var toDate = $("#select-check-out").datepicker('getDate');
		// date difference in millisec
		if(fromDate&&toDate){
			var diff = new Date(toDate - fromDate);
			// date difference in days
			var days = diff/1000/60/60/24;
			//console.log(days);
			$('.select-dates-display').val(days);
		}
	}//dateCalculate

	/*function to create a number of children ages based on room selected*/
	function roomChildVal(roomChild, roomChildVal){
		console.log(roomChild, roomChildVal);
		if(roomChildVal>=1){
			$('.roomVal-'+roomChild).remove();
			$(".room-"+roomChild).css("display","block");
			var cntVal, i;
			cntVal = '<div class="roomVal-'+roomChild+'"><div class="select-date-ages-label">*' + Deals.t('ages_of_children_at_time_of_trip_note') + '</div>';
			for(i=1;i<=roomChildVal;i++){
				cntVal+="<select name='room-"+roomChild+"-child-"+i+"' class='select-dates-input child-room' id='room-"+roomChild+"-child-"+i+"'><option value='00'><1</option><option value='01'>1</option><option>2</option><option>3</option><option>4</option> <option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option></select>";
			}
			cntVal+="<div>";
			$(".room-"+roomChild).append(cntVal).html();
		}else{
			$('.roomVal-'+roomChild).remove();
		}
	}//roomChildVal

	/*overfolow for select dates exceeds more than 3 rooms*/

    /** decide thi sis UAT **/
	function selectDateScroll(roomAction, roomVal){
        var thisHeight = $('.room-divide1').css('height');
		var selectHeight = $('.room-divide1').height();
		if(roomAction=='add'&&roomVal>2){
			$('.room-divide1').css({
				'height': thisHeight,
				'overflow-y': 'scroll'
			});
		}else if(roomAction=='remove'&&roomVal<3){
			$('.select-dates').attr('style','height:auto;position:fixed;top:6%;left:34%;display:block;z-index:999');
            $('.room-divide1').css({
                'height': 'auto'
            });
		}
	}//selectDateScroll

	/** overflow for exact date is more than 3 room **/
	function selectExactDateScroll(roomAction, roomVal){
		if(roomAction=='add'&&roomVal>2){
			$('.modal-row-height').css({
				'height': '250px',
				'overflow-y': 'scroll',
				'padding': '20px 10px'
			});
		}else if(roomAction=='remove'&&roomVal<3){
			$('.modal-row-height').css({
				'height': 'auto',
				'overflow-y': 'hidden'
			});
		}
	}//selectExactDateScroll

    function getParameterByName(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }

    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        }
        else {
            return uri + separator + key + "=" + value;
        }
    }

    $(document).ready(function(){

        $('#breadcrumb-home').on('click', function(e) {
            e.preventDefault();
            ga('send', 'event', 'header', 'sign-in', '');
            window.location.href = $(this).attr('href');
        });

        //sign in
        $('#sign-in').on('click', function(e) {
            e.preventDefault();
            ga('send', 'event', 'header', 'sign-in', '');
            window.location.href = $(this).attr('href');
        });

        $('#register').on('click', function(e) {
            e.preventDefault();
            ga('send', 'event', 'header', 'join', '');
            window.location.href = $(this).attr('href');
        });

        $('.dropdown-region').on('focus', function() {
            ga('send', 'event', 'search-bar', 'region-activate', '');
        });

        $('.dropdown-cities').on('focus', function() {
            ga('send', 'event', 'search-bar', 'destination-activate', '');
        });

        $('.dropWhereDo').on('focus', function() {
            ga('send', 'event', 'search-bar', 'date.range-activate', '');
        });

        $('#mid-year-sale-logo').on('focus', function(e) {
            e.preventDefault();
            ga('send', 'event', '?', 'link-click', 'landing-page');
            window.location.href = $(this).attr('href');
        });
    });

    $(document).on('click', '.sign-out', function(e) {
        e.preventDefault();
        ga('send', 'event', 'header', 'sign-out', '');
        window.location.href = $(this).attr('href');
    });

    $(document).on('click', '#my-bookings', function(e) {
        e.preventDefault();
        ga('send', 'event', 'header', 'link-click', '');
        window.location.href = $(this).attr('href');
    });

    $(document).on('click', '#my-club', function(e) {
        e.preventDefault();
        ga('send', 'event', 'header', 'link-click', '');
        window.location.href = $(this).attr('href');
    });

    $(document).on('click', '#my-account', function(e) {
        e.preventDefault();
        ga('send', 'event', 'header', 'link-click', '');
        window.location.href = $(this).attr('href');
    });

    $(document).on('click', '#custormer-searvice', function(e) {
        e.preventDefault();
        ga('send', 'event', 'header', 'link-click', '');
        window.location.href = $(this).attr('href');
    });

    $(document).on('click', '.hotel-thumb-image', function(e) {
        e.preventDefault();
        ga('send', 'event', 'hotel-card', 'image-click', $(this).children().attr('title'));
        window.open($(this).attr('href'), '_blank');
    });

    $(document).on('click', '#hotel-property-name', function(e) {
        e.preventDefault();
        ga('send', 'event', 'hotel-card', 'property-name-click', $(this).val());
        window.open($(this).attr('href'), '_blank');
    });

    $(document).on('click', '.social-media-link', function(e) {
        e.preventDefault();
        ga('send', 'event', 'footer', 'social-click', $(this).attr('title'));
        window.open($(this).attr('href'), '_blank');
    });

    $(document).on('click', '.footer-destination-link', function(e) {
        e.preventDefault();
        ga('send', 'event', 'footer', 'link-click',  $(this).val());
        window.location.href = $(this).attr('href');
    });




})(jQuery, Handlebars);