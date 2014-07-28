{% for label,uri in menuItemsTop %}
    <li><a rel="nofollow" class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
{% endfor %}