<!-- Desktop Search Widget -->
<div class="clearfix"></div>
<div id="dkt_searchBot" class="visible-desktop">
    <!-- search -->
    <form class="form-inline datepicker" method="get" name="searchBot role="form">
    <div class=" where">
        <h2>Find a hotel deal</h2>
        <p>Where</p>
        <input type="text"  class="form-control input-md" placeholder="Location.." id="locationText">
    </div>
    <div class="form-group ">
        <p>Check-in</p>
        <input type="text" class="form-control input-sm"  placeholder="dd/mm/yy">
    </div>
    <div class="form-group ">
        <p>Check-out</p>
        <input type="text" class="form-control input-sm "  placeholder="dd/mm/yy">
    </div>
    <div class="controls">
        <div class="errorMessage">&nbsp;</div>
        <input type="button" class="btn btn-default col-md-offset-8" onclick="doSearch(this.form)" value="Search" name="search">
    </div>
    <div class=" promo-code">
        <p>I have a promotion code</p>
        <input type="text"  name="couponCode" id="couponCode" class="form-control input-md" placeholder="Location.." id="locationText">
    </div>
    <div class="search_contacts row">
        <div class="glyphicon glyphicon-earphone col-md-1">
        </div>
        <div class=" help col-md-8">
            <p>Need Help to book ?</p>
            <p>1300 854 585 </p>
        </div>
    </div>
    </form>
</div>

<!-- /Desktop Search Widget -->