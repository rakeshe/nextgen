<!-- main menu -->
<div class="col-md-6">
    <ul id="header_menu_hc" class="left_menu">
        <?php if (!empty($menuItemsSite)) { ?>

        <?php if ($languageCode == 'en_AU') { ?>

            <?php foreach ($menuItemsSite as $label => $uri) { ?>
                <li><a class="link" href="<?php echo $uri; ?>"><?php echo $t->_($label); ?></a></li>
             <?php } ?>
        <?php } else { ?>

            <?php foreach ($menuItemsSite as $label => $uri) { ?>
                <?php if ($label != 'menu_travel_insurance') { ?>
                     <li><a class="link" href="<?php echo $uri; ?>"><?php echo $t->_($label); ?></a></li>
                <?php } ?>
            <?php } ?>

        <?php } ?>
        
        <?php } ?>
    </ul>
</div>