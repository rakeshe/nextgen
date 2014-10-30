<script>var availCountry = [], transRegions = {};</script>
{% if region is not defined %}
{% set region = "" %}
{% endif %}
{% for tab in DDMenue %}
<li class="dropdown-submenu {%if tab['name'] == region %}levelActive{% else %}level1{%endif%}">
<a class="menu-icons menu-region" tabindex="-1" data-en-value="{{ tab['name_en'] }}" href="{{ uriBase }}/{{ tab['name'] }}"> {{ tab['name'] }} <b class="menu-glyphicon visible-xs visible-sm glyphicon glyphicon-plus"></b> <span class="hidden-xs hidden-sm caret"></span> </a>
<script type="text/javascript">transRegions['{{ tab["name_en"] }}'] = '{{ tab["name"] }}'</script>
{% if not(tab is empty) %}
	<ul class="dropdown-menu level2">
	{% for tabSub in tab %}
	{% if isArray(tabSub) %}
	<li class="dropdown-submenu" >
	<a class="menu-country" data-country-code="{{ tabSub['country_code'] }}" tabindex="-1" href="{{ uriBase }}/{{ tab['name'] }}/{{ tabSub['name']  }}">{{ tabSub['name'] }} </a>
	<script type="text/javascript">availCountry['{{ tabSub["country_code"] }}'] = '{{ tabSub["name"] }}'</script>
{#	{% if not(tabSub is empty) %}
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
	{% endif %} #}
	</li>
	<li class="divider"></li>
	{% endif %}
	{% endfor %}
	</ul> 
{% endif %}
</li>
{% endfor %}
