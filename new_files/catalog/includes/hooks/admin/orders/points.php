<?php
/*
  $Id: points.php
  $Loc: catalog/includes/hooks/admin/orders/
   
   Version: 1.1
   originally coded by Ben Zukrel 
   Improved and converted for osC Bootstrap by
   @Tsimi
   and
   @raiwa Rainer Schmied / info@oscaddons.com  / www.oscaddons.com

   Additional credits to @LeeFoster for bug reports and fixes
   German translation by @Tsimi
   German revision by @raiwa
   Spanish translation by @TITO4
   Spanish revision by @PiLLaO 
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

class hook_admin_orders_points {

  function listen_PointsOrderUpdatePoints() {
    global $comments, $oID, $language;
    
    require(DIR_FS_CATALOG . 'includes/languages/' . $language . '/hooks/admin/orders/points.php');
    
    if ( MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True' && MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_ON != 'True' ) {
      if ( (isset($_POST['confirm_points']) && ($_POST['confirm_points'] == 'on')) || (isset($_POST['delete_points']) && ($_POST['delete_points'] == 'on')) ) {
        $customer_query = tep_db_query("select customer_id, points_pending from customers_points_pending where points_status = 1 and points_type = 'SP' and orders_id = '" . (int)$oID . "' limit 1");
        $customer_points = tep_db_fetch_array($customer_query);
        if (tep_db_num_rows($customer_query)) {
          if ( isset($_POST['delete_points']) && ($_POST['delete_points'] == 'on') ) {
            tep_db_query("delete from customers_points_pending where orders_id = '" . (int)$oID . "' and points_type = 'SP' limit 1");
            $sql = "optimize table customers_points_pending";
          }
          if ( isset($_POST['confirm_points']) && ($_POST['confirm_points'] == 'on') ) {
            if (tep_not_null(MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES)) {
              $expire  = date('Y-m-d', strtotime('+ '. MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_EXPIRES .' month'));
              tep_db_query("update customers set customers_shopping_points = customers_shopping_points + '". $customer_points['points_pending'] ."', customers_points_expires = '". $expire ."' where customers_id = '". (int)$customer_points['customer_id'] ."'");
            } else {
              tep_db_query("update customers set customers_shopping_points = customers_shopping_points + '". $customer_points['points_pending'] ."' where customers_id = '". (int)$customer_points['customer_id'] ."'");
            }
            tep_db_query("update customers_points_pending set points_status = 2 where orders_id = '" . (int)$oID . "' and points_type = 'SP' limit 1");
            $sql = "optimize table customers_points_pending";
            $comments = POINTS_HOOK_ORDERS_CONFIRMED_POINTS  . $comments;
          }
        }
      }
    }
  }
  
  function listen_PointsOrderRemovePoints() {
    global $oID;
        
    tep_db_query("delete from customers_points_pending where orders_id = '" . (int)$oID . "'");
    $sql = "optimize table customers_points_pending";
  }

  function listen_PointsOrderPointsFields() {
    global $oID, $language;
        
    require(DIR_FS_CATALOG . 'includes/languages/' . $language . '/hooks/admin/orders/points.php');

    if ( MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True' && MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_AUTO_ON != 'True' ) {
      $p_status_query = tep_db_query("select points_status from customers_points_pending where points_status = 1 and points_type = 'SP' and orders_id = '" . (int)$oID . "' limit 1");
      if (tep_db_num_rows($p_status_query)) {
        echo '<tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td><strong>' . POINTS_HOOK_ORDERS_ENTRY_NOTIFY_POINTS . '</strong></td><td>' . tep_draw_checkbox_field('confirm_points', '', false) . POINTS_HOOK_ORDERS_QUE_POINTS . '</td>
              </tr>
              <tr>
                <td></td><td>' . tep_draw_checkbox_field('delete_points', '', false) . POINTS_HOOK_ORDERS_QUE_DEL_POINTS . '&nbsp;</td>
              <tr>
                <td colspan="2"><hr></td>
              </tr>';
?>
<script>
$('select[name="status"]').change(function(){
  var statusArray = '<?php echo MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_AUTO_TICK_ORDER_STATUS ?>'.split(',');
  if (statusArray.indexOf($(this).val()) >= 0) {
    $('input:checkbox[name="confirm_points"]').each(function(){ this.checked = true; });
    $('input:checkbox[name="delete_points"]').each(function(){ this.checked = false; });
  } else {
    $('input:checkbox[name="confirm_points"]').each(function(){ this.checked = false; });
  }
});
$('input:checkbox[name="confirm_points"]').on("click", function (){
  if (this.checked == true) {
    $('input:checkbox[name="delete_points"]').each(function(){ this.checked = false; });
  }
});
$('input:checkbox[name="delete_points"]').on("click", function (){
  if (this.checked == true) {
    $('input:checkbox[name="confirm_points"]').each(function(){ this.checked = false; });
  }
});
</script>
<?php
      }
    }
  }

} // end class
