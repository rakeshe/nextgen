<script>var availCountry = {}, transRegions = {}, availCity = {};</script>
{% if region is not defined %}
{% set region = "" %}
{% endif %}
{% if country is not defined %}
{% set country = "" %}
{% endif %}
{% if city is not defined %}
{% set city = "" %}
{% endif %}
<script>var data = '{{data}}', regionName = '{{region}}', countryName = '{{country}}', cityName = '{{city}}';</script>
<!-- desktop banner -->
<div class="visible-md visible-lg" id="dkt_banner">
    <!-- Desktop region tabs -->
    <div id="regionTabs">
        <!-- Tabs -->
	<div id="header">
		{% if not(DDMenue is empty) %}
		<ul id="menu_new">
		{% for tab in DDMenue %}
			<li class="dropdown-submenu {%if tab['name'] == region %}levelActive{% else %}level1{%endif%}">
			<a class="menu-icons menu-region" tabindex="-1" data-code="{{ tab['name_en'] }}" href="{{ uriBase }}/{{ tab['name'] }}"> {{ tab['name'] }} <b class="menu-glyphicon visible-xs visible-sm glyphicon glyphicon-plus"></b></a>
			<script type="text/javascript">transRegions['{{ tab["name_en"] }}'] = '{{ tab["name"] }}';</script></li>			
		{% endfor %}
		</ul>		
		{% endif %}
	</div>
	<!-- /Desktop region tabs -->
     </div>
</div>
<!-- /desktop banner -->