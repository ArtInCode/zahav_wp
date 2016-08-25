<?php
// Register style and JS.
add_action( 'wp_enqueue_scripts', 'register_plugin_styles' );

/**
 * Register style and JS.
 */
function register_plugin_styles() {

	$themeURI = get_template_directory_uri();
	// Styles 
	wp_register_style( 'bootstrap', $themeURI .'/css/bootstrap.min.css'  );
	wp_enqueue_style( 'bootstrap' );
	wp_register_style( 'main-style', $themeURI .'/style.css'  );
	wp_enqueue_style( 'main-style' );

	//Js

	
	wp_register_script('jquery.min', 
                        $themeURI . '/js/jquery.min.js', 
                        array ('jquery'),
                        false, false);
    
    wp_enqueue_script('jquery.min');

    wp_register_script('bootstrap-js', 
                        $themeURI . '/js/bootstrap.min.js', 
                        array('bootstrap'), 
                        false, false);
    
    wp_enqueue_script('bootstrap-js');
    wp_register_script('jquery.quiz.x', 
                        $themeURI . '/js/quiz.js', 
                        array ('jquery'),
                        false, false);
    
    wp_enqueue_script('jquery.quiz.x');

    
}




function wporg_add_options_submenu_page() {
     add_submenu_page(
          'options-general.php',          // admin page slug
          __( 'Site Labels', 'wporg' ), // page title
          __( 'Site Labels', 'wporg' ), // menu title
          'manage_options',               // capability required to see the page
          'trans_label',                // admin page slug, e.g. options-general.php?page=wporg_options
          'wporg_options_page'            // callback function to display the options page
     );
}
add_action( 'admin_menu', 'wporg_add_options_submenu_page' );
 
/**
 * Register the settings
 */
function wporg_register_settings() {
     register_setting(
          'trans_label',  // settings section
          'trans_item' // setting name
     );
}
add_action( 'admin_init', 'wporg_register_settings' );
 
/**
 * Build the options page
 */
function wporg_options_page() {
     if ( ! isset( $_REQUEST['settings-updated'] ) )
          $_REQUEST['settings-updated'] = false; ?>
 
     <div class="wrap">
 
          <?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
               <div class="updated fade"><p><strong><?php _e( 'Main Lables are saved!', 'wporg' ); ?></strong></p></div>
          <?php endif; ?>
           
          <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
           
          <div id="poststuff">
               <div id="post-body">
                    <div id="post-body-content-tarns" class="col-md-6">
                         <form method="post" action="options.php">
                              <?php settings_fields( 'trans_label' ); ?>
                              <?php $options = get_option( 'trans_item' ); ?>
                              <table class="form-table-trans">
                                    <tr valign="top">
                                        <td><label>Main Title</label></td>
                                        <td><input class="form-control" type="text" name="trans_item[main_title]" value="<?=$options['main_title']?>" /></td>
                                    </tr>
                                    <tr valign="top">
                                        <td><label>Contact Text</label></td>
                                        <td><input class="form-control" type="text" name="trans_item[contact_title]" value="<?=$options['contact_title']?>" /></td>
                                    </tr>
                                    <tr valign="top">
                                        <td><label>Flag Text</label></td>
                                        <td><input class="form-control" type="text" name="trans_item[flag_text]" value="<?=$options['flag_text']?>" /></td>
                                    </tr>
                                  	                                   
                                   <tr valign="top"><td colspan="2"> <input type="submit" value="save" class="btn btn-success"></td></tr>
                              </table>
                         </form>
                    </div> <!-- end post-body-content -->
               </div> <!-- end post-body -->
          </div> <!-- end poststuff -->
          <?php
      }