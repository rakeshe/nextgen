<?php if (!empty($menuItemsTop)) { ?>
    <?php foreach ($menuItemsTop as $label => $uri) { ?>
        <li><a rel="nofollow" class="link" href="<?php echo $uri; ?>"><?php echo $t->_($label); ?></a></li>
    <?php } ?>
<?php } ?>