<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.fiverr.com/junaidzx90
 * @since      1.0.0
 *
 * @package    Category_List_Slider
 * @subpackage Category_List_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Category_List_Slider
 * @subpackage Category_List_Slider/admin
 * @author     junaidzx90 <admin@easeare.com>
 */
class Category_List_Slider_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'cls_slider', [$this,'junu_category_slider_callback'] );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style('slickslider', plugin_dir_url( __FILE__ ) . 'slick_slider/slick.css', array(), '', 'all' );
		wp_enqueue_style('slicktheme', plugin_dir_url( __FILE__ ) . 'slick_slider/slick-theme.css', array(), '', 'all' );

		wp_register_style( 'carousel', plugin_dir_url( __FILE__ ) . 'css/carousel.css', array(), $this->version, 'all' );
		wp_register_style( 'full-width', plugin_dir_url( __FILE__ ) . 'css/full-width.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script('slickslider', plugin_dir_url(__FILE__) . 'slick_slider/slick.min.js', array('jquery'), '', true);
	}

	// Add taxonomy field
    public function add_term_image($taxonomy)
    {?>
        <div class="form-field term-group">
            <label for="txt_upload_image">Upload Image (List category slider)</label>
            <input type="text" name="txt_upload_image" id="txt_upload_image" value="" class="widefat">
            <input type="button" id="upload_image_btn" class="button" style="margin-top:5px" value="Upload image" />
        </div>
    <?php
    }

    // Edit taxonomy field
    public function edit_image_upload($term)
    {?>
        <div class="form-field term-group">
            <label for="">Upload Image (List category slider)</label>
            <input type="text" name="txt_upload_image" id="txt_upload_image" value="<?php echo get_term_meta($term->term_id, 'term_image', true) ?>" class="widefat">
            <input type="button" id="upload_image_btn" class="button" style="margin-top:5px" value="Upload image" />
        </div>
    <?php
    }

    // Save taxonomy
    public function save_term_image($term_id)
    {
        if (isset($_POST['txt_upload_image']) && $_POST['txt_upload_image'] != '') {
            $group = sanitize_text_field($_POST['txt_upload_image']);
            add_term_meta($term_id, 'term_image', $group);
        }
    }

    // update taxonomy
    public function update_image_upload($term_id)
    {
        if (isset($_POST['txt_upload_image']) && $_POST['txt_upload_image'] != '') {
            $group = sanitize_text_field($_POST['txt_upload_image']);
            update_term_meta($term_id, 'term_image', $group);
        }
    }
	 /*
     * Add script to admin footer for upload term media
     * @since 1.0.0
     */
    public function load_media()
    {
        wp_enqueue_media();
    }
    public function add_script()
    {
        if (isset($_GET['taxonomy']) && $_GET['taxonomy'] == get_option('list_slider_taxonomy','category')) {
			wp_register_script('category_media', plugin_dir_url(__FILE__) . 'js/category_media.js', array('jquery'), $this->version, true);
            wp_enqueue_script('category_media');
            wp_localize_script('category_media', 'meta_image',
                array(
                    'title' => 'Upload an Image',
                    'button' => 'Use this Image',
                )
            );
        }
    }
	
	// Our output
	public function junu_category_slider_callback($atts){
		$atts = shortcode_atts(
			array(
				'taxonomy' 	=> 'category',
				'order'    	=> 'DESC',
				'orderby' 	=> 'count',
				'current_category'    => 0,
				'style'               => 'carousel',
				'hierarchical'        => 1,
				'hide_empty' => true,
			), $atts, 'cls_slider'
		);

		if(!get_option('list_slider_taxonomy')){
			delete_option( 'list_slider_taxonomy' );
			add_option( 'list_slider_taxonomy', $atts['taxonomy'] );
		}else if(get_option('list_slider_taxonomy') !== $atts['taxonomy']){
			delete_option( 'list_slider_taxonomy' );
			add_option( 'list_slider_taxonomy', $atts['taxonomy'] );
		}

		ob_start();
		
		
		if($atts['style'] === 'carousel'){
			require_once plugin_dir_path( __FILE__ )."partials/carousel.php";
		}
		if($atts['style'] === 'single'){
			require_once plugin_dir_path( __FILE__ )."partials/full-width.php";
		}

		$output = ob_get_contents();
		ob_end_clean();
		return $output;

	}

}
