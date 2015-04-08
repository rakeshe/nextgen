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

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    {{ stylesheet_link('themes/' ~ theme ~ '/css/desktop.css?' ~ appVersion ) }}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

{% if scope == 'full' %}

</head>
<body>

{% endif %}

<!--<img src="images/Slider.jpg" />-->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

        <div class="item active">
            <img src="images/banner.png" alt="Chania">
            <div class="carousel-caption"><div class="open_quote">“</div><div class="carousel-heading-content">I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture.</div><div class="close_quote">”</div>
                <p class="carousel-normal-text">Phillip, Sydney</p>
            </div>
        </div>

        <div class="item">
            <img src="images/banner.png" alt="Chania">
            <div class="carousel-caption"><div class="open_quote">“</div><div class="carousel-heading-content">I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture.</div><div class="close_quote">”</div>
                <p class="carousel-normal-text">Phillip, Sydney</p>
            </div>
        </div>

        <div class="item">
            <img src="images/banner.png" alt="Chania">
            <div class="carousel-caption"><div class="open_quote">“</div><div class="carousel-heading-content">I came to run the NY marathon and to my great surprise, I was upgraded to a luxurious double room. A million thanks for this very nice gesture.</div><div class="close_quote">”</div>
                <p class="carousel-normal-text">Phillip, Sydney</p>
            </div>
        </div>

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
        <img src="images/left-arrow.png" class="left_arrow_image" width="20" height="40"/>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
        <img src="images/right-arrow.png" class="right_arrow_image" width="20" height="40"/>
        <span class="sr-only">Next</span>
    </a>
</div>
</body>

{% if scope == 'full' %}
</html>
{% endif %}