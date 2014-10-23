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
                    <img src="{{ banner['img'] }}" alt="Member" />
                     <div class="row">
	                  <div class="">
	                        <div class="carousel-caption ">
					<div class="deal_text1">{{ banner['h1'] }}</div><br/>
					<div class="deal_text2">{{ banner['h2'] }}</div><br/>
					{% if banner['promo'] is not empty %} <div class="deal_text5">{{ banner['promo'] }}</div> <br/> {% endif %}
					<div class="deal_text6">{{ banner['terms'] }}</div><br/>
	                        </div>
	                     </div>
                    </div>
		    {# <div class="visible-xs">
		    	<div class="row">
                        <div class="carousel-caption ">
				<div  class="deal_text1"><span>{{ banner['h1'] }}</span></div>
				<div  class="deal_text2"><span>{{ banner['h2'] }} </span></div>
				<div  class="promo_text"><span>{{ banner['promo'] }}</span></div>
				<div  class="terms"><span>{{ banner['terms'] }}</span></div>
                        </div>
                       </div>
                    </div> #}
                </div>
            {% endif %}
        {% endfor %}
    </div>
</div>
<!-- carousel -->