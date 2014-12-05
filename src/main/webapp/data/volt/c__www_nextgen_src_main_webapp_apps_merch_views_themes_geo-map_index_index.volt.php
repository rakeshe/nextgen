<div class="container">
<?php echo $this->partial('../../../common/views/header/header'); ?>
<!-- START VIEW PARTIAL: banner.phtml -->
<div id="banner" class="subContainer">

    <?php echo $this->partial($theme . '/partials/coupons'); ?>

    <?php echo $this->partial($theme . '/partials/map'); ?>

    <?php echo $this->partial($theme . '/partials/menu'); ?>
    
    <?php echo $this->partial($theme . '/partials/hotels'); ?>


<?php echo $this->partial('../../../common/views/footer/footer'); ?>
</div>
</div>
<?php echo $this->partial('../../../common/views/tracking/tracking'); ?>