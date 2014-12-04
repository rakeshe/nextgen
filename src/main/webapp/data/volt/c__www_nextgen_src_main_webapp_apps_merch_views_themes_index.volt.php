<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <meta charset="utf-8">
        <?php echo $this->tag->getTitle(); ?>
        
		<?php echo $this->tag->stylesheetLink('vendor/bootstrap3.0/css/bootstrap.min.css'); ?>
        <?php echo $this->tag->stylesheetLink('themes/common/font/font_museo.css'); ?>
        <?php echo $this->tag->stylesheetLink('themes/common/font/font_serifa.css'); ?>
        <?php echo $this->tag->stylesheetLink('themes/' . $theme . '/css/ng.css'); ?>
        <?php echo $this->tag->stylesheetLink('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/blitzer/jquery-ui.min.css', false); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="/favicon.ico" />
        <meta name="description" content="Great hotel deals, no booking fees & member rewards. Cheap hotels in over 74,000 hotels worldwide. Get more from your holiday. Join us at hotelclub.com.">
        <meta name="author" content="hotel, club, hotelclub, hotelclub.net, hotels, reservation, reservations, accomodation, accomodations, rooms, lodging, service, rates, hotels, discounts, cheap, online, travel, booking, information, resorts">
    </head>
    <body>
        <?php echo $this->getContent(); ?>
        <?php echo $this->tag->javascriptInclude('http://google.com/jsapi', false); ?>
        <?php echo $this->tag->javascriptInclude('http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js', false); ?>
        <?php echo $this->tag->javascriptInclude('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js', false); ?>
        
		<?php echo $this->tag->javascriptInclude('vendor/bootstrap3.0/js/bootstrap.min.js'); ?>
        <?php echo $this->tag->javascriptInclude('themes/' . $theme . '/js/ng.js'); ?>
        <?php echo $this->tag->javascriptInclude('vendor/lazy-load/jquery.lazyload.js'); ?>
        <?php echo $this->tag->javascriptInclude('themes/common/js/jquery.cookie.js'); ?>
		<?php echo $this->tag->javascriptInclude('themes/common/js/respond.src.js'); ?>
    </body>
</html>
