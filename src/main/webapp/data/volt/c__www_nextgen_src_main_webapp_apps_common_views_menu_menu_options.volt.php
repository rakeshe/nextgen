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
                    <?php $v29219837392iterator = $currencyGroup; $v29219837392incr = 0; $v29219837392loop = new stdClass(); $v29219837392loop->length = count($v29219837392iterator); $v29219837392loop->index = 1; $v29219837392loop->index0 = 1; $v29219837392loop->revindex = $v29219837392loop->length; $v29219837392loop->revindex0 = $v29219837392loop->length - 1; ?><?php foreach ($v29219837392iterator as $CatName => $currencyPkg) { ?><?php $v29219837392loop->first = ($v29219837392incr == 0); $v29219837392loop->index = $v29219837392incr + 1; $v29219837392loop->index0 = $v29219837392incr; $v29219837392loop->revindex = $v29219837392loop->length - $v29219837392incr; $v29219837392loop->revindex0 = $v29219837392loop->length - ($v29219837392incr + 1); $v29219837392loop->last = ($v29219837392incr == ($v29219837392loop->length - 1)); ?>
                    <div class="section <?php if (!$v29219837392loop->first) { ?>top <?php } ?>"><h5><?php echo $t->_($CatName); ?></h5></div>
                    <?php foreach ($currencyPkg as $currency_code => $labelName) { ?>
                    <ul>
                    <li data-component="currencySelectorItem">
                    <a class="link currencyItem" data-currency="<?php echo $currency_code; ?>"><?php echo $t->_($labelName); ?></a>
                    </li>
                    </ul>
                    <?php } ?>
                    <?php $v29219837392incr++; } ?>
                </li>
                <?php } ?>

            </ul>
            <a href="#" id="currency-selector-menu" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $currencyCode; ?> <b class="caret"></b></a>
        </li>
	<?php } ?>
    </ul>
</div>

