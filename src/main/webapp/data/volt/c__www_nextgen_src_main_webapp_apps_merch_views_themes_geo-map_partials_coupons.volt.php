<?php if (isset($coupon)) { ?>
    <div id="coupon_code" style="display: none">
        <div class="img-responsive hidden-xs">
            <?php echo $coupon['message']; ?>
        </div>
        <div class="img-responsive visible-xs">
            <?php echo $coupon['message']; ?>
        </div>

    </div>
<?php } ?>