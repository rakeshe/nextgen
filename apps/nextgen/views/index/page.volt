{{ content() }}
{{ partial('partials/header/header') }}
<!-- START VIEW PARTIAL: banner.phtml -->
<div id="banner" class="subContainer">

    {{ partial('partials/search/search_desktop') }}
    {{ partial('partials/search/search_tablet') }}

    {{ partial('partials/carousel/carousel') }}

    {{ partial('partials/menu/menu_tabs_desktop') }}
    {{ partial('partials/menu/menu_tabs_tablet') }}
    {{ partial('partials/menu/menu_tabs_mobile') }}

</div>
<!-- END VIEW PARTIAL: banner.phtml -->

{{ partial('partials/items/hotels') }}

{{ partial('partials/footer/footer') }}