<!-- main menu -->
<div class="col-md-6">
    <ul class="left_menu">
        {% for label,uri in menuItemsSite %}
            <li><a class="link" href="{{ uri }}">{{ t._(label) }}</a></li>
        {% endfor %}
    </ul>
</div>