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
<!-- /Carousel -->
{#
<!-- carousel -->
<div id="dkt_carousel" class="carousel slide" data-ride="carousel" data-interval="2500">
    <ol class="carousel-indicators">
        <li data-target="#dkt_carousel" data-slide-to="0" class="active"></li>
        <li data-target="#dkt_carousel" data-slide-to="1"></li>
        <li data-target="#dkt_carousel" data-slide-to="2"></li>
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        <div class="item active">
            <img src="/img/carousel_item1.png" alt="Member"/>
            <div class="row">
                <div class="carousel-caption hidden-phone ">
                    <h2>Great Holiday Sale ----</h2>
                    <h3>Save Upto 50% of hotels </h3>
                    <h5>Plus Get Up to 7% Member Rewards</h5>
                    <h6>* conditions apply<h6>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="/img/carousel_item2.png" alt="Member"/>
            <div class="row">
                <div class="carousel-caption hidden-phone ">
                    <h2>Great Holiday Sale ----</h2>
                    <h3>Save Upto 50% of hotels </h3>
                    <h5>Plus Get Up to 7% Member Rewards</h5>
                    <h6>* conditions apply<h6>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="/img/carousel_item3.png" alt="Member"/>
            <div class="row">
                <div class="carousel-caption hidden-phone ">
                    <h2>Great Holiday Sale ----</h2>
                    <h3>Save Upto 50% of hotels </h3>
                    <h5>Plus Get Up to 7% Member Rewards</h5>
                    <h6>* conditions apply<h6>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="/img/carousel_item4.png" alt="Member"/>
            <div class="row">
                <div class="carousel-caption hidden-phone ">
                    <h2>Great Holiday Sale ----</h2>
                    <h3>Save Upto 50% of hotels </h3>
                    <h5>Plus Get Up to 7% Member Rewards</h5>
                    <h6>* conditions apply<h6>
                </div>
            </div>
        </div>
        <div class="item">
            <img src="/img/carousel_item5.png" alt="Member"/>
            <div class="row">
                <div class="carousel-caption hidden-phone ">
                    <h2>Great Holiday Sale ----</h2>
                    <h3>Save Upto 50% of hotels </h3>
                    <h5>Plus Get Up to 7% Member Rewards</h5>
                    <h6>* conditions apply<h6>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Carousel -->#}
<!-- carousel -->
