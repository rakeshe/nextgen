{% for tab in DDMenue %}
<li class="dropdown-submenu level1">
<a tabindex="-1" href="{{ uriBase }}/{{ tab['name'] }}">{{ tab['name'] }}</a>
{% if not(tab is empty) %}
<ul class="dropdown-menu level2">
{% for tabSub in tab %}
{% if isArray(tabSub) %}
<li>
<a tabindex="-1" href="/{{ uriBase }}/{{ tabSub['name']  }}">{{ tabSub['name'] }}</a>
</li>
<li class="divider"></li>
{% endif %}
{% endfor %}
</ul> 
{% endif %}
</li>
{% endfor %}
