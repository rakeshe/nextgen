<!-- Desktop Search Widget -->
<div class="clearfix"></div>
<div id="dkt_searchBot" class="visible-md visible-lg">
    <!-- search -->
    <form class="form-inline datepicker" method="get" name="searchBot role="form">
    <div class=" where">
        <h2>{{ t._('find_hotel_now') }}</h2>
        <p>{{ t._('where') }}</p>
        <input type="text"  class="form-control input-md" placeholder="Location.." id="locationText">
		<p class="col-xs-5 col-sm-5 col-md-6 col-lg-5 location_search" id="location_search"></p>
    </div>
    <div class="form-group ">
        <p>{{ t._('check_in') }}</p>
        <input type="text" class="form-control input-sm datepicker" name="checkin"  id="checkin" placeholder="dd/mm/yy">
    </div>
    <div class="form-group ">
        <p>{{ t._('check_out') }}</p>
        <input type="text" class="form-control input-sm datepicker" name="checkout" id="checkout" placeholder="dd/mm/yy">
    </div>
    <div class="controls">
        <div class="errorMessage">&nbsp;</div>
        <input type="button" id="btnSearch" data-local="{{ languageCode }}" class="btn col-md-offset-9" value="{{ t._('search') }}" name="search">
    </div>
    <div class=" promo-code">
        <p>I have a promotion code</p>
        <input type="text" name="couponCode" id="couponCode" class="form-control input-md" placeholder="CouponCode.." id="locationText"
               value="{% if coupon['code'] is defined %}{{ coupon['code'] }}{% endif %}" />
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
        <p>{{  t._('check_in') }}</p>
        <input type="text" class="form-control input-sm datepicker "  id="tab_checkin" placeholder="dd/mm/yy">
    </div>
    <div class="form-group ">
        <p>{{  t._('check_out') }}</p>
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
