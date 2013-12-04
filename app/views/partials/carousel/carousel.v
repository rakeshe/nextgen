<!-- carousel -->
<div id="dkt_carousel" class="carousel slide" data-ride="carousel" data-interval="2500">
    <ol class="carousel-indicators">
        {% for index, banner in pageData['banners'] %}
            <li data-target="#dkt_carousel" data-slide-to="{{ index }}"></li>
        {% endfor %}
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        {% for index, banner in pageData['banners'] %}
            {% if not(banner['img'] is empty) %}
                {% if index == 0 %}
                    {% set item_class = ' active' %}
                {% else %}
                    {% set item_class = '' %}
                {% endif %}
                <div class="item{{ item_class }}">
                    <img src="{{ banner['img'] }}" alt="Member" />
                    <div class="row">
                        <div class="carousel-caption hidden-phone">
                            <h2>{{ banner['h1'] }}</h2>
                            <h3>{{ banner['h2'] }} </h3>
                            <h5>{{ banner['promo'] }}</h5>
                            <h6>{{ banner['terms'] }}<h6>
                        </div>
                    </div>
                </div>
            {% endif %}
        {% endfor %}
    </div>
</div>
<!-- carousel -->