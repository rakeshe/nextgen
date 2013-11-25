<!-- mobile banner -->

<div class="visible-phone" id="mbl_banner">
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">�</button>
                    <h2 id="myModalLabel" class="modal-title">{{ t._('find_hotel_now') }}</h2>
                </div>
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
                        <li class="dropdown-submenu level1" >
                            <a tabindex="-1" href="#">Australia & NZ</a>
                            <ul class="dropdown-menu level2">
                                <li>
                                    <a tabindex="-1" href="#">Sydney</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Melbourne</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Brisbane</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Auckland</a>
                                </li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu level1" >
                            <a tabindex="-1" href="#">USA</a>
                            <ul class="dropdown-menu level2">
                                <li>
                                    <a tabindex="-1" href="#">New york</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Washington</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">California</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Chicago</a>
                                </li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu level1" >
                            <a tabindex="-1" href="#">Europe</a>
                            <ul class="dropdown-menu level2">
                                <li>
                                    <a tabindex="-1" href="#">London</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">German</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Italy</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">France</a>
                                </li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li class="dropdown-submenu level1" >
                            <a tabindex="-1" href="#">Asia</a>
                            <ul class="dropdown-menu level2">
                                <li>
                                    <a tabindex="-1" href="#">India</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">China</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Singapore</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a tabindex="-1" href="#">Srilanka</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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