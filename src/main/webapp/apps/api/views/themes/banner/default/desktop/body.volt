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
    {{ stylesheet_link(protocal ~ serverName ~ '/n/themes/' ~ theme ~ '/css/desktop.css?' ~ appVersion ) }}
    <script src="{{ protocol }}ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ protocol }}maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

{% if scope == 'full' %}

</head>
<body>

{% endif %}

<!--<img src="images/Slider.jpg" />-->
<div id="myCarousel" class="carousel slide" data-ride="carousel">


    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        {% if isset(data['banners']) %}
        {% set activeFlag=false %}
        {% set BannerCount = 0 %}
        {% for key, val in data['banners'] %}

            <div class="item {% if activeFlag == false %}active{% set activeFlag=true %}{% endif %}">
                {% if device == 'mobile' %}
                    <img src="{{ val['url_mobile'] }}" alt="{{ val['image_name'] }}">
                {% elseif device == 'tablet' %}
                    <img src="{{ val['url_tablet'] }}" alt="{{ val['image_name'] }}">
                {% else %}
                    <img src="{{ val['url_desktop'] }}" alt="{{ val['image_name'] }}">
                {% endif %}

                <div class="carousel-caption">
                    <div class="open_quote">“</div>
                    <div class="carousel-heading-content">
                        {{ val['h1'] }}
                    </div>
                    <div class="close_quote">”</div>
                    <p class="carousel-normal-text">
                        {{ val['h3'] }}
                    </p>
                </div>
            </div>
        {% set BannerCount = BannerCount + 1 %}
        {% endfor %}
        {% endif %}
    </div>

    <!-- Indicators -->
    {% set activeFlag=false %}
    <ol class="carousel-indicators">
        {% for key, index in 1..BannerCount %}
            <li data-target="#myCarousel" data-slide-to="{{ key }}" class="{% if activeFlag == false %}active{% set activeFlag=true %}{% endif %}"></li>
        {% endfor %}
    </ol>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
        <img src="{{ protocol }}{{ serverName }}/n/themes/{{theme}}/img/left-arrow.png" class="left_arrow_image" width="20" height="40"/>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
        <img src="{{ protocol }}{{ serverName }}/n/themes/{{theme}}/img/right-arrow.png" class="right_arrow_image" width="20" height="40"/>
        <span class="sr-only">Next</span>
    </a>
</div>
</body>

{% if scope == 'full' %}
</html>
{% endif %}