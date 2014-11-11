<div id="header" class="subContainer visible-md visible-lg">
    
	<!-- desktop header -->
<div id="dkt_header">
    <div class="row">

        <!-- header logo -->
        <div class="logo">
            <a href="/" title="Hotelclub Logo">
                <img src="/themes/common/img/logo-header.png" alt="Hotelclub Logo" />
            </a>
        </div>

        <!-- header links -->
        <div class="col-md-offset-5">
            <ul class="primary">
                {{ partial('../../../common/views/menu/menu_top') }}
            </ul>

            <ul class="login">
                {{ partial('../../../common/views/menu/menu_account') }}
            </ul>
        </div>

    </div>
</div>
<!-- /desktop header -->
	
</div>
<div id="mbl_header" class="hidden-md hidden-lg">
   
   {#@todo - convert to volt#}
<!-- mobile header -->
<div id="mbl_menu">
    <div class="dropdown">
        <a class="dropdown-toggle head_menu_pad" id="mbl_menu_logo" data-toggle="dropdown" href="#"><span class="offscreen">Main Menu</span></a>
        <ul class="dropdown-menu main_left_menu" role="menu" aria-labelledby="dLabel">
            <li><a href="#" alt="Hotel">Hotel</a></li>
            <li class="horiz_border"><a href="#" alt="Club Benefits" class="no_horiz_border">Club Benefits</a></li>
            <li>
                <a href="#" alt="Customer Service"><table width="100%"><tr>
                            <td width="20%"><div class="customer_menu_icon">&nbsp;</div></td>
                            <td>Customer Service</td>
                        </tr></table></a>

            </li>
			{{ partial('../../../common/views/menu/menu_options-tab') }}
        </ul>
    </div>
</div>

<div id="mbl_logo">
    <a href="index.html" title="Hotelclub Logo" class="head_menu_pad" id="mbl_main_logo">
        <img src="/img/logo-tablet.png" alt="Hotelclub Logo" />
    </a>
</div>

<div id="mbl_brief_member">
    <!--<div id="tab_briefcase" class="visible-sm">
        <a href="#" title="Hotelclub" class="head_menu_pad" id="mbl_brief_logo"><span>&nbsp;</span></a>
    </div>-->

    <div id="mbl_member">
        <div class="dropdown pull-right">
           {# <a class="visible-sm dropdown-toggle head_menu_pad" data-toggle="dropdown" href="#" id="tbl_member_logo">
             <span >Welcome</span>
            </a> #}
	    <a class=" dropdown-toggle head_menu_pad" data-toggle="dropdown" href="#" id="mbl_member_logo"> <strong class="visible-sm" > Welcome </strong>
            </a>
            <ul class="dropdown-menu main_right_menu" role="menu" aria-labelledby="dLabel2">
                               {{ partial('../../../common/views/menu/menu_top') }}
                           {{ partial('../../../common/views/menu/menu_account') }}
            </ul>
        </div>
    </div>
</div>

<div class="clear">&nbsp;</div>
<!-- /mobile header -->
    
   
</div>
<!-- headMenu -->
<div id="headMenu" class="subContainer visible-md visible-lg">
    <div class="row">
        {{ partial('../../../common/views/menu/menu_site') }}
		{{ partial('../../../common/views/menu/menu_options') }}
    </div>
</div>
<!-- /headMenu -->
