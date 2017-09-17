<?php
/*
  $Id points.php

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2016 osCommerce

  Released under the GNU General Public License
*/

?>
<!-- Start cm_r_points module -->
<div id="cm_r_points" class="col-sm-<?php echo $content_width; ?>">
  <?php echo '<p>' . sprintf(MODULE_CONTENT_REVIEWS_POINTS_HELP_LINK, $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS)), '<a href="' . tep_href_link('my_points_help.php', '#heading13', $request_type) . '" title="' . MODULE_CONTENT_REVIEWS_POINTS_MY_POINTS_HELP . '">' . MODULE_CONTENT_REVIEWS_POINTS_MY_POINTS_HELP . '</a>') . '</p>'; ?>
</div>
<!-- End cm_r_points module -->
