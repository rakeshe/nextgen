<!-- lang -->
<?php if (!empty($menuItemsLanguageOptions)) { ?>        
<li class="dropdown">
    <a href="#" class="dropdown-toggle" id="open_languages" data-toggle="dropdown"> <?php echo $menuItemsLanguageOptions[$languageCode]; ?> <b class="caret"></b></a>
    <ul class="dropdown-menu" id="lang_style">
        <?php foreach ($menuItemsLanguageOptions as $language_code => $label) { ?>
        <li lang="<?php echo $language_code; ?>" class="">
            <a href="/n/set-language/<?php echo $language_code; ?>" class="link"><?php echo $label; ?></a>
        </li>
        <?php } ?>
    </ul>
</li>
<?php } ?>

