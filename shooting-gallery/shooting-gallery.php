<?php if(!defined('ABSPATH')) { die(); } // Include in all php files, to prevent direct execution
/**
 * Plugin Name: Shooting Gallery
 * Description: A sweet little gallery plugin
 * Author:
 * Author URI:
 * Version: 0.1.0
 * Text Domain: shooting-gallery
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 **/

include 'resources/bytes_image_uploader/bbytes_image_uploader.php';
include 'resources/sg-preview.php';

if( !class_exists('ShootingGallery') ) {
	class ShootingGallery {
		private static $version = '0.1.0';
		private static $_this;
		private $settings;
		public static function Instance() {
			static $instance = null;
			if ($instance === null) {
				$instance = new self();
			}
			return $instance;
		}
        
		private function __construct() {
			register_activation_hook( __FILE__, array( $this, 'register_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'register_deactivation' ) );
			// Stuff that happens on every page load, once the plugin is active
			$this->initialize_settings();
                        
			if( is_admin() && !( defined('DOING_AJAX') && DOING_AJAX ) ) {
				add_action( 'admin_init', array( $this, 'admin_init' ) );
				add_action( 'admin_menu', array( $this, 'admin_menu' ) );
				add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
				add_action( 'save_post', array( $this, 'save_post' ) );
			} else {
				add_filter( 'the_content', array( $this, 'the_content') );
				add_shortcode( 'shooting-gallery', array( $this, 'sg_shortcode' ) );
                add_action( 'wp_enqueue_scripts', 'include_scripts' );
                add_action( 'wp_enqueue_styles', 'include_styles' );
			}
		}

        
		// PUBLIC STATIC FUNCTIONS
		public static function get_version() {
			return ShootingGallery::$version;
		}
		// PRIVATE STATIC FUNCTIONS
		// PUBLIC FUNCTIONS
		public function register_activation( $plugin ) {
			// Stuff that only has to run once, on plugin activation
            
            $current = get_option( 'active_plugins' );
            $plugin = plugin_basename( trim( $plugin ) );

            if ( !in_array( $plugin, $current ) ) {
                $current[] = $plugin;
                sort( $current );
                do_action( 'activate_plugin', trim( $plugin ) );
                update_option( 'active_plugins', $current );
                do_action( 'activate_' . trim( $plugin ) );
                do_action( 'activated_plugin', trim( $plugin) );
            }

            return null;
		}
             
        
		public function register_deactivation() {
			// Clean up on deactivation
            
            $current = get_option( 'active_plugins' );
            $plugin = plugin_basename( trim( $plugin ) );
            
            if ( in_array( $plugin, $current ) ) {
                $current[] = $plugin;
                sort( $current );
                do_action( 'deactivate_plugin', trim( $plugin ) );
                update_options( 'deactivate_plugins', $current );
                do_action( 'deactivate_' . trim( $plugin ) );
                do_action( 'deactivated_plugin', trim( $plugin) );
            }
            
            return null;
		}
		public function admin_init() {
			// Register Settings Here
            
            // register_setting( , );
		}
		public function admin_menu() {
			add_options_page(
				__( 'Shooting Gallery Settings', 'shooting-gallery' ),
				__( 'Shooting Gallery', 'shooting-gallery' ),
				'manage_options',
				'shooting-gallery-admin',
				array( $this, 'options_page_callback' )
			);
		}
		public function options_page_callback() {
			// TODO: Implement options page
            // What would go on the options page?
            ?>
            <h1>Shooting Gallery</h1>
            <h2>Now you can add a photo gallery to any post!</h2>
            
            <?php
            // Give a preview of the plugin
            shooting_gallery_preview();
		}               
		public function add_meta_boxes() {           
            // Don't know what the loop was for if there is just one metabox      
            add_meta_box(
					'shooting_gallery_metabox',
					__( 'Shooting Gallery', 'shooting-gallery' ),
					array( $this, 'shooting_gallery_metabox' ),
					$type
            );
		}
		public function shooting_gallery_metabox( $object, $box ) {
			wp_nonce_field( basename( __FILE__ ), 'shooting_gallery_metabox_nonce' );
            // TODO: render the shooting gallery metabox
            ?>
             
            <p>Gallery will be displayed at the top of the post unless specified otherwise.</p>

            <form>                
                <input id="top" type="radio" value="0" name="position" checked><label for="top" style="margin-right:50px;">Top</label>
                
                <input id="middle" type="radio" value="1" name="position"><label for="middle" style="margin-right:50px;">Middle</label>
        
                <input id="bottom" type="radio" value="2" name="position"><label for="bottom" style="margin-right:50px;">Bottom</label>                
            </form>
                    
            <?php 
            
            bbytes_render_image_uploader("bbytes_image_uploader", $images, 10);
            
            //probably won't go here
            $position = $_POST['position'];
            if ($position == 1) {
                //middle of post 
            }
            elseif ($position == 2) {
                //bottom of post
            }
            else {
                //top of post
            }
                 
		}       
		public function save_post( $post_id ) {
			// TODO: save the metabox data
            
            if ( !isset( $_POST['shooting_gallery_metabox_nonce'] ) || !wp_verify_nonce( $_POST['shooting_gallery_metabox_nonce'], basename( __FILE__ ) ) )
                return $post_id;
            
            $post_type = get_post_type_object( $post->post_type );
            
            // check user privilege
            if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
                return $post_id;
            
            $new_meta_value = ( isset( $_POST['shooting-gallery'] ) ? sanitize_html_class( $_POST['shooting-gallery'] ) : '' );
            
            $meta_key = 'shooting_gallery_metabox';
            
            $meta_value = get_post_meta( $post_id, $meta_key, true );
            
            // create new save if there is no previous value
            if ( $new_meta_value && '' == $meta_value )
                add_post_meta( $post_id, $meta_key, $new_meta_value, true );
            // update if new value doesn't match old value
            elseif ( $new_meta_value && $new_meta_value != $meta_value )
                update_post_meta( $post_id, $meta_key, $new_meta_value );            
        }
		public function sg_shortcode( $atts, $content ) {
			// TODO: implement shortcode
            
            //get_post_meta( get_the_id(), 
            
            //return '[shooting-gallery]';
		}   
        public function the_content() {
                       
            //$content = '';
        }
        
        function include_scripts() {    
            wp_enqueue_script ( 'jquery' );

            // owl-carousel js  
            wp_enqueue_script( 'owl-carousel-js', plugins_url( 'owl-carousel-1.3.2/owl.carousel.min.js', __FILE__ ), array( 'jquery' ), NULL, false );

            // featherlight js
            wp_enqueue_script( 'featherlight-gallery-js', plugins_url( 'featherlight-1.5.0/featherlight.gallery.min.js', __FILE__), array( 'jquery' ), NULL, false );

            wp_enqueue_script( 'featherlight-js', plugins_url( 'featherlight-1.5.0/featherlight.min.js', __FILE__ ), array( 'jquery' ), NULL, false );
        }
        
        function include_styles() {
            // owl-carousel css
            wp_enqueue_script( 'owl-carousel-css', plugins_url( 'owl-carousel-1.3.2/owl.carousel.css' ) );

            wp_enqueue_script( 'owl-theme-css', plugins_url( 'owl-carousel-1.3.2/owl.theme.css' ) );

            wp_enqueue_script( 'owl-transitions-css', plugins_url( 'owl-carousel-1.3.2/owl.transitions.css' ) );

            // featherlight css
            wp_enqueue_script( 'featherlight-gallery-css', plugins_url( 'featherlight-1.5.0/featherlight.gallery.min.css' ) );

            wp_enqueue_script( 'featherlight-css', plugins_url( 'featherlight-1.5.0/featherlight.min.css' ) );
        }
        
		// PRIVATE FUNCTIONS
		private function initialize_settings() {
			$default_settings = array(
				'post_types' => array( 'post', 'page' ),
			);
			$this->settings = get_option( 'ShootingGallery_options', $default_settings );
		}
		private function get_setting( $key ) {
			if( $key && isset( $this->settings[$key] ) ) {
				return $this->settings['key'];
			}
			return null;
		}
	}
	ShootingGallery::Instance();
}