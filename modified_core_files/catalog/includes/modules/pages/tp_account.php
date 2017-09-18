<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2013 osCommerce

  Released under the GNU General Public License
*/

  class tp_account {
    var $group = 'account';

    function prepare() {
      global $oscTemplate;

      $oscTemplate->_data[$this->group] = array('account' => array('title' => MY_ACCOUNT_TITLE,
                                                                   'sort_order' => 10,
                                                                   'links' => array('edit' => array('title' => MY_ACCOUNT_INFORMATION,
                                                                                                    'link' => tep_href_link('account_edit.php', '', 'SSL'),
                                                                                                    'icon' => 'fa fa-user'),
                                                                                    'address_book' => array('title' => MY_ACCOUNT_ADDRESS_BOOK,
                                                                                                            'link' => tep_href_link('address_book.php', '', 'SSL'),
                                                                                                            'icon' => 'fa fa-home'),
                                                                                    'password' => array('title' => MY_ACCOUNT_PASSWORD,
                                                                                                        'link' => tep_href_link('account_password.php', '', 'SSL'),
                                                                                                        'icon' => 'fa fa-cog'))),
                                                'orders' => array('title' => MY_ORDERS_TITLE,
                                                                  'sort_order' => 20,
                                                                  'links' => array('history' => array('title' => MY_ORDERS_VIEW,
                                                                                                      'link' => tep_href_link('account_history.php', '', 'SSL'),
                                                                                                      'icon' => 'fa fa-shopping-cart'))),
                                                'notifications' => array('title' => EMAIL_NOTIFICATIONS_TITLE,
                                                                         'sort_order' => 30,
                                                                         'links' => array('newsletters' => array('title' => EMAIL_NOTIFICATIONS_NEWSLETTERS,
                                                                                                                 'link' => tep_href_link('account_newsletters.php', '', 'SSL'),
                                                                                                                 'icon' => 'fa fa-envelope'),
                                                                                          'products' => array('title' => EMAIL_NOTIFICATIONS_PRODUCTS,
                                                                                                              'link' => tep_href_link('account_notifications.php', '', 'SSL'),
                                                                                                              'icon' => 'fa fa-send'))));
    }

    function build() {
      global $oscTemplate;
      global $language, $customer_id, $currencies, $request_type; // POINTS REWARDS BS
      
      foreach ( $oscTemplate->_data[$this->group] as $key => $row ) {
        $arr[$key] = $row['sort_order'];
      }
      array_multisort($arr, SORT_ASC, $oscTemplate->_data[$this->group]);

      $output = '<div class="col-sm-12">';

      foreach ( $oscTemplate->_data[$this->group] as $group ) {
        $output .= '<h2>' . $group['title'] . '</h2>' .
                   '<div class="contentText">' .
                   '  <ul class="list-unstyled">';

        foreach ( $group['links'] as $entry ) {
          $output .= '    <li>';

          if ( isset($entry['icon']) ) {
            $output .= '<i class="' . $entry['icon'] . '"></i> ';
          }

          $output .= (tep_not_null($entry['link'])) ? '<a href="' . $entry['link'] . '">' . $entry['title'] . '</a>' : $entry['title'];
          
          $output .= '    </li>';
        }

        $output .= '  </ul>' .
                   '</div>';
      }

// BOF POINTS REWARDS BS //-->
    if (MODULE_HEADER_TAGS_POINTS_REWARDS_USE_POINTS_SYSTEM == 'True') {
      
    require('includes/languages/' . $language . '/modules/pages/tp_account.php');
		
	$output .= '<h2>' . TP_ACCOUNT_MY_POINTS_TITLE . '</h2>
           <div class="contentText">  
			  <ul class="list-unstyled">';

  $has_points = tep_get_shopping_points($customer_id);
  if ($has_points > 0) {
	  $output .= '<h4><span class="label label-info">' . sprintf(TP_ACCOUNT_MY_POINTS_CURRENT_BALANCE, number_format($has_points, MODULE_HEADER_TAGS_POINTS_REWARDS_POINTS_POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue($has_points))) . '</span></h4>';
  }
	$output .= '<li><i class="fa fa-plus"></i> <a href="' . tep_href_link('my_points.php', '', $request_type) . '">' . TP_ACCOUNT_MY_POINTS_VIEW . '</a></li>    
				<li><i class="fa fa-info-circle"></i> <a href="' . tep_href_link('my_points_help.php', '', $request_type) . '">' . TP_ACCOUNT_MY_POINTS_VIEW_HELP . '</a></li>
			  </ul>
           </div>'; 
  }
// EOF POINTS REWARDS BS //-->       

      $output .= '</div>';
      
      $oscTemplate->addContent($output, $this->group);
    }
  }
?>
