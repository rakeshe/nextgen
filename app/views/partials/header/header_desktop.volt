<!-- desktop header -->
<div id="dkt_header" class="visible-desktop">
    <div class="row">

        <!-- header logo -->
        <div class="col-md-5 logo">
            <a href="/" title="Hotelclub Logo">
                <img src="/img/logo-header.png" alt="Hotelclub Logo" />
            </a>
        </div>

        <!-- header links -->
        <div class="col-md-offset-5">
            <ul class="primary">
                {{ partial('partials/menu/menu_top') }}
            </ul>

            <ul class="login">
                {{ partial('partials/menu/menu_account') }}
            </ul>
        </div>

    </div>
</div>
<!-- /desktop header -->