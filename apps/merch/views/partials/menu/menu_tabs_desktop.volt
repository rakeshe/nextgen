<!-- desktop banner -->
<div class="visible-desktop" id="dkt_banner">
    <!-- Desktop region tabs -->
    <div id="regionTabs">
        <!-- Tabs -->
		 <div id="deal-tabs" class="tabbable deal-tabs">
		{% if not(DDMenue is empty) %}
		<div class="dropdown clearfix">
		<ul class="dropdown-menu desktop-tabs" style="display:block">
		{{ partial('partials/menu/menu_tabs') }}
		</ul>
		</div>
		{% endif %}
        <div class="clearfix"></div>
        <div class="red-line"></div>
    </div>
    <!-- /Desktop region tabs -->
 </div>
<!-- /desktop banner -->