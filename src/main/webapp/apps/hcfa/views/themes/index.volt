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
        <meta name="description" content="HotelClub for agents incentive program">
        <meta name="author" content="HotelClub">

        <!-- Mobile Specific Metas
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <meta name="viewport" content="width=device-width, initial-scale=1">


        {{ stylesheet_link('themes/hcfa/css/normalize.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/hcfa/css/skeleton.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/hcfa/css/brand.css?' ~ appVersion ) }}
        {{ stylesheet_link('themes/hcfa/css/font.css?' ~ appVersion ) }}

        <link rel="icon" type="image/png" href="images/assets/favicon.png">
    </head>
    <body>

        {{ content() }}

        {{ partial(theme ~ '/partials/header') }}
        {{ partial(theme ~ '/partials/body') }}
        {{ partial(theme ~ '/partials/footer') }}
    </body>
</html>
