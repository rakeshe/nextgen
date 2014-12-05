<!-- lang -->
<div class="col-md-offset-2 pull-left">
    <ul class="nav navbar-nav navbar-right right_menu right_menu_link">
    <?php if (!empty($menuItemsRightSite)) { ?>
        <?php foreach ($menuItemsRightSite as $label => $link) { ?>

            <?php if ($languageCode != 'en_AU') { ?>
                <?php if ($label != 'USA') { ?>
                    <li class="dropdown">
                        <a href="<?php echo $link; ?>" class="link"><?php echo $t->_($label); ?></a>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li class="dropdown">
                    <a href="<?php echo $link; ?>" class="link"><?php echo $t->_($label); ?></a>
                </li>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    </ul>
    </div>
    <div class="col-md-offset-2">
    <ul class="nav navbar-nav navbar-right right_menu">

	<?php if (!empty($menuItemsLanguageOptions)) { ?>
        <li class="dropdown">
            <a href="#" id="" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $menuItemsLanguageOptions[trim($languageCode)]; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <?php foreach ($menuItemsLanguageOptions as $language_code => $label) { ?>
                    <li lang="<?php echo $language_code; ?>" class="">
                        <a href="/n/set-language/<?php echo $language_code; ?>" class="link"><?php echo $label; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </li>
	<?php } ?>
	<li><div class="right_menu_divider"></div> </li>
	<?php if (!empty($currencies)) { ?>
        <li class="dropdown">
            <ul class="dropdown-menu currencySelector selector multiColumn">
                <?php foreach ($currencyList as $groupIndex => $currencyGroup) { ?>
                <li class="column column3">
                    <?php $v2466138002iterator = $currencyGroup; $v2466138002incr = 0; $v2466138002loop = new stdClass(); $v2466138002loop->length = count($v2466138002iterator); $v2466138002loop->index = 1; $v2466138002loop->index0 = 1; $v2466138002loop->revindex = $v2466138002loop->length; $v2466138002loop->revindex0 = $v2466138002loop->length - 1; ?><?php foreach ($v2466138002iterator as $CatName => $currencyPkg) { ?><?php $v2466138002loop->first = ($v2466138002incr == 0); $v2466138002loop->index = $v2466138002incr + 1; $v2466138002loop->index0 = $v2466138002incr; $v2466138002loop->revindex = $v2466138002loop->length - $v2466138002incr; $v2466138002loop->revindex0 = $v2466138002loop->length - ($v2466138002incr + 1); $v2466138002loop->last = ($v2466138002incr == ($v2466138002loop->length - 1)); ?>
                    <div class="section <?php if (!$v2466138002loop->first) { ?>top <?php } ?>"><h5><?php echo $t->_($CatName); ?></h5></div>
                    <?php foreach ($currencyPkg as $currency_code => $labelName) { ?>
                    <ul>
                    <li data-component="currencySelectorItem">
                    <a class="link currencyItem" data-currency="<?php echo $currency_code; ?>"><?php echo $t->_($labelName); ?></a>
                    </li>
                    </ul>
                    <?php } ?>
                    <?php $v2466138002incr++; } ?>
                </li>
                <?php } ?>

            </ul>
            <a href="#" id="currency-selector-menu" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $currencyCode; ?> <b class="caret"></b></a>
        </li>
	<?php } ?>
    </ul>
</div>

