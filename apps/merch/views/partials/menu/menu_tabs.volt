{% for tab in pageData['hotels'] %}
<li class="dropdown-submenu level1">
<a tabindex="-1" href="/{{ lncode }}/{{ campaignName }}/{{ tab['name'] }}">{{ tab['name'] }}</a>
{% if not(tab['hotels'] is empty) %}
<ul class="dropdown-menu level2">
{% for tabSub in tab['hotels'] %}
<li>
<a tabindex="-1" href="/{{ lncode }}/{{ campaignName }}/{{ tab['name'] }}//{{ tabSub['name']  }}">{{ tabSub['name'] }}</a>
</li>
<li class="divider"></li>
{% endfor %}
</ul>
{% endif %}
</li>
{% endfor %}
