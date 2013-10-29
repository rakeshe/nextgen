<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('bootstrap/css/bootstrap.css') }}
        {{ stylesheet_link('bootstrap/css/bootstrap-responsive.css') }}
        {{ stylesheet_link('css/style.css') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Great hotel deals, no booking fees & member rewards. Cheap hotels in over 74,000 hotels worldwide. Get more from your holiday. Join us at hotelclub.com." />
        <meta name="keywords" content="hotel, club, hotelclub, hotelclub.net, hotels, reservation, reservations, accomodation, accomodations, rooms, lodging, service, rates, hotels, discounts, cheap, online, travel, booking, information, resorts" />

    </head>
    <body>
        {{ content() }}
        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('bootstrap/js/bootstrap.js') }}
        {{ javascript_include('js/utils.js') }}
    </body>
</html>