<?php echo $this->partial('../../../common/views/header/header'); ?>
    <div class="sub-content subContainer">
        <h1>Oops. The page you requested is no longer available or our promotion has expired.</h1>
        <h2>Checkout our current promotions</h2>
        <?php foreach ($data as $campaign) { ?>
            <div>

        <a href="/merch/<?php echo $campaign['locale']; ?>/<?php echo $campaign['url']; ?>">
            <img src="<?php echo $campaign['thumbnail']; ?>" />
        </a>
        </div>
        <?php } ?>
        <br />
        <br />
    </div>
<?php echo $this->partial('../../../common/views/footer/footer'); ?>
