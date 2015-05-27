{% if appVersion is not defined %}
    {% set appVersion = '1.0.0' %}
{% endif %}

{% if theme is not defined %}
{% set theme = 'default' %}
{% endif %}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('themes/deals/css/normalize.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/deals/css/skeleton.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/deals/css/hc.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/deals/css/font.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/deals/css/flags.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/deals/css/jquery-ui.css?' ~ appVersion ) }}

        <link rel="icon" type="image/png" href="images/assets/favicon.png">

      {#  {{ javascript_include('themes/deals/js/modernizr.custom.79639.js?' ~ appVersion ) }} #}


        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="/favicon.ico" />
        <meta name="robots" content="noindex, nofollow">
        <meta name="description" content="Great hotel deals, no booking fees & member rewards. Cheap hotels in over 74,000 hotels worldwide. Get more from your holiday. Join us at hotelclub.com.">
        <meta name="author" content="hotel, club, hotelclub, hotelclub.net, hotels, reservation, reservations, accomodation, accomodations, rooms, lodging, service, rates, hotels, discounts, cheap, online, travel, booking, information, resorts">
    </head>
    <body>
        {{ content() }}

        {{ partial(theme ~ '/partials/header') }}
        {{ partial(theme ~ '/partials/robot') }}
        {{ partial(theme ~ '/partials/sort') }}
        {{ partial(theme ~ '/partials/filter') }}
        {{ partial(theme ~ '/partials/hotelCard') }}
        {{ partial(theme ~ '/partials/upsell') }}
        {{ partial(theme ~ '/partials/regionHotelCard') }}
        {{ partial(theme ~ '/partials/footer') }}

        {{ javascript_include('themes/deals/js/jquery.js?' ~ appVersion ) }}
        {{ javascript_include('themes/deals/js/jquery-ui.js?' ~ appVersion ) }}
        {{ javascript_include('themes/deals/js/handlebars-v3.0.3.js?' ~ appVersion ) }}
        {{ javascript_include('vendor/lazy-load/jquery.lazyload.js?' ~ appVersion ) }}
        {{ javascript_include('themes/deals/js/deals.js?' ~ appVersion ) }}
        <script>
            $( "#slider" ).slider({
                range: true,
                values: [ 1, 100 ]
            });
            $( "#slider2" ).slider({
                range: true,
                values: [ 1, 100 ]
            });
         </script>
    </body>
</html>