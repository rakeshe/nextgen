<!-- lang -->
<?php if (!empty($menuItemsLanguageOptions)) { ?>        
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $menuItemsLanguageOptions[$languageCode]; ?> <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <?php foreach ($menuItemsLanguageOptions as $language_code => $label) { ?>
        <li lang="<?php echo $language_code; ?>" class="">
            <a href="/n/set-language/<?php echo $language_code; ?>" class="link"><?php echo $label; ?></a>
        </li>
        <?php } ?>
    </ul>
</li>
<?php } ?>

