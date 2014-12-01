<div class="container">
{{ partial('../../../common/views/header/header') }}
<!-- START VIEW PARTIAL: banner.phtml -->
<div id="banner" class="subContainer">

    {{ partial(theme ~ '/partials/coupons') }}

    {{ partial(theme ~ '/partials/map') }}

    {{ partial(theme ~ '/partials/menu') }}
    
    {{ partial(theme ~ '/partials/hotels') }}


{{ partial('../../../common/views/footer/footer') }}
</div>
</div>
{{ partial('../../../common/views/tracking/tracking') }}