<!-- mobile banner -->
 <div class="red-line"></div>
 		<div class="visible-xs visible-sm" id="mbl_banner">
		    <!-- Dialog box phone Tabs -->
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h2 id="myModalLabel" class="modal-title">Find a hotel deal</h2>
                </div>
                <div class="modal-body">
                    <form form"="" name="searchBot role=" method="get" class="form-inline datepicker">
                    <div class=" where">
                        <h5>Where</h5>
                        <input type="text" id="locationText" placeholder="Location.." class="form-control input-md">
                    </div>
                    <div class="checkdate form-group ">
                        <h5>Check-in</h5>
                        <input type="text" id="mob_checkin" placeholder="dd/mm/yy" class="check-input form-control input-sm ">
                    </div>
                    <div class="checkdate">
                        <h5>Check-out</h5>
                        <input type="text" id="mob_checkout" placeholder="dd/mm/yy" class="check-input form-control input-sm ">
                    </div>
                    <div class="controls">
                        <div class="errorMessage">&nbsp;</div>
                        <input type="button" name="search" value="Search" onclick="doSearch(this.form)" class="btn btn-search">
                    </div>

                    <div class=" promo-code">
                        <p></p><h5>I have a promotion code</h5><p></p>
                        <input type="text" placeholder="Location.." class="form-control input-md" id="couponCode" name="couponCode">
                    </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
	   <div class="region_panels hidden-md hidden-lg ">
    <table width="100%">
        <tbody><tr>
            <td width="50%">
			  <div class="panel-group">
                  <div class="panel">
                        <div class="panel-heading">
                            <a id="regions" href="javascript:void(0)">{{ region }}<span class="right-caret"></span> </a>
                        </div>
                    </div>
                </div>
            </td>
            <td align="right">
                <div  class="panel-group hidden-sm">
                    <div class="panel">
                        <div class="panel-heading">
                            <a data-target="#myModal" data-toggle="modal" href="#">Search more hotels <span class="right-caret"></span> </a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
 </table>
 </div>
 {# This code for Mouse over with same concept#}
	{#<div class="region_menu">
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
		</div>
	</div>
#}
<div class="region_menu">
      		 <!-- Tabs -->
			<table width="100%">
				<tbody>
				<tr>
					<div class="btn-group-vertical">
					{% if not(DDMenue is empty) %}
						{% for tab in DDMenue %}
						<div class="btn-group">						
						<button type="button" id="" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						{{ tab['name'] }}
					    <span class="glyphicon glyphicon-plus"></span>
						</button>
						{% if not(tab is empty) %}
							<ul aria-labelledby="btnGroupVerticalDrop4" role="menu" id="" class="dropdown-menu level2">
							{% for tabSub in tab %}
							{% if isArray(tabSub) %}
								<li>
								<a tabindex="-1" href="{{ uriBase }}/{{ tab['name'] }}/{{ tabSub['name']  }}">{{ tabSub['name'] }}</a>
								</li>
								<li class="divider"></li>
							{% endif %}
								{% endfor %}
								</ul>
								{% endif %}
								
							</div>
							{% endfor %}
								{% endif %}
						
					</div>  
				<tr>
				</tbody>
			</table>
		</div>
<!-- /mobile banner -->