<!-- mobile banner -->

 		<div class="hidden-lg hidden-md" id="mbl_banner">
			<div id="regionTabs">
        <!-- Tabs -->
		 <div id="deal-tabs" class="tabbable deal-tabs">
		{% if not(DDMenue is empty) %}
		<div class="dropdown clearfix" style="position:relative!important;">
		<ul class="dropdown-menu mobile-tabs" style="display:block">
		{{ partial('partials/menu/menu_tabs') }}
		</ul>
		</div>
		{% endif %}
        <div class="clearfix"></div>
        <div class="red-line"></div>
    </div>
		</div>

<!-- /mobile banner -->