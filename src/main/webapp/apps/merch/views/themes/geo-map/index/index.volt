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






$(document).ready(function(){

    //remove default select option
    $('.input-default-value').change(function() {
        //remove default option
        var className = $(this).data('rm-val');
        $('.' + className + ' option[value="0"]').remove();

        //release disable
        switch (className) {
            case 'dropdown-region' :
                $('.dropdown-cities').removeAttr('disabled');
                break;

            case 'dropdown-cities' :
                $('.dropWhereDo').removeAttr('disabled');
                break;
        }

    });

});