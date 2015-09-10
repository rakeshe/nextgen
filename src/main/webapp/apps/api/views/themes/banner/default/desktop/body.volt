{#
check if scope is full or partial

if scope is partial return only body (<body>) part

#}
{% if scope == 'full' %}

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>

{% elseif scope == 'partial' %}
    <body>
{% endif %}

    <link rel="stylesheet" href="{{ protocol }}maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!--<link rel="stylesheet" href="{{ protocol }}myhotelclub.website/css/desktop.css">-->
    {{ stylesheet_link('themes/' ~ theme ~ '/css/desktop.css?' ~ appVersion ) }}
    <script src="{{ protocol }}ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ protocol }}maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

{% if scope == 'full' %}

</head>
<body>

{% endif %}

<!--<img src="images/Slider.jpg" />-->
<div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: {{ width }}px; height: {{ height }}px">


    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        {% if isset(data['items'][locale]) %}
        {% set activeFlag=false %}
        {% set BannerCount = 0 %}
        {% for key, val in data['items'][locale] %}

            <div class="item {% if activeFlag == false %}active{% set activeFlag=true %}{% endif %}">
                <a href="{{ val['target_url'] }}" target="_blank">
                {% if device == 'mobile' %}
                    <img src="{{ val['url_mobile'] }}" alt="{{ val['tags'] }}">
                {% elseif device == 'tablet' %}
                    <img src="{{ val['url_tablet'] }}" alt="{{ val['tags'] }}">
                {% else %}
                    <img src="{{ val['url_desktop'] }}" alt="{{ val['tags'] }}">
                {% endif %}
                </a>
                {% if not(val['h1'] is empty) %}
                <div class="carousel-caption">

                    <div class="carousel-heading-content">
                        {% if caption_quote == '1' %}<div class="open_quote">{{ quoteOpenChar }}</div>{% endif %}
                        {{ val['h1'] }}
                        {% if caption_quote == '1' %}<div class="close_quote">{{ quoteCloseChar }}</div>{% endif %}
                    </div>
                    <p class="carousel-normal-text">
                        {{ val['h3'] }}
                    </p>
                </div>
                {% endif %}
            </div>
        {% set BannerCount = BannerCount + 1 %}
        {% endfor %}
        {% endif %}
    </div>

    <!-- Indicators -->
    {% if nav_dots == '1' %}
    {% set activeFlag=false %}
    <ol class="carousel-indicators {{ pos_nav_dots }} ">
        {% for key, index in 1..BannerCount %}
            <li data-target="#myCarousel" data-slide-to="{{ key }}" class="{% if activeFlag == false %}active{% set activeFlag=true %}{% endif %}"></li>
        {% endfor %}
    </ol>
    {% endif %}

    <!-- Left and right controls -->
    {% if nav_arrows == '1' %}
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
        <img src="/n/themes/{{theme}}/img/left-arrow.png" class="left_arrow_image" width="20" height="40"/>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
        <img src="/n/themes/{{theme}}/img/right-arrow.png" class="right_arrow_image" width="20" height="40"/>
        <span class="sr-only">Next</span>
    </a>
    {% endif %}
</div>
</body>

{% if scope == 'full' %}
</html>
{% endif %}