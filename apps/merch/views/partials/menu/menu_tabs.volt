{% for tab in DDMenue %}
<li class="dropdown-submenu level1">
<a tabindex="-1" href="{{ uriBase }}/{{ tab['name'] }}">{{ tab['name'] }} <b class="caret"></b> </a>
{% if not(tab is empty) %}
	<ul class="dropdown-menu level2">
	{% for tabSub in tab %}
	{% if isArray(tabSub) %}
	<li class="dropdown-submenu" >
	<a tabindex="-1" href="{{ uriBase }}/{{ tab['name'] }}/{{ tabSub['name']  }}">{{ tabSub['name'] }} <b class="right-caret"></b></a>
	{% if not(tabSub is empty) %}
		<ul class="dropdown-menu level3">
		{% for tabSubmenu in tabSub %}
		{% if isArray(tabSubmenu) %}
		<li class="dropdown-submenu">
		<a tabindex="-1" href="{{ uriBase }}/{{ tab['name'] }}/{{ tabSub['name']  }}/{{ tabSubmenu['name']  }}">{{ tabSubmenu['name'] }} </a>
		</li>
		<li class="divider"></li>
		{% endif %}
		{% endfor %}
		</ul> 
	{% endif %}
	</li>
	<li class="divider"></li>
	{% endif %}
	{% endfor %}
	</ul> 
{% endif %}
</li>
{% endfor %}
