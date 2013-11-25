<!-- START VIEW PARTIAL: header.phtml -->
<div id="header" class="subContainer">
    {{ partial('/partials/header/header_desktop') }}
    {{ partial('/partials/header/header_mobile') }}
</div>

<!-- headMenu -->
<div id="headMenu" class="subContainer visible-desktop">
    <div class="row">
       {{ partial('partials/menu/menu_site') }}

        {{ partial('partials/menu/menu_options') }}

    </div>
</div>
<!-- /headMenu -->

<!-- END VIEW PARTIAL: header.phtml -->