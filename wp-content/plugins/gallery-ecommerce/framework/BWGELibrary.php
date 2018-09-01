<?php

class BWGELibrary {
  ////////////////////////////////////////////////////////////////////////////////////////
  // Events                                                                             //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constants                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Variables                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Constructor & Destructor                                                           //
  ////////////////////////////////////////////////////////////////////////////////////////
  public function __construct() {
  }


  ////////////////////////////////////////////////////////////////////////////////////////
  // Public Methods                                                                     //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Getters & Setters                                                                  //
  ////////////////////////////////////////////////////////////////////////////////////////
  public static function get($key, $default_value = '') {
    if (isset($_GET[$key])) {
      $value = $_GET[$key];
    }
    elseif (isset($_POST[$key])) {
      $value = $_POST[$key];
    }
    else {
      $value = '';
    }
    if (!$value) {
      $value = $default_value;
    }
    return esc_html($value);
  }

  public static function message_id($message_id) {
    if ($message_id) {
      switch($message_id) {
        case 1: {
          $message = __('Item Succesfully Saved.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 2: {
          $message = __('Error. Please install plugin again.', 'bwge_back');
          $type = 'error';
          break;

        }
        case 3: {
          $message = __('Item Succesfully Deleted.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 4: {
          $message = __("You can't delete default theme", 'bwge_back');
          $type = 'error';
          break;

        }
        case 5: {
          $message = __('Items Succesfully Deleted.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 6: {
          $message = __('You must select at least one item.', 'bwge_back');
          $type = 'error';
          break;

        }
        case 7: {
          $message = __('The item is successfully set as default.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 8: {
          $message = __('Options Succesfully Saved.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 9: {
          $message = __('Item Succesfully Published.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 10: {
          $message = __('Items Succesfully Published.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 11: {
          $message = __('Item Succesfully Unpublished.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 12: {
          $message = __('Items Succesfully Unpublished.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 13: {
          $message = __('Ordering Succesfully Saved.', 'bwge_back');
          $type = 'updated';
          break;

        }
        case 14: {
          $message = __('A term with the name provided already exists.', 'bwge_back');
          $type = 'error';
          break;

        }
        case 15: {
          $message = __('Name field is required.', 'bwge_back');
          $type = 'error';
          break;

        }
        case 16: {
          $message = __('The slug must be unique.', 'bwge_back');
          $type = 'error';
          break;

        }
        case 17: {
          $message = __('Changes must be saved.', 'bwge_back');
          $type = 'error';
          break;

        }
      }
      return '<div style="width:99%"><div class="' . $type . '"><p><strong>' . $message . '</strong></p></div></div>';
    }
  }

  public static function message($message, $type) {
    return '<div style="width:99%"><div class="' . $type . '"><p><strong>' . $message . '</strong></p></div></div>';
  }

  public static function search($search_by, $search_value, $form_id) {
    ?>
    <div class="alignleft actions" style="clear:both;">
      <div class="alignleft" style="">
        <label for="search_value" style="font-size:14px;  display:inline-block;"><?php echo $search_by; ?>:</label>
        <input type="text" id="search_value" name="search_value"  onkeypress="return bwgeCheckSearchKey(event, this);" value="<?php echo esc_html($search_value); ?>" style="width: 287px;" />
      </div>
      <div class="alignleft actions wd-clear">
        <input type="button" value="" onclick="bwgeSearch('<?php echo  $form_id; ?>')" class="wd-search-btn">
        <input type="button" value="" onclick="bwgeReset('<?php echo  $form_id; ?>')" class="wd-reset-btn">
      </div>
    </div>
    <?php
  }

  public static function search_select($search_by, $search_select_id = 'search_select_value', $search_select_value, $playlists, $form_id) {
    ?>
    <div class="alignleft actions" style="clear:both;">
      <script>
        function bwge_spider_search_select() {
          document.getElementById("page_number").value = "1";
          document.getElementById("search_or_not").value = "search";
          document.getElementById("<?php echo $form_id; ?>").submit();
        }
      </script>
      <div class="alignleft actions" >
        <label for="<?php echo $search_select_id; ?>" style="font-size:14px; width:50px; display:inline-block;"><?php echo $search_by; ?>:</label>
        <select id="<?php echo $search_select_id; ?>" name="<?php echo $search_select_id; ?>" onchange="bwge_spider_search_select();" style="float: none; width: 150px;">
        <?php
          foreach ($playlists as $id => $playlist) {
            ?>
            <option value="<?php echo $id; ?>" <?php echo (($search_select_value == $id) ? 'selected="selected"' : ''); ?>><?php echo $playlist; ?></option>
            <?php
          }
        ?>
        </select>
      </div>
    </div>
    <?php
  }
  
  public static function html_page_nav($count_items, $pager, $page_number, $form_id, $items_per_page = 20) {
    $limit = $items_per_page;
    if ($count_items) {
      if ($count_items % $limit) {
        $items_county = ($count_items - $count_items % $limit) / $limit + 1;
      }
      else {
        $items_county = ($count_items - $count_items % $limit) / $limit;
      }
    }
    else {
      $items_county = 1;
    }
    if (!$pager) {
    ?>
    <script type="text/javascript">
      var items_county = <?php echo $items_county; ?>;
      function bwge_spider_page(x, y) {       
        switch (y) {
          case 1:
            if (x >= items_county) {
              document.getElementById('page_number').value = items_county;
            }
            else {
              document.getElementById('page_number').value = x + 1;
            }
            break;
          case 2:
            document.getElementById('page_number').value = items_county;
            break;
          case -1:
            if (x == 1) {
              document.getElementById('page_number').value = 1;
            }
            else {
              document.getElementById('page_number').value = x - 1;
            }
            break;
          case -2:
            document.getElementById('page_number').value = 1;
            break;
          default:
            document.getElementById('page_number').value = 1;
        }
        document.getElementById('<?php echo $form_id; ?>').submit();
      }
      function check_enter_key(e, that) {
        var key_code = (e.keyCode ? e.keyCode : e.which);
        if (key_code == 13) { /*Enter keycode*/
          if (jQuery(that).val() >= items_county) {
           document.getElementById('page_number').value = items_county;
          }
          else {
           document.getElementById('page_number').value = jQuery(that).val();
          }
          document.getElementById('<?php echo $form_id; ?>').submit();
        }
        return true;
      }
    </script>
    <?php } ?>
    <div class="tablenav-pages">
      <span class="displaying-num">
        <?php
        if ($count_items != 0) {
          echo $count_items; ?> item<?php echo (($count_items == 1) ? '' : 's');
        }
        ?>
      </span>
      <?php
      if ($count_items > $items_per_page) {
        $first_page = "first-page";
        $prev_page = "prev-page";
        $next_page = "next-page";
        $last_page = "last-page";
        if ($page_number == 1) {
          $first_page = "first-page disabled";
          $prev_page = "prev-page disabled";
          $next_page = "next-page";
          $last_page = "last-page";
        }
        if ($page_number >= $items_county) {
          $first_page = "first-page ";
          $prev_page = "prev-page";
          $next_page = "next-page disabled";
          $last_page = "last-page disabled";
        }
      ?>
      <span class="pagination-links">
        <a class="<?php echo $first_page; ?>" title="Go to the first page" href="javascript:bwge_spider_page(<?php echo $page_number; ?>,-2);">«</a>
        <a class="<?php echo $prev_page; ?>" title="Go to the previous page" href="javascript:bwge_spider_page(<?php echo $page_number; ?>,-1);">‹</a>
        <span class="paging-input">
          <span class="total-pages">
          <input class="current_page" id="current_page" name="current_page" value="<?php echo $page_number; ?>" onkeypress="return check_enter_key(event, this)" title="Go to the page" type="text" size="1" />
        </span> <?php echo __('of', 'bwge_back'); ?> 
        <span class="total-pages">
            <?php echo $items_county; ?>
          </span>
        </span>
        <a class="<?php echo $next_page ?>" title="Go to the next page" href="javascript:bwge_spider_page(<?php echo $page_number; ?>,1);">›</a>
        <a class="<?php echo $last_page ?>" title="Go to the last page" href="javascript:bwge_spider_page(<?php echo $page_number; ?>,2);">»</a>
        <?php
      }
      ?>
      </span>
    </div>
    <?php if (!$pager) { ?>
    <input type="hidden" id="page_number"  name="page_number" value="<?php echo ((isset($_POST['page_number'])) ? (int) $_POST['page_number'] : 1); ?>" />
    <input type="hidden" id="search_or_not" name="search_or_not" value="<?php echo ((isset($_POST['search_or_not'])) ? esc_html($_POST['search_or_not']) : ''); ?>"/>
    <?php
    }
  }
  public static function ajax_search($search_by, $search_value, $form_id, $label=true) {
    ?>
    <div class="alignleft actions" style="clear:both;">
      <script>
        function bwge_spider_search() {
          document.getElementById("page_number").value = "1";
          document.getElementById("search_or_not").value = "search";
          bwge_spider_ajax_save('<?php echo $form_id; ?>');
        }
        function bwge_spider_reset() {
          if (document.getElementById("search_value")) {
            document.getElementById("search_value").value = "";
          }
          bwge_spider_ajax_save('<?php echo $form_id; ?>');
        }        
        function check_search_key(e, that) {
          var key_code = (e.keyCode ? e.keyCode : e.which);
          if (key_code == 13) { /*Enter keycode*/
            bwge_spider_search();
            return false;
          }
          return true;
        }
      </script>
      <div class="alignleft actions" style="">
        <?php if($label == true){
        ?>
          <label for="search_value" style="font-size:14px; width:60px; display:inline-block;"><?php echo $search_by; ?>:</label>
        <?php
        }
        ?>
        <input type="text" id="search_value" name="search_value" class="bwge_spider_search_value" onkeypress="return check_search_key(event, this);" value="<?php echo esc_html($search_value); ?>" style="width: 150px;<?php echo (get_bloginfo('version') > '3.7') ? ' height: 28px;' : ''; ?>" placeholder="<?php echo $label == false ? $search_by : "";?>" />
      </div>
      <div class="alignleft actions">
        <input type="button" value="" onclick="bwge_spider_search()" class="wd-search-btn action">
        <input type="button" value="" onclick="bwge_spider_reset()" class="wd-reset-btn action">
      </div>
    </div>
    <?php
  }

  public static function ajax_html_page_nav($count_items, $page_number, $form_id, $items_per_page = 20, $pager = 0) {
    $limit = $items_per_page;

    if ($count_items) {
      if ($count_items % $limit) {
        $items_county = ($count_items - $count_items % $limit) / $limit + 1;
      }
      else {
        $items_county = ($count_items - $count_items % $limit) / $limit;
      }
    }
    else {
      $items_county = 1;
    }
    if (!$pager) {
    ?>
    <script type="text/javascript">
      var items_county = <?php echo $items_county; ?>;
      function bwge_spider_page(x, y) {
        switch (y) {
          case 1:
            if (x >= items_county) {
              document.getElementById('page_number').value = items_county;
            }
            else {
              document.getElementById('page_number').value = x + 1;
            }
            break;
          case 2:
            document.getElementById('page_number').value = items_county;
            break;
          case -1:
            if (x == 1) {
              document.getElementById('page_number').value = 1;
            }
            else {
              document.getElementById('page_number').value = x - 1;
            }
            break;
          case -2:
            document.getElementById('page_number').value = 1;
            break;
          default:
            document.getElementById('page_number').value = 1;
        }
        bwge_spider_ajax_save('<?php echo $form_id; ?>');
      }
      function check_enter_key(e, that) {
        var key_code = (e.keyCode ? e.keyCode : e.which);
        if (key_code == 13) { /*Enter keycode*/
          if (jQuery(that).val() >= items_county) {
           document.getElementById('page_number').value = items_county;
          }
          else {
           document.getElementById('page_number').value = jQuery(that).val();
          }
          bwge_spider_ajax_save('<?php echo $form_id; ?>');
          return false;
        }
       return true;		 
      }
    </script>
    <?php } ?>
    <div id="tablenav-pages" class="tablenav-pages">
      <span class="displaying-num">
        <?php
        if ($count_items != 0) {
          echo $count_items; ?> <?php echo __('item', 'bwge_back'); ?><?php echo (($count_items == 1) ? '' : 's');
        }
        ?>
      </span>
      <?php
      if ($count_items > $limit) {
        $first_page = "first-page";
        $prev_page = "prev-page";
        $next_page = "next-page";
        $last_page = "last-page";
        if ($page_number == 1) {
          $first_page = "first-page disabled";
          $prev_page = "prev-page disabled";
          $next_page = "next-page";
          $last_page = "last-page";
        }
        if ($page_number >= $items_county) {
          $first_page = "first-page ";
          $prev_page = "prev-page";
          $next_page = "next-page disabled";
          $last_page = "last-page disabled";
        }
      ?>
      <span class="pagination-links">
        <a class="<?php echo $first_page; ?>" title="Go to the first page" onclick="bwge_spider_page(<?php echo $page_number; ?>,-2)">«</a>
        <a class="<?php echo $prev_page; ?>" title="Go to the previous page" onclick="bwge_spider_page(<?php echo $page_number; ?>,-1)">‹</a>
        <span class="paging-input">
          <span class="total-pages">
          <input class="current_page" id="current_page" name="current_page" value="<?php echo $page_number; ?>" onkeypress="return check_enter_key(event, this)" title="Go to the page" type="text" size="1" />
        </span> <?php echo __('of', 'bwge_back'); ?> 
        <span class="total-pages">
            <?php echo $items_county; ?>
          </span>
        </span>
        <a class="<?php echo $next_page ?>" title="Go to the next page" onclick="bwge_spider_page(<?php echo $page_number; ?>,1)">›</a>
        <a class="<?php echo $last_page ?>" title="Go to the last page" onclick="bwge_spider_page(<?php echo $page_number; ?>,2)">»</a>
        <?php
      }
      ?>
      </span>
    </div>
    <?php if (!$pager) { ?>
    <input type="hidden" id="page_number" name="page_number" value="<?php echo ((isset($_POST['page_number'])) ? (int) $_POST['page_number'] : 1); ?>" />
    <input type="hidden" id="search_or_not" name="search_or_not" value="<?php echo ((isset($_POST['search_or_not'])) ? esc_html($_POST['search_or_not']) : ''); ?>"/>
    <?php
    }
  }

  public static function ajax_html_frontend_page_nav($theme_row, $count_items, $page_number, $form_id, $items_per_page, $current_view, $id, $cur_alb_gal_id = 0, $type = 'album', $enable_seo = false, $pagination = 1) {
    $limit = $page_number > 1 ? $items_per_page['load_more_image_count'] : $items_per_page['images_per_page'];
    $limit = $limit ? $limit : 1;
    $type = (isset($_POST['bwge_type' . $current_view]) ? esc_html($_POST['bwge_type' . $current_view]) : $type);
    $album_gallery_id = (isset($_POST['bwge_album_gallery_id_' . $current_view]) ? esc_html($_POST['bwge_album_gallery_id_' . $current_view]) : $cur_alb_gal_id);
    if ($count_items) {
      if ($count_items % $limit) {
        $items_county = ($count_items - $count_items % $limit) / $limit + 1;
      }
      else {
        $items_county = ($count_items - $count_items % $limit) / $limit;
      }
    }
    else {
      $items_county = 1;
    }
    if ($page_number > $items_county) {
      return;
    }
    $first_page = "first-page-" . $current_view;
    $prev_page = "prev-page-" . $current_view;
    $next_page = "next-page-" . $current_view;
    $last_page = "last-page-" . $current_view;
    ?>
    <span class="bwge_nav_cont_<?php echo $current_view; ?>">
    <?php
    if ($pagination == 1) {
      ?>
    <div class="tablenav-pages_<?php echo $current_view; ?>">
      <?php
      if ($theme_row->page_nav_number) {
      ?>
      <span class="displaying-num_<?php echo $current_view; ?>"><?php echo $count_items . __(' item(s)', 'bwge'); ?></span>
      <?php
      }
      if ($count_items > $limit) {
        if ($theme_row->page_nav_button_text) {
          $first_button = __('First', 'bwge');
          $previous_button = __('Previous', 'bwge');
          $next_button = __('Next', 'bwge');
          $last_button = __('Last', 'bwge');
        }
        else {
          $first_button = '«';
          $previous_button = '‹';
          $next_button = '›';
          $last_button = '»';
        }
        if ($page_number == 1) {
          $first_page = "first-page disabled";
          $prev_page = "prev-page disabled";
        }
        if ($page_number >= $items_county) {
          $next_page = "next-page disabled";
          $last_page = "last-page disabled";
        }
      ?>
      <span class="pagination-links_<?php echo $current_view; ?>">
        <a class="<?php echo $first_page; ?>" title="<?php echo __('Go to the first page', 'bwge'); ?>"><?php echo $first_button; ?></a>
        <a class="<?php echo $prev_page; ?>" title="<?php echo __('Go to the previous page', 'bwge'); ?>" <?php echo  $page_number > 1 && $enable_seo ? 'href="' . add_query_arg(array("bwge_page_number_" . $current_view => $page_number - 1), $_SERVER['REQUEST_URI']) . '"' : ""; ?>><?php echo $previous_button; ?></a>
        <span class="paging-input_<?php echo $current_view; ?>">
          <span class="total-pages_<?php echo $current_view; ?>"><?php echo $page_number; ?></span> <?php echo __('of', 'bwge'); ?> <span class="total-pages_<?php echo $current_view; ?>">
            <?php echo $items_county; ?>
          </span>
        </span>
        <a class="<?php echo $next_page ?>" title="<?php echo __('Go to the next page', 'bwge'); ?>" <?php echo  $page_number + 1 <= $items_county && $enable_seo ? 'href="' . add_query_arg(array("bwge_page_number_" . $current_view => $page_number + 1), $_SERVER['REQUEST_URI']) . '"' : ""; ?>><?php echo $next_button; ?></a>
        <a class="<?php echo $last_page ?>" title="<?php echo __('Go to the last page', 'bwge'); ?>"><?php echo $last_button; ?></a>
      </span>
      <?php
      }
      ?>
    </div>
      <?php
    }
    elseif ($pagination == 2) {
      if ($count_items > ($limit * ($page_number - 1)) + $items_per_page['images_per_page']) {
        ?>
		<div id="bwge_load_<?php echo $current_view; ?>" class="tablenav-pages_<?php echo $current_view; ?>">
			<a class="bwge_load_btn_<?php echo $current_view; ?> bwge_load_btn" href="javascript:void(0);"><?php echo __('Load More...', 'bwge'); ?></a>
			<input type="hidden" id="bwge_load_more_<?php echo $current_view; ?>" name="bwge_load_more_<?php echo $current_view; ?>" value="on" />
		</div>
    <?php
      }
    }
    elseif ($pagination == 3) {
      if ($count_items > $limit * $page_number) {
        ?>
		<script type="text/javascript">
		  jQuery(window).on("scroll", function() {
        if (jQuery(document).scrollTop() + jQuery(window).height() > (jQuery('#<?php echo $form_id; ?>').offset().top + jQuery('#<?php echo $form_id; ?>').height())) {
          bwge_spider_page_<?php echo $current_view; ?>('', <?php echo $page_number; ?>, 1, true);
          jQuery(window).off("scroll");
          return false;
			  }
		  });
		</script>
    <?php
      }
    }
    ?>
    <input type="hidden" id="bwge_page_number_<?php echo $current_view; ?>" name="bwge_page_number_<?php echo $current_view; ?>" value="<?php echo ((isset($_POST['bwge_page_number_' . $current_view])) ? (int) $_POST['bwge_page_number_' . $current_view] : 1); ?>" />
    <script type="text/javascript">
      function bwge_spider_page_<?php echo $current_view; ?>(cur, x, y, load_more) {
        if (typeof load_more == "undefined") {
          var load_more = false;
        }
        if (jQuery(cur).hasClass('disabled')) {
          return false;
        }
        var items_county_<?php echo $current_view; ?> = <?php echo $items_county; ?>;
        switch (y) {
          case 1:
            if (x >= items_county_<?php echo $current_view; ?>) {
              document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = items_county_<?php echo $current_view; ?>;
            }
            else {
              document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = x + 1;
            }
            break;
          case 2:
            document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = items_county_<?php echo $current_view; ?>;
            break;
          case -1:
            if (x == 1) {
              document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = 1;
            }
            else {
              document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = x - 1;
            }
            break;
          case -2:
            document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = 1;
            break;
          default:
            document.getElementById('bwge_page_number_<?php echo $current_view; ?>').value = 1;
        }
        bwge_spider_frontend_ajax('<?php echo $form_id; ?>', '<?php echo $current_view; ?>', '<?php echo $id; ?>', '<?php echo $album_gallery_id; ?>', '', '<?php echo $type; ?>', 0, '', '', load_more);
      }
      jQuery(document).ready(function() {
        jQuery('.<?php echo $first_page; ?>').on('click', function() {
          bwge_spider_page_<?php echo $current_view; ?>(this, <?php echo $page_number; ?>, -2);
        });
        jQuery('.<?php echo $prev_page; ?>').on('click', function() {
          bwge_spider_page_<?php echo $current_view; ?>(this, <?php echo $page_number; ?>, -1);
          return false;
        });
        jQuery('.<?php echo $next_page; ?>').on('click', function() {
          bwge_spider_page_<?php echo $current_view; ?>(this, <?php echo $page_number; ?>, 1);
          return false;
        });
        jQuery('.<?php echo $last_page; ?>').on('click', function() {
          bwge_spider_page_<?php echo $current_view; ?>(this, <?php echo $page_number; ?>, 2);
        });
        jQuery('.bwge_load_btn_<?php echo $current_view; ?>').on('click', function() {
          bwge_spider_page_<?php echo $current_view; ?>(this, <?php echo $page_number; ?>, 1, true);
          return false;
        });
      });
    </script>
    </span>
    <?php
  }

  public static function ajax_html_frontend_search_box($form_id, $current_view, $cur_gal_id, $images_count, $search_box_width = 180, $placeholder = '') {
    $bwge_search = ((isset($_POST['bwge_search_' . $current_view]) && esc_html($_POST['bwge_search_' . $current_view]) != '') ? esc_html($_POST['bwge_search_' . $current_view]) : '');	
    $type = (isset($_POST['bwge_type' . $current_view]) ? esc_html($_POST['bwge_type' . $current_view]) : 'album');
    $album_gallery_id = (isset($_POST['bwge_album_gallery_id_' . $current_view]) ? esc_html($_POST['bwge_album_gallery_id_' . $current_view]) : 0);
    ?>
    <style>
      .bwge_search_container_1 {
        display: inline-block;
        width: 100%;
        text-align: right;
        margin: 0 5px 20px 5px;
        background-color: rgba(0,0,0,0);
      }
      .bwge_search_container_2 {
        display: inline-block;
        position: relative;
        border-radius: 4px;
        box-shadow: 0 0 3px 1px #CCCCCC;
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        width: <?php echo $search_box_width; ?>px;
        max-width: 100%;
      }
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_search_input_container {
        display: block;
        margin-right: 45px;
      }
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_search_loupe_container {
        display: inline-block; 
        margin-right: 1px;
        vertical-align: middle;
        float: right;
        padding-top: 3px;
      }
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_search_reset_container {
        display: inline-block;
        margin-right: 5px;
        vertical-align: middle;
        float: right;
        padding-top: 3px;
      }
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_search,
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_reset {
        font-size: 18px;
        color: #CCCCCC;
        cursor: pointer;
      }
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_search_input_<?php echo $current_view; ?>,
      #bwge_search_container_1_<?php echo $current_view; ?> #bwge_search_container_2_<?php echo $current_view; ?> .bwge_search_input_<?php echo $current_view; ?>:focus {
        color: hsl(0, 1%, 3%);
        outline: none;
        border: none;
        box-shadow: none;
        background: none;
        padding: 0 5px;
        font-family: inherit;
        width: 100%;
      }
    </style>
    <script type="text/javascript">
      function clear_input_<?php echo $current_view; ?> (current_view) {
        jQuery("#bwge_search_input_" + current_view).val('');
      }
      function check_enter_key(e) {
        var key_code = e.which || e.keyCode;
        if (key_code == 13) {
          bwge_spider_frontend_ajax('<?php echo $form_id; ?>', '<?php echo $current_view; ?>', '<?php echo $cur_gal_id; ?>', <?php echo $album_gallery_id; ?>, '', '<?php echo $type; ?>', 1);
          return false;
        }
        return true;
      }
    </script>
    <div class="bwge_search_container_1" id="bwge_search_container_1_<?php echo $current_view; ?>">
      <div class="bwge_search_container_2" id="bwge_search_container_2_<?php echo $current_view; ?>">
        <span class="bwge_search_reset_container" >
          <i title="<?php echo __('Reset', 'bwge'); ?>" class="bwge_reset fa fa-times" onclick="clear_input_<?php echo $current_view; ?>('<?php echo $current_view; ?>'),bwge_spider_frontend_ajax('<?php echo $form_id; ?>', '<?php echo $current_view; ?>', '<?php echo $cur_gal_id; ?>', <?php echo $album_gallery_id; ?>, '', '<?php echo $type; ?>', 1)"></i>
        </span>
        <span class="bwge_search_loupe_container" >
          <i title="<?php echo __('Search', 'bwge'); ?>" class="bwge_search fa fa-search" onclick="bwge_spider_frontend_ajax('<?php echo $form_id; ?>', '<?php echo $current_view; ?>', '<?php echo $cur_gal_id; ?>', <?php echo $album_gallery_id; ?>, '', '<?php echo $type; ?>', 1)"></i>
        </span>
        <span class="bwge_search_input_container">
          <input id="bwge_search_input_<?php echo $current_view; ?>" class="bwge_search_input_<?php echo $current_view; ?>" type="text" onkeypress="return check_enter_key(event)" name="bwge_search_<?php echo $current_view; ?>" value="<?php echo $bwge_search; ?>" placeholder="<?php echo $placeholder; ?>" />
          <input id="bwge_images_count_<?php echo $current_view; ?>" class="bwge_search_input" type="hidden" name="bwge_images_count_<?php echo $current_view; ?>" value="<?php echo $images_count; ?>" >
        </span>
      </div>
    </div>
    <?php
  }

  public static function ajax_html_frontend_search_tags($form_id, $current_view, $cur_gal_id, $images_count, $tags_rows) {
    $type = (isset($_POST['bwge_type' . $current_view]) ? esc_html($_POST['bwge_type' . $current_view]) : 'album');
    $bwge_search_tags = (isset($_POST['bwge_tag_id_' . $cur_gal_id]) && $_POST['bwge_tag_id_' . $cur_gal_id] != '' )? $_POST['bwge_tag_id_' . $cur_gal_id] : array();	
    $album_gallery_id = (isset($_POST['bwge_album_gallery_id_' . $current_view]) ? esc_html($_POST['bwge_album_gallery_id_' . $current_view]) : 0);
    ?>
    <style>
      #bwge_tag_wrap{
        width: 100%;
        font-family: inherit;
        margin:0 -5px 20px 5px;
        z-index:200;
        position:relative
      }
      .bwge_search_loupe_container,.bwge_search_reset_container{
        font-size: 18px;
        color: #CCCCCC;
        cursor: pointer;
        position: relative;
        top: -4px;
      }
      #bwge_tag_container p{
        text-align:center
      }
      #bwge_tag_container {
        border: 1px solid #CCCCCC;
        box-shadow: 0 0 3px 1px #CCCCCC;
        border-radius: 4px;
        width:256px;
        float:right;
        background: #fff;
      }
    </style>
	  <div id="bwge_tag_wrap" >
      <div id="bwge_tag_container">
        <select class="search_tags" id="bwge_tag_id_<?php echo $cur_gal_id;  ?>" multiple="multiple" >		 
        <?php                 
          foreach($tags_rows as $tags_row){
            $selected = (in_array($tags_row->term_id ? $tags_row->term_id : '' ,$bwge_search_tags))	? 'selected="selected"' : "";
        ?>     
          <option value="<?php echo $tags_row->term_id ?>" <?php echo $selected;?>><?php echo $tags_row->name ?></option>
        <?php
          }
        ?>
        </select>
        <span class="bwge_search_loupe_container" >
          <i title="<?php echo __('Search', 'bwge'); ?>" class="bwge_search fa fa-search" onclick="select_tag('<?php echo $current_view; ?>' ,'<?php echo $form_id; ?>', '<?php echo $cur_gal_id; ?>', <?php echo $album_gallery_id; ?>,'<?php echo $type; ?>');"></i>
        </span>
        <span class="bwge_search_reset_container" >
          <i title="<?php echo __('Reset', 'bwge'); ?>" class="bwge_reset fa fa-times" onclick="clear_input_<?php echo $cur_gal_id; ?>('<?php echo $cur_gal_id; ?>'),bwge_spider_frontend_ajax('<?php echo $form_id; ?>', '<?php echo $current_view; ?>', '<?php echo $cur_gal_id; ?>', <?php echo $album_gallery_id; ?>, '', '<?php echo $type; ?>', 1)"></i>
        </span>
        <input type="hidden" id="bwge_tags_id_<?php echo $cur_gal_id;  ?>" value=""/>
      </div>
      <div style="clear:both"></div>
    </div>
    <script>
      jQuery(".search_tags").SumoSelect();
      function select_tag( current_view, form_id, cur_gal_id, album_gallery_id, type ){
        bwge_spider_frontend_ajax(form_id, current_view, cur_gal_id, album_gallery_id, '', type, 1);
      };	  
      function clear_input_<?php echo $cur_gal_id; ?> (cur_gal_id) {
        jQuery("#bwge_tag_id_" + cur_gal_id).val('');
      } 
      function searchTags(obj){
        var valthis = jQuery(obj).val().toLowerCase();
        var num = 0;
        jQuery('#bwge_tag_container .options li label').each(function () {
          var text = jQuery(this).text().toLowerCase();
          if(text.indexOf(valthis) != -1) { 
          jQuery(this).closest("li").show();
          } 
          else{ 
          jQuery(this).closest("li").hide();
          }
        });	 
      }
    </script>
    <?php
  }

  public static function ajax_html_frontend_sort_box($form_id, $current_view, $cur_gal_id, $sort_by = '', $search_box_width = 180) {
    $bwge_search = ((isset($_POST['bwge_search_' . $current_view]) && esc_html($_POST['bwge_search_' . $current_view]) != '') ? esc_html($_POST['bwge_search_' . $current_view]) : '');	
    $type = (isset($_POST['bwge_type' . $current_view]) ? esc_html($_POST['bwge_type' . $current_view]) : 'album');
    $album_gallery_id = (isset($_POST['bwge_album_gallery_id_' . $current_view]) ? esc_html($_POST['bwge_album_gallery_id_' . $current_view]) : 0);
    ?>
    <style>
      .bwge_order_cont_<?php echo $current_view; ?> {
        background-color: rgba(0,0,0,0);
        display: block;
        margin: 0 5px 20px 5px;
        text-align: right;
        width: 100%;
      }
      .bwge_order_label_<?php echo $current_view; ?> {
        border: none;
        box-shadow: none;
        color: #BBBBBB;
        font-family: inherit;
        font-weight: bold;
        outline: none;
      }
      .bwge_order_<?php echo $current_view; ?> {
        background-color: #FFFFFF;
        border: 1px solid #CCCCCC;
        box-shadow: 0 0 3px 1px #CCCCCC;
        border-radius: 4px;
        max-width: 100%;
        width: <?php echo $search_box_width; ?>px;
      }
    </style>
    <div class="bwge_order_cont_<?php echo $current_view; ?>">
      <span class="bwge_order_label_<?php echo $current_view; ?>"><?php echo __('Order by: ', 'bwge'); ?></span>
      <select class="bwge_order_<?php echo $current_view; ?>" onchange="bwge_spider_frontend_ajax('<?php echo $form_id; ?>', '<?php echo $current_view; ?>', '<?php echo $cur_gal_id; ?>', <?php echo $album_gallery_id; ?>, '', '<?php echo $type; ?>', 1, '', this.value)">
        <option <?php if ($sort_by == 'default') echo 'selected'; ?> value="default"><?php echo __('Default', 'bwge'); ?></option>
        <option <?php if ($sort_by == 'filename') echo 'selected'; ?> value="filename"><?php echo __('Filename', 'bwge'); ?></option>								
        <option <?php if ($sort_by == 'size') echo 'selected'; ?> value="size"><?php echo __('Size', 'bwge'); ?></option>
        <option <?php if ($sort_by == 'RAND()') echo 'selected'; ?> value="random"><?php echo __('Random', 'bwge'); ?></option>
      </select>
    </div>
    <?php
  }

  public static function bwge_spider_hex2rgb($colour) {
    if ($colour[0] == '#') {
      $colour = substr( $colour, 1 );
    }
    if (strlen($colour) == 6) {
      list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
    }
    else if (strlen($colour) == 3) {
      list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
    }
    else {
      return FALSE;
    }
    $r = hexdec($r);
    $g = hexdec($g);
    $b = hexdec($b);
    return array('red' => $r, 'green' => $g, 'blue' => $b);
  }

  public static function bwge_spider_redirect($url) {
    ?>
    <script>
      window.location = "<?php echo $url; ?>";
    </script>
    <?php
    exit();
  }

 /**
  *  If string argument passed, put it into delimiters for AJAX response to separate from other data.
  */

  public static function delimit_wd_output($data) {
    
    if(is_string ( $data )){
      return "WD_delimiter_start". $data . "WD_delimiter_end";
    }
    else{
      return $data;
    }
  }

  public static function verify_nonce($page){

    $nonce_verified = false;
    if ( isset( $_GET['bwge_nonce'] ) && wp_verify_nonce( $_GET['bwge_nonce'], $page )) {
      $nonce_verified = true;
    }
    elseif ( isset( $_POST['bwge_nonce'] ) && wp_verify_nonce( $_POST['bwge_nonce'], $page )) {
      $nonce_verified = true;
    }
    elseif ( isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], $page )) {
      $nonce_verified = true;
    }
    elseif ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], $page )) {
      $nonce_verified = true;
    }
    return $nonce_verified;
  }

  public static function bwge_spider_replace4byte($string) {
    return preg_replace('%(?:
          \xF0[\x90-\xBF][\x80-\xBF]{2}      # planes 1-3
        | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
        | \xF4[\x80-\x8F][\x80-\xBF]{2}      # plane 16
    )%xs', '', $string);    
  }

  public static function get_share_page() {
    $share_page = get_posts(array('post_type' => 'bwge_share'));
    if ($share_page) {
      return get_permalink(current($share_page));
    }
    else {
      $bwge_post_args = array(
        'post_title' => 'Image',
        'post_status' => 'publish',
        'post_type' => 'bwge_share'
      );
      $share_page = wp_insert_post($bwge_post_args);
      return get_permalink($share_page);
    }
  }
  public static function esc_script($method = '', $index = '', $default = '', $type = 'string') {
    if ($method == 'post') {
      $escaped_value = ((isset($_POST[$index]) && preg_match("/^[A-Za-z0-9_]+$/", $_POST[$index])) ? esc_js($_POST[$index]) : $default);
    }
    elseif ($method == 'get') {
      $escaped_value = ((isset($_GET[$index]) && preg_match("/^[A-Za-z0-9_]+$/", $_GET[$index])) ? esc_js($_GET[$index]) : $default);
    }
    else {
      $escaped_value = (preg_match("/^[a-zA-Z0-9]", $index) ? esc_js($index) : $default);
    }
    if ($type == 'int') {
      $escaped_value = (int) $escaped_value;
    }
    return $escaped_value;
  }  
  

  ////////////////////////////////////////////////////////////////////////////////////////
  // Private Methods                                                                    //
  ////////////////////////////////////////////////////////////////////////////////////////
  ////////////////////////////////////////////////////////////////////////////////////////
  // Listeners                                                                          //
  ////////////////////////////////////////////////////////////////////////////////////////
}