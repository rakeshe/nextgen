{# DEVELOPMENT ENVIRONMENT SETTINGS #}
{# STAGING LINKS #}
{% set  AllianzPricingGateway = "http://213.41.31.43:8080/gateway/pricing" %}
{% set AllianzPurchasingGatewayForAU="http://staging.magroup-online.com/mawl/inside/htc/au?restart=1" %}
{% set AllianzPurchasingGatewayForNZ="http://staging.magroup-online.com/mawl/inside/htc/nz?restart=1" %}

{# LIVE LINKS      
{% set AllianzPricingGateway =  "https://www.magroup-webservice.com/gateway/pricing" %}
{% set AllianzPurchasingGatewayForAU = "https://www.magroup-online.com/htc/au?restart=1" %}
{% set AllianzPurchasingGatewayForNZ = "https://www.magroup-online.com/htc/nz?restart=1" %}
#}
           
{# INITIALIZE VARIABLES #}
{% set debugLevel=0 %}
{% set stopat=0 %}
{% set TracedInfo="" %}
{% set m1="" %}
{% set m2="" %}
{% set m3="" %}
{% set kt1="" %}
{% set kt2="" %}
{% set kt3="" %}
{% set dispcheck="" %}
{% set hAdult=1 %}
{% set strdisp="" %}
{% set strdispchk="" %}
{% set hDestLoc="" %}
{# hmcheck="" #}
{% set hmultiDest="" %}
{% set requestedForQuote=false %}
{% set validQuoteReceived=false %}
{% set proceedForPurchase=false %}
{% set SelectedProduct="" %}
{% set SelectedProductID="" %}
{% set SelectedProductPrice=0 %}
{% set SelectedProductLabel="" %}
{% set makeArrayVB= [] %}

{# SET Translation TO DEFAULT EN AU #}
{% set Locale="en_AU" %}
{% set curr="AUD" %}
{% set PromoName="aga" %}
{% set ActualLanguageCode="EN" %}
{% set showContactUs=false %}
{% set initialSearchPage=true %}

{# ************** DEBUGGIN ***********************
{% debugLevel= ReadFormData("debugLevel") %}
{% if debugLevel == "" %}
  {% debugLevel=0 %}
 {% endif %}
{% stopat = ReadFormData("stopat") %} 
{% if stopat == "") %}
  {% stopat=0; %}
 {% endif #}

/********************************************************/

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
   	{{ stylesheet_link('/yui.yahooapis.com/2.9.0/build/reset-fonts-grids/reset-fonts-grids.css') }}
	{{ stylesheet_link('/ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/blitzer/jquery-ui.min.css') }}
	{{ stylesheet_link('css/main.css') }}
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="Book now and save up to 50% off hotels with HotelClub.com. Earn HotelClub Member Rewards. Fresh Accommodation Deals 24x7!" name="description">
<meta content="travel,insurance,quote" name="keywords">
<meta content="INDEX,FOLLOW" name="robots">	
    </head>
    <body>
        {{ content() }}
	{{ javascript_include('/ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
        {{ javascript_include('/ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js') }}
        {{ javascript_include('/ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js') }}
        {{ javascript_include('js/spin-1.2.7-min.js') }}
        {{ javascript_include('js/main.js') }}
	{{ javascript_include('js/agaModel-4.0.0.js') }}	
	{{ javascript_include('js/webtrends.js') }}
    </body>
</html>
