<!-- mobile banner -->

<div class="visible-phone" id="mbl_banner">
    <!-- Button trigger modal -->

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
   <div class="region_panels hidden-desktop">
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
		<div class="region_menu">
			<table width="100%">
				<tbody>
				<tr>
					<div class="btn-group-vertical">
						<div class="btn-group">
						<button type="button" id="region1" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						Australia
						<span class="glyphicon glyphicon-plus"></span>
						</button>
							<ul aria-labelledby="btnGroupVerticalDrop4" role="menu" class="dropdown-menu level2">
								<li>
								<a tabindex="-1" href="/en/test-campaign/Austalia-NZ/Sydney">Sydney</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Austalia-NZ/Melbourne">Melbourne</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Austalia-NZ/Brisbane">Brisbane</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Austalia-NZ/Auckland">Auckland</a>
								</li>
								</ul>
						</div>
						<div class="btn-group">
						<button type="button" id="region2" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						USA
						<span class="glyphicon glyphicon-plus"></span>
						</button>
							<ul aria-labelledby="btnGroupVerticalDrop4" role="menu" class="dropdown-menu level2">
								<li>
								<a tabindex="-1" href="/en/test-campaign/USA/New-york">New york</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/USA/Washington">Washington</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/USA/California">California</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/USA/Chicago">Chicago</a>
								</li>
							</ul>
						</div>
						<div class="btn-group">
						<button type="button" id="region3" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						Europe
						<span class="glyphicon glyphicon-plus"></span>
						</button>
							<ul aria-labelledby="btnGroupVerticalDrop4" role="menu" class="dropdown-menu level2">
								<li>
								<a tabindex="-1" href="/en/test-campaign/Europe/London">London</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Europe/German">German</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Europe/Italy">Italy</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Europe/France">France</a>
								</li>
							</ul>
						</div>
						<div class="btn-group">
						<button type="button" id="region4" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
						Asia
						<span class="glyphicon glyphicon-plus"></span>
						</button>
							<ul aria-labelledby="btnGroupVerticalDrop4" role="menu" class="dropdown-menu level2">
								<li>
								<a tabindex="-1" href="/en/test-campaign/Asia/india">India</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Asia/China">China</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Asia/Singapore">Singapore</a>
								</li>
								<li class="divider"></li>
								<li>
								<a tabindex="-1" href="/en/test-campaign/Asia/Srilanka">Srilanka</a>
								</li>
							</ul>
						</div>
					</div>
					</div>  
				<tr>
				</tbody>
			</table>
		</div>
 </div>
 <!-- Dialog box phone Tabs -->
<!-- /mobile banner -->