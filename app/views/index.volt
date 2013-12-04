<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('bootstrap/css/bootstrap-responsive.css') }}
        {{ stylesheet_link('bootstrap/css/bootstrap.css') }}
        {{ stylesheet_link('css/' ~ pageLayout ~ '.css') }}
        {{ stylesheet_link('css/common-ui.css') }}
        {{ stylesheet_link('css/jquery-ui.min.css') }}
        {#{{ stylesheet_link('css/hc_great_holidays.css') }}#}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Great hotel deals, no booking fees & member rewards. Cheap hotels in over 74,000 hotels worldwide. Get more from your holiday. Join us at hotelclub.com.">
        <meta name="author" content="hotel, club, hotelclub, hotelclub.net, hotels, reservation, reservations, accomodation, accomodations, rooms, lodging, service, rates, hotels, discounts, cheap, online, travel, booking, information, resorts">
    </head>
    <body>
        {{ content() }}
        {{ javascript_include('js/jquery.js') }}
        {{ javascript_include('js/jquery-ui-1.10.3.min.js') }}
        {{ javascript_include('bootstrap/js/bootstrap.min.js') }}
        {{ javascript_include('js/utils.js') }}
        {{ javascript_include('js/nextgen.js') }}
        {{ javascript_include('js/jquery.ui.datepicker-en_AU.js') }}
    </body>
</html>