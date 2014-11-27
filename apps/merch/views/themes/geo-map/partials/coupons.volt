{% if coupon is defined %}
    <div id="coupon_code" style="display: none">
        <div class="img-responsive hidden-xs">
            {{ coupon['message'] }}
        </div>
        <div class="img-responsive visible-xs">
            {{ coupon['message'] }}
        </div>

    </div>
{% endif %}