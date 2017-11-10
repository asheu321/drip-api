<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://aguspriyanto.net
 * @since      1.0.0
 *
 * @package    Drip_Api
 * @subpackage Drip_Api/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Drip_Api
 * @subpackage Drip_Api/admin
 * @author     Agus Priyanto <asheu321@gmail.com>
 */
class Drip_Api_Admin {

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

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Drip_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Drip_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/drip-api-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Drip_Api_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Drip_Api_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/drip-api-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Registers a new post type
	 * @uses $wp_post_types Inserts new post type object into the list
	 *
	 * @param string  Post type key, must not exceed 20 characters
	 * @param array|string  See optional args description above.
	 * @return object|WP_Error the registered post type object, or an error object
	 */
	public function create_post_type() {

		$labels = array(
			'name'               => __( 'Rules', 'drip-api' ),
			'singular_name'      => __( 'Rule', 'drip-api' ),
			'add_new'            => _x( 'Add New Rule', 'drip-api', 'drip-api' ),
			'add_new_item'       => __( 'Add New Rule', 'drip-api' ),
			'edit_item'          => __( 'Edit Rule', 'drip-api' ),
			'new_item'           => __( 'New Rule', 'drip-api' ),
			'view_item'          => __( 'View Rules', 'drip-api' ),
			'search_items'       => __( 'Search Rules', 'drip-api' ),
			'not_found'          => __( 'No Rules found', 'drip-api' ),
			'not_found_in_trash' => __( 'No Rules found in Trash', 'drip-api' ),
			'parent_item_colon'  => __( 'Parent Rules:', 'drip-api' ),
			'menu_name'          => __( 'Drip API', 'drip-api' ),
		);

		$args = array(
			'labels'              => $labels,
			'hierarchical'        => false,
			'taxonomies'          => array(),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => null,
			'menu_icon'           => null,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'has_archive'         => false,
			'query_var'           => false,
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'supports'            => array(
				'title',
			),
		);

		register_post_type( 'drip-api', $args );
	}

	public function settings_init() {
		
		// register a new setting
 		register_setting( 'gd_drip_api', 'gd_drip_api_options' );


		add_settings_section( 'gd_section_api', __( 'API Credentials' ), array( $this, 'gd_section_api' ), 'gd_drip_api' );

		add_settings_field( 'gd_settings_account_id', __( 'Account ID' ), array( $this, 'gd_settings_account_id' ), 'gd_drip_api', 'gd_section_api', array('label_for' => 'gd_drip_account_id', 'class' => 'gd_drip_account_id' ) );
		add_settings_field( 'gd_settings_api_token', __( 'API Token' ), array( $this, 'gd_settings_api_token' ), 'gd_drip_api', 'gd_section_api', array('label_for' => 'gd_drip_api_token', 'class' => 'gd_drip_api_token' ) );

	}

	public function admin_menu() {
		add_submenu_page(
	        'edit.php?post_type=drip-api',
	        'Settings',
	        'Settings',
	        'manage_options',
	        'drip-api-settings',
	        array( $this, 'drip_api_settings' )
	    );
	}

	public function drip_api_settings() {

		if ( ! current_user_can( 'manage_options' ) ) { return; }

		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'gd_drip_api_messages', 'gd_drip_api_message', __( 'Settings Saved.', 'drip-api' ), 'updated' );
		}

		// show error/update messages
		settings_errors( 'gd_drip_api_messages' );

		require_once 'partials/drip-api-admin-settings.php';
	}

	public function gd_section_api($args) {
		echo '<p id="' . esc_attr( $args['id'] ) . '">Find your Drip API credential <a href="#">here</a>.</p>';
	}

	public function gd_settings_account_id($args) {
		$options = get_option('gd_drip_api_options');
		?>
		<input type="text" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="gd_drip_api_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $options[$args['label_for']];?>">
		<?php
	}

	public function gd_settings_api_token($args) {
		$options = get_option('gd_drip_api_options');
		?>
		<input type="password" id="<?php echo esc_attr( $args['label_for'] ); ?>" name="gd_drip_api_options[<?php echo esc_attr( $args['label_for'] ); ?>]" value="<?php echo $options[$args['label_for']];?>">
		<?php
	}

	public function add_meta_boxes() {
		add_meta_box( 'test', 'Test Metabox', array( $this, 'metabox_content' ), 'drip-api', 'advanced', 'high' );
	}

	public function metabox_content( $post ) {
		# Use `get_post_meta()` to retrieve an existing value from the database and use the value for the form:

	    require_once 'partials/drip-api-metabox-content.php';

	    # Display the nonce hidden form field:
	    wp_nonce_field(
	        plugin_basename(__FILE__), // Action name.
	        'drip_api_meta_box'        // Nonce name.
	    );
	}

}
