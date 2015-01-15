<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    {{ get_title() }}
    {{ stylesheet_link("http://yui.yahooapis.com/2.9.0/build/reset-fonts-grids/reset-fonts-grids.css",false) }}
    {{ stylesheet_link("http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/blitzer/jquery-ui.min.css", false) }}
    {{ stylesheet_link("http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css",false) }}
    {{ stylesheet_link('themes/travel-insurance/css/ti.css?' ~ appVersion ) }}


    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Book now and save up to 50% off hotels with HotelClub.com. Earn HotelClub Member Rewards. Fresh Accommodation Deals 24x7!" name="description">
    <meta content="travel,insurance,quote" name="keywords">
    <meta content="INDEX,FOLLOW" name="robots">
</head>
<body>
{{ content() }}
{{ javascript_include("http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js", false) }}
{{ javascript_include("http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js", false) }}
{{ javascript_include("http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js", false) }}
{{ javascript_include('themes/travel-insurance/js/ti.js?' ~ appVersion ) }}

{{ partial('partials/footer/tracking') }}
</body>
</html>
