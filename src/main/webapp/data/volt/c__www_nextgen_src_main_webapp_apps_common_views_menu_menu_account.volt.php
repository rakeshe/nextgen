<?php if (empty($currentUser)) { ?>
 <?php if (!empty($menuItemsAccount)) { ?>
    <?php foreach ($menuItemsAccount as $label => $uri) { ?>
        <li><a class="acc-link" href="<?php echo $uri; ?>"><?php echo $t->_($label); ?></a></li>
    <?php } ?>
 <?php } ?>
<?php } else { ?>
  <li class="hidden-sm hidden-xs welcomeText"><?php echo $t->_('welcome'); ?> <?php echo $currentUser['name']; ?> </li>
  <li class="loyaltyTier hidden-sm hidden-xs"><?php echo $currentUser['loyaltyTier']; ?> Member:</li>
  <li class="loyaltyInfo hidden-sm hidden-xs"><?php echo $currentUser['rewardPoints']; ?> Member Rewards** (<?php echo $currentUser['rewardPoints']; ?>)</li>
  <li class="signOutLink"><a rel="nofollow" class="acc-link" href="https://www.hotelclub.com/account/logout"><?php echo $t->_('sign_out'); ?></a></li>
<?php } ?>