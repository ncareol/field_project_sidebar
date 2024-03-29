<?php
/**
 * @file
 * Bartik's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * --$slogan_background_image: TRUE ATMOS SPECIFIC SETTING
 *   true if the site slogan as a background image is toggled on (default)
 *   Not possible to have slogan background image and slogan text enabled at
 *   the same time.  Background image takes precidence.
 *   
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see atmos_process_page()
 */
?>


<?php 
  if ($is_front) {
    drupal_add_css(drupal_get_path('theme','eol_external'). '/css/front.css');
  }	

?>


<!-- TOP NAV -->
<div id="header-wrap">
    <div id="navigation"><div class="align-center-wrapper">
    
    <?php print render($page['navigation']); ?>
    </div></div><!-- end navbar -->

<div id="header" class="clear-block>">
  <div class="section clearfix align-center-wrapper">
    <div id="header-sub-nav"></div>

<?php if (@$logo): ?>
    <div id="logo-floater">
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
      </a>
    </div>
<?php endif; ?>

<?php if (@$site_name || @$site_slogan || @$nsf_logo): ?>
    <div id="name-and-slogan"<?php
    // Hide if no name, no slogan, nor slogan background image
    if (@$hide_site_name && @$hide_site_slogan && !@$slogan_background_image && !@$nsf_logo) { print ' class="element-invisible"'; } 
    ?>>

<?php if (@$site_name): ?>
<?php if (@$title): ?>
      <div id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
        <strong>
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
        </strong>
      </div>
<?php else: /* Use h1 when the content title is empty */ ?>
      <h1 id="site-name"<?php if ($hide_site_name) { print ' class="element-invisible"'; } ?>>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></span></a>
      </h1>
<?php endif; ?>
<?php endif; ?>

<?php
  // Only allow the use of the slogan background image OR the site_slogan text, but not both.
if (@$nsf_logo){
  print '<div class="nsf-logo"><img src="'.base_path().$path_to_theme.'/images/nsf.png"/></div><!-- .slogan -->';
}
elseif (@$slogan_background_image){
  print '<div class="slogan"><img src="'.base_path().$path_to_theme.'/images/slogan.png"/></div><!-- .slogan -->';
}
elseif (@$site_slogan){
  ?>
      <div id="site-slogan"<?php if ($hide_site_slogan) { print ' class="element-invisible"'; } ?>>
        <?php print $site_slogan; ?>
      </div>
<?php
}
?>

    </div> <!-- /#name-and-slogan -->
<?php endif; ?>



<?php print render($page['header']); ?>
<?php  // if a user isn't logged in, display the login link

	if ($user->uid == 0) {
		$destination = current_path();

		$log_in_link = l('Log In', "user/login", array('query' => array('destination' => "$destination")) );
		print '<DIV id="user-login-link" >'. $log_in_link . '</DIV>';
	}
?>


  </div> <!-- /.section -->
</div> <!-- /#header -->
</div> <!-- /#header-wrap -->

<?php if (@$page['featured']): ?>
<div id="featured" class="clear-block"><div class="align-center-wrapper">
    <?php print render($page['featured']); ?>
</div></div> <!-- /featured -->
<?php endif; ?>

<div id="wrap">
  <div id="container" class="clear-block">


  <?php if (@$breadcrumb || @atmos_print_content_type_name($node)): ?>
    <!-- div class="internal-header" class="clear-block">
      <div class="breadcrumbs"><?php print $breadcrumb; ?></div>
      <h1><?php print @atmos_print_content_type_name($node); ?></h1>
    </div -->
<?php endif; ?>

    <div id="center-wrapper" class="clear-block">

      <?php if (@$page['highlighted']): ?>
        <div id="highlighted">
          <?php print render($page['highlighted']); ?>
        </div> <!-- /#highlighted -->
      <?php endif; ?>

      <?php if (@$page['sidebar_first']): ?>
        <div id="leftcol" class="sidebar">
          <?php print render($page['sidebar_first']); ?>
        </div> <!-- /#sidebar-first -->
      <?php endif; ?>

        <div id="center"><div id="squeeze"><div class="right-corner"><div class="left-corner">

        <?php if (@$messages): print '<div class="messages-wrap">' .$messages . '</div>'; endif; ?>
        <?php if (@$tabs): print '<div id="tabs-wrapper" class="clear-block">'. render($tabs) .'</div>'; endif; ?>
        <?php if (@$tabs2): print '<ul class="tabs secondary">'. render($tabs2) .'</ul>'; endif; ?>
        <?php if (@$action_links): print '<ul class="action-links">'. render($action_links) .'</ul>'; endif; ?>

      <?php if (@$page['help']): ?>
        <div id="help">
          <?php print render($page['help']); ?>
        </div> <!-- /#help -->
      <?php endif; ?>

      <?php print render($title_prefix); ?>




	<?php
		// try to determine the node we are on if it's not already loaded
		if(isset($node)){
		} else if (arg(0) == 'node' ) {
			$nid = arg(1);
			$node = node_load($nid);
		} else {
		}
		

		// determine if the page has a parent node or not.
		// if it does, then load the parent node
		if (isset($node) && $node) {
			if ($node->type == 'sidebar_content' || $node->type == 'sidebar_link') {
				$field_language = field_language('node', $node, 'field_s_c_parent_page'); 
				$parent_nid = $node->field_s_c_parent_page[$field_language][0]['target_id'];

				$parent_node = node_load($parent_nid);			
			} else if ($node->type == 'event') {
				$field_language = field_language('node', $node, 'field_event_calendar'); 
				
				if (isset($node->field_event_calendar[$field_language][0]['target_id'])) {
					$parent_nid = $node->field_event_calendar[$field_language][0]['target_id'];					
					$parent_node = node_load($parent_nid);
				} else {
					$parent_node = $node;				
				}				
			} else {
				$parent_node = $node;
			}

		} 			

		// If there are very few elements in the sidebar_second array, then there is no sidebar and we shouldn't EVER override the title
		if (sizeof($page['sidebar_second']) > 3 ) {
			$override_title = TRUE;
		} else {
			if (isset($parent_node) && $parent_node->type == 'field_project') {
				$override_title = TRUE;	
				
			} else {
				$override_title = FALSE;					
			}
		}


		$header_node_types = array("book", "field_project", "organization_facility", "observing_facility", "instrument", "software_package" );
		$hide_title_node_types = array("book", "field_project", "organization_facility", "instrument", "software_package" );

		$is_field_project_page = FALSE;

		if ($override_title && isset($node->field_full_name['und'][0])) {
			$title = $node->field_full_name['und'][0]['safe_value'];
		}

		if ($override_title && isset($node)) {
		 if (isset($node->type) && ($node->type == 'sidebar_content' || $node->type == 'sidebar_link' || $node->type == 'event') || in_array($node->type, $header_node_types)) {

			if ($parent_node->type == 'field_project') {
				$is_field_project_page = TRUE;	
			}

			$field_language = field_language('node', $parent_node, 'field_f_p_header_color');
			if ($parent_node && isset($parent_node->field_f_p_header_color) && isset($parent_node->field_f_p_header_color[$field_language])  ) {
				$header_color = $parent_node->field_f_p_header_color[$field_language]['0']['rgb'];
			} else {
				$header_color = '#a51901';
			}
			
			
			if ($header_color) {
				$header_style_css = "
					<style>
					h2, .block h2 {
						color: $header_color !important;
						border-bottom: 2px solid $header_color !important;
					}

					h1.title {
						color: $header_color !important;	
					}


					h2 a {
						color: $header_color !important;
						text-decoration: none !important;
					}

					h3 {
						color: $header_color !important;						
					}

					#parent-page-title a{
						color: $header_color !important;
					}

					.group-s-c-file-attachments, .group-f-p-files {
						margin-bottom: 15px;
						border: 2px solid $header_color;
						border-color: $header_color;
					}					

					.footer_column .block {
						background-color: #ddd;
					}

					</style>
				";
			}										
				
			if ($node->type == 'field_project') {
				$header_style_css .= "
					<style>
						.block {
							background-color: transparent !important;
						}

						#parent-page-title {
							margin-bottom: 0px;
						}						
				
						
						#center .content {
							margin-top: 0px;
							padding-top: 0px;
						}
					
						#titlebar {
							border-bottom: none !important;
						}

						.field-name-field-f-p-whats-new .field-items, .field-name-body .field-items {
							background-color: #fff !important;
							margin-top: 0px;
							margin-left: 0px;
							margin-right: 0px;
							padding: 10px 10px 10px 10px;
						}

						.field-name-field-f-p-whats-new .field-label, .field-name-body .field-label {
							border-bottom: 2px solid $header_color !important;
							text-decoration: none;
							color: $header_color;
						}

					</style>
				";					
			} else if (isset($node->field_banner_image) ){
				$header_style_css .= "
					<style>
						#titlebar {
							border-bottom: none !important;
						}
					</style>
				";

			} else {

				$header_style_css .= "
					<style>
						#titlebar {
							border-bottom: 2px solid $header_color !important;	
						}
					</style>
				";
			}
					
			print $header_style_css;	

				
			}					


			if (isset($parent_node->field_banner_image) && $parent_node->field_banner_image ) {
				$field_language = field_language('node', $parent_node, 'field_banner_image'); 

				$field_banner_image = $parent_node->field_banner_image[$field_language]['0'];

				if ($field_banner_image) {

					$img_url = $field_banner_image['uri'];  // the orig image uri
					if ($parent_node->type == 'field_project') {
						$style = 'page_banner';
					} else {
						$style = 'sidebar_banner';
					}


					$link_text = '<img src="' . image_style_url($style, $img_url) .'">';

					$link = l($link_text, 'node/'. $parent_node->nid, array('html' => TRUE));			
				}			
			} else {

				$link = l($parent_node->title, 'node/'. $parent_node->nid, array('html' => TRUE));			
			}

			if ($is_field_project_page) { 

				print "<div id=\"field_projects-links-containter\">" . render($page['parent_page_links']) . "</div>";
								
				print "<div id=\"parent-page-title\">$link</div>";
				
			}


		
	}


	$show_original_title = TRUE;
	if (isset($node->type)) {
		if (in_array($node->type, $hide_title_node_types)) {
			if ($override_title) {
				$show_original_title = FALSE;
			}			
		}	
	}
	?>





      <?php if ($title && $show_original_title): ?>

        <h1 class="title" id="page-title">
          <?php print $title; ?>
        </h1>
      <?php endif; ?>





      <?php print render($title_suffix); ?>

	
 

<?php
	// Very specific to UCAR Comm's content types.  Many content types have a subtitle field.  
	// In order to display it consistently and above the #titlebar, we call it out here.
	// NOTE: The content types need to set "Full node" to "Hidden" under 
	// admin/content/node-type/<CONTENT-TYPE>/display otherwise it will display twice.
	// node-news_feature_story.tpl.php nulls the field value, since we NEVER want to display it there
  if (@$node->field_subtitle[0]['value'] != ''){
    print '<h3 class="subtitle">'. $node->field_subtitle[0]['value'] .'</h3>';
  }
?>
  
          <div id="titlebar"></div>

          <a id="main-content"></a>
          <div class="clear-block">
          <?php print render($page['content'])?>
          </div>
          <div class="feed_icons">
          <?php print $feed_icons; ?>
          </div>

        </div></div></div></div> <!-- /.left-corner, /.right-corner, /#squeeze, /#center -->

    <?php if (@$page['sidebar_second']): ?>
        <div id="rightcol" class="sidebar">


			<?php 
				if ($override_title && ( ! $is_field_project_page) ) { 

					if (isset($link) && $link) {
						print "<div id=\"parent-page-title\">$link</div>";						
					}

					print "<div id=\"parent-page-links-containter\">" . render($page['parent_page_links']) . "</div>";
					
					print "<div style=\"clear:both;\"></div>";

				}
			?>
	
          <?php print render($page['sidebar_second']); ?>
        </div> <!-- /#rightcol -->
    <?php endif; ?>

  <?php if (@$page['content_footer']): ?>
    <div id="content-footer" class="clear-block">
      <?php print render($page['content_footer']); ?>
    </div> <!-- /#content_footer -->
  <?php endif; ?>

    </div> <!-- /center-wrapper -->
  
  <?php if (@$page['triptych_first'] || @$page['triptych_middle'] || @$page['triptych_last']): ?>
    <div id="triptych-columns" class="clear-block">
    <?php
    print '<div class="triptych_column triptych_left">';
      if($page['triptych_first']): print '<div class="triptych triptych_one">'. render($page['triptych_first']) . '</div>'; endif;
    print '</div><div class="triptych_column triptych_center">';
      if($page['triptych_middle']): print '<div class="triptych triptych_two">'. render($page['triptych_middle']) . '</div>'; endif;
    print '</div><div class="triptych_column triptych_right">';
      if($page['triptych_last']): print '<div class="triptych triptych_three">'. render($page['triptych_last']) . '</div>'; endif;
    print '</div>';
    ?>
    </div> <!-- /#triptych-columns -->
  <?php endif; ?>

  <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
    <div id="footer-columns" class="clear-block">
    <?php
      if($page['footer_firstcolumn']): print '<div class="footer_column"><div class="footer_one">'. render($page['footer_firstcolumn']) . '</div></div>'; endif;
      if($page['footer_secondcolumn']): print '<div class="footer_column"><div class="footer_two">'. render($page['footer_secondcolumn']) . '</div></div>'; endif;
      if($page['footer_thirdcolumn']): print '<div class="footer_column"><div class="footer_three">'. render($page['footer_thirdcolumn']) . '</div></div>'; endif;
      if($page['footer_fourthcolumn']): print '<div class="footer_column footer_column_last"><div class="footer_four">'. render($page['footer_fourthcolumn']) . '</div></div>'; endif;
    ?>
    </div> <!-- /#footer-columns -->
  <?php endif; ?>

  <?php if (@$page['footer']): ?>
    <div class="footernav">
      <?php print render($page['footer']); ?>
    </div> <!-- /#footernav -->
  <?php endif; ?>

  </div><!-- /#container -->
</div> <!-- /#wrap -->
<!-- /layout -->

