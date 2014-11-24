<!-- main menu -->
<div class="col-md-6">
    <ul id="header_menu_hc" class="left_menu">
        {% if not empty(menuItemsSite) %}

        {% if languageCode == 'en_AU' %}

            {% for label,uri in menuItemsSite %}
                <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
             {% endfor %}
        {%else%}

            {% for label,uri in menuItemsSite %}
                {% if label != 'menu_travel_insurance' %}
                     <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
                {%endif%}
            {% endfor %}

        {%endif%}
        
        {% endif %}
    </ul>
</div>