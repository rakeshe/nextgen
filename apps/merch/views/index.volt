<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {# stylesheet_link('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') #}
		{{ stylesheet_link('bootstrap3.0/css/bootstrap.min.css') }}
        {{ stylesheet_link('css/merch.css') }}
        {{ stylesheet_link('/ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/blitzer/jquery-ui.min.css') }}  
		{{ stylesheet_link(' https://rawgithub.com/scottjehl/Respond/master/cross-domain/respond-proxy.html') }} 		
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Great hotel deals, no booking fees & member rewards. Cheap hotels in over 74,000 hotels worldwide. Get more from your holiday. Join us at hotelclub.com.">
        <meta name="author" content="hotel, club, hotelclub, hotelclub.net, hotels, reservation, reservations, accomodation, accomodations, rooms, lodging, service, rates, hotels, discounts, cheap, online, travel, booking, information, resorts">
    </head>
    <body>
        {{ content() }}
        {{ javascript_include('//google.com/jsapi') }}
        {{ javascript_include('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js') }}   
        {{ javascript_include('/ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js') }}   
        {# javascript_include('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') #}
		{{ javascript_include('bootstrap3.0/js/bootstrap.min.js') }}		
        {{ javascript_include('js/utils.js') }}
        {{ javascript_include('js/nextgen.js') }}   
		{{ javascript_include('js/respond.src.js') }}		
    </body>
</html>
