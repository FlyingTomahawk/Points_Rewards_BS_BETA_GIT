<?php
/*
  $Id$
  created by Ben Zukrel, Deep Silver Accessories
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require_once('includes/functions/redemptions.php');

  require('includes/languages/' . $language . '/my_points_help.php');

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link('my_points_help.php', '', 'NONSSL'));

  require('includes/template_top.php');
?>
<div class="page-header">
	<h1><?php echo HEADING_TITLE; ?></h1>
</div>

<div class="contentContainer">
  <div class="contentText">
<p><?php echo TEXT_INFORMATION; ?></p>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading1">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
          <?php echo POINTS_FAQ_1;?>
        </a>
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading1">
      <div class="panel-body">
          <?php echo TEXT_FAQ_1;?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading2">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
          <?php echo POINTS_FAQ_2;?>
        </a>
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2">
      <div class="panel-body">
        <?php echo TEXT_FAQ_2; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading3">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
         <?php echo POINTS_FAQ_3;?>
        </a>
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading3">
      <div class="panel-body">
        <?php echo sprintf(TEXT_FAQ_3, $currencies->format(1), number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE, MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format(100), $currencies->format(tep_calc_shopping_pvalue(100 * MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_PER_AMOUNT_PURCHASE)));?>
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading4">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
          <?php echo POINTS_FAQ_4;?>
        </a>
      </h4>
    </div>
    <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
      <div class="panel-body">
        <?php echo TEXT_FAQ_4; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading5">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
          <?php echo POINTS_FAQ_5;?>
        </a>
      </h4>
    </div>
    <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE  > 0)? sprintf(TEXT_FAQ_5_A, number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE), $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_LIMIT_VALUE))) : TEXT_FAQ_5_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading6">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
         <?php echo POINTS_FAQ_6;?>
        </a>
      </h4>
    </div>
    <div id="collapse6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading6">
      <div class="panel-body">
        <?php echo (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MIN_AMOUNT))? sprintf(TEXT_FAQ_6_A, $currencies->format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MIN_AMOUNT)) : TEXT_FAQ_6_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading7">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7">
          <?php echo POINTS_FAQ_7;?>
        </a>
      </h4>
    </div>
    <div id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
      <div class="panel-body">
        <?php echo sprintf(TEXT_FAQ_7, $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE)), number_format(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_MAX_VALUE));?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading8">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse8" aria-expanded="false" aria-controls="collapse8">
          <?php echo POINTS_FAQ_8;?>
        </a>
      </h4>
    </div>
    <div id="collapse8" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SHIPPING == 'False')? TEXT_FAQ_8_A : TEXT_FAQ_8_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading9">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse9" aria-expanded="false" aria-controls="collapse9">
         <?php echo POINTS_FAQ_9;?>
        </a>
      </h4>
    </div>
    <div id="collapse9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading9">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_TAX == 'False')? TEXT_FAQ_9_A : TEXT_FAQ_9_B; ?>
      </div>
    </div>
  </div>
  
   <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading10">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse10" aria-expanded="true" aria-controls="collapse10">
          <?php echo POINTS_FAQ_10;?>
        </a>
      </h4>
    </div>
    <div id="collapse10" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading10">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_SPECIALS == 'False')? TEXT_FAQ_10_A : TEXT_FAQ_10_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading11">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse11" aria-expanded="false" aria-controls="collapse11">
          <?php echo POINTS_FAQ_11;?>
        </a>
      </h4>
    </div>
    <div id="collapse11" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading11">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REDEEMED == 'False')? TEXT_FAQ_11_A : TEXT_FAQ_11_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading12">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse12" aria-expanded="false" aria-controls="collapse12">
         <?php echo POINTS_FAQ_12;?>
        </a>
      </h4>
    </div>
    <div id="collapse12" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading12">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_REFERRAL_SYSTEM > 0 )? TEXT_FAQ_12_A : TEXT_FAQ_12_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading13">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse13" aria-expanded="true" aria-controls="collapse13">
          <?php echo POINTS_FAQ_13;?>
        </a>
      </h4>
    </div>
    <div id="collapse13" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading13">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS > 0 )? sprintf(TEXT_FAQ_13_A, $currencies->format(tep_calc_shopping_pvalue(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_USE_POINTS_FOR_REVIEWS))) : TEXT_FAQ_13_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading14">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse14" aria-expanded="false" aria-controls="collapse14">
          <?php echo POINTS_FAQ_14;?>
        </a>
      </h4>
    </div>
    <div id="collapse14" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading14">
      <div class="panel-body">
        <?php 
          if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PID)) { 
            $prods = null;
            $prods_query = tep_db_query("SELECT * FROM products, products_description WHERE products.products_id = products_description.products_id and products_description.language_id = '" . $languages_id . "'and products.products_id  in (" . MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PID . ")");
            while ($list = tep_db_fetch_array($prods_query)) {
              $prods .= '<li>' . $list['products_name'] .'</li>';
            }
            echo sprintf(TEXT_FAQ_14_A, $prods);
          }
          if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PATH)) {
            $cats = null;
            $cat_path_query = tep_db_query("select * from categories, categories_description WHERE categories.categories_id = categories_description.categories_id and categories_description.language_id = '" . $languages_id . "' and categories.categories_id in (" . MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_RESTRICTION_PATH . ")");
            while ($list = tep_db_fetch_array($cat_path_query)) {
              $cats .= '<li>' . $list['categories_name'] .'</li>';
            }
            echo sprintf(TEXT_FAQ_14_B, $cats);
          } else {
            echo TEXT_FAQ_14_C;
          }
          echo TEXT_FAQ_14_D;
	      ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading15">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse15" aria-expanded="false" aria-controls="collapse15">
         <?php echo POINTS_FAQ_15;?>
        </a>
      </h4>
    </div>
    <div id="collapse15" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading15">
      <div class="panel-body">
        <?php echo (MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_REDEMPTION_DISCOUNTED == 'True')? TEXT_FAQ_15_A : TEXT_FAQ_15_B; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading16">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse16" aria-expanded="false" aria-controls="collapse16">
          <?php echo POINTS_FAQ_16;?>
        </a>
      </h4>
    </div>
    <div id="collapse16" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading16">
      <div class="panel-body">
        <?php echo TEXT_FAQ_16; ?>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading17">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse17" aria-expanded="false" aria-controls="collapse17">
         <?php echo POINTS_FAQ_17;?>
        </a>
      </h4>
    </div>
    <div id="collapse17" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading17">
      <div class="panel-body">
        <?php echo TEXT_FAQ_17; ?>
      </div>
    </div>
  </div>
  
</div>

</div>

<div class="buttonSet row">
	<div class="col-xs-6"><a href="javascript:history.go(-1)"><?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'fa fa-chevron-left'); ?></a></div>
	<div class="col-xs-6 text-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'fa fa-chevron-right', tep_href_link('index.php')); ?></div>
</div>

</div>	

<?php
  require('includes/template_bottom.php');
  require('includes/application_bottom.php');
?>
