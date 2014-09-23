<!-- mobile banner -->

 		<div class="hidden-lg hidden-md" id="mbl_banner">
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
                            <a id="regions" href="javascript:void(0)">Australia & NZ<span class="right-caret"></span> </a>
                        </div>
                    </div>
                </div>
            </td>
            <td align="right">
                <div  class="panel-group">
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
			<div id="region_menu" style="display:none">
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