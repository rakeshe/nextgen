{{ partial('../../../common/views/header/header') }}
<!-- START VIEW PARTIAL: banner.phtml -->
<div id="banner" class="subContainer">

    {{ partial(theme ~ '/partials/map') }}
        
    {{ partial(theme ~ '/partials/menu') }}
</div>
<!-- END VIEW PARTIAL: banner.phtml -->
{{ partial(theme ~ '/partials/hotels') }}

{{ partial('../../../common/views/footer/footer') }}