<!-- Tablet search widget -->
<div id="tbt_searchBot" class="visible-sm">
    <!-- search -->
    <form class="form-inline datepicker" method="get" name="searchBot role="form">
    <div class=" where">
        <h2>Find a hotel deal</h2>
        <p>Where</p>
        <input type="text"  class="form-control input-md" placeholder="Location.." id="locationText">
    </div>
    <div class="form-group ">
        <p>Check-in</p>
        <input type="text" class="form-control input-sm datepicker "  id="tab_checkin" placeholder="dd/mm/yy">
    </div>
    <div class="form-group ">
        <p>Check-out</p>
	 <input type="text" class="form-control input-sm datepicker "  id="tab_checkout" placeholder="dd/mm/yy">
     </div>
    <div class="controls">
        <div class="errorMessage">&nbsp;</div>
        <input type="button" class="btn col-md-offset-8" onclick="doSearch(this.form)" value="Search" name="search">
    </div>
    <div class=" promo-code">
        <p>I have a promotion code</p>
        <input type="text"  name="couponCode" id="couponCode" class="form-control input-md" placeholder="CouponCode.." id="locationText">
    </div>

    </form>
</div>
<!-- /Tablet search widget -->
