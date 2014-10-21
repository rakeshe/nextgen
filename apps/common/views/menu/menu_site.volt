<!-- main menu -->
<div class="col-md-6">
    <ul id="header_menu_hc" class="left_menu">
        {% if not empty(menuItemsSite) %}
            {% for label,uri in menuItemsSite %}
                <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
            {% endfor %}
        {% endif %}
    </ul>
</div>