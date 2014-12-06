<!-- carousel -->
<div id="dkt_carousel" class="carousel slide" data-ride="carousel" data-interval="2500">
    <ol class="carousel-indicators">
        {% for index, banner in banners %}
            <li data-target="#dkt_carousel" data-slide-to="{{ banner['h1'] }}"></li>
        {% endfor %}
    </ol>
    <!-- Carousel items -->
    <div class="carousel-inner">
        {% for index, banner in banners %}       
            {% if not(banner['img'] is empty) %}
            
                {% if index == 0 %}
                    {% set item_class = ' active' %}
                {% else %}
                    {% set item_class = '' %}
                {% endif %}
                <div class="item{{ item_class }}">
                    <img src="/n/themes/common/{{ banner['img'] }}" alt="Member" />
                     <div class="row">
	                  <div class="">
	                        <div class="carousel-caption ">
					<div class="deal_text1">{{ banner['h1'] }}</div><br/>
					<div class="deal_text2">{{ banner['h2'] }}</div><br/>
					{% if banner['promo'] is not '' %} <div class="deal_text5">{{ banner['promo'] }}</div> <br/> {% endif %}
					{% if banner['terms'] is not '' %} <div class="deal_text6">{{ banner['terms'] }}</div><br/> {% endif %}
	                        </div>
	                     </div>
                    </div>
                </div>
            {% endif %}
        {% endfor %}
    </div>
</div>
<!-- carousel -->