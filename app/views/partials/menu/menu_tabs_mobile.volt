<!-- mobile banner -->

<div class="visible-phone" id="mbl_banner">
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h2 id="myModalLabel" class="modal-title">{{ t._('find_hotel_now') }}</h2>
                </div>
                <!-- use existing search form - this is duplicate content -->
                <div class="modal-body">
                    <form form"="" name="searchBot role=" method="get" class="form-inline datepicker">
                    <div class=" where">
                        <h5>{{ t._('where') }}</h5>
                        <input type="text" id="locationText" placeholder="Location.." class="form-control input-md">
                    </div>
                    <div class="checkdate form-group ">
                        <h5>Check-in</h5>
                        <input type="text" placeholder="dd/mm/yy" class="check-input form-control input-sm ">
                    </div>
                    <div class="checkdate">
                        <h5>Check-out</h5>
                        <input type="text" placeholder="dd/mm/yy" class="check-input form-control input-sm ">
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
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Regions" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-body">
                <div class="dropdown clearfix">
                    <ul class="dropdown-menu" style="display:block">
                        {{ partial('partials/menu/menu_tabs') }}
                    </ul>
                </div>
            </div>

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
{#@todo change the menu select titles#}
    <table width="100%">
        <tbody><tr>
            <td width="50%">
                <div id="accordion" class="panel-group">
                    <div class="panel">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li  class="dropdown">
                                    <a class="dropdown-toggle" data-target="#Regions" data-toggle="modal" href="#">Australia & NZ<b class="caret"></b></a>

                        </div>
                    </div>
                </div>
            </td>
            <td align="right">
                <div id="accordion" class="panel-group">
                    <div class="panel">
                        <div class="panel-heading">
                            <a data-target="#myModal" data-toggle="modal" href="#">Search more hotels <span class="right-caret"></span> </a>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody></table>
</div>

<!-- /mobile banner -->