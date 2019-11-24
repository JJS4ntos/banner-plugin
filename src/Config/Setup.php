<?php
namespace App\Config;

use App\Controllers\Controller;

class Setup extends Controller{

  private $icon = 'dashicons-image-filter';

  /**
   * Call register functions to register pages and assets
   */
  public function __construct() {
    parent::__construct();
    add_action('wp_enqueue_scripts', array($this, 'register_assets') );
    add_action('admin_menu', array($this, 'page_setup') );
    add_action('admin_enqueue_scripts', array($this, 'register_assets_admin') );
    add_action('init', array($this, 'register_posts'));
    //$this->register_posts();
  }

  /**
   * Register menu link and plugin page
   * @param  string $icon [description]
   * @return
   */
  public function page_setup(){
    add_menu_page( PLUGIN_NAME, PLUGIN_NAME, 'manage_options', sanitize_key(PLUGIN_NAME), array($this, 'admin_page'), $this->icon, 3 );
  }

  /**
   * Register all commons plugin assets
   * @return
   */
  public function register_assets() {
    $js_folder = SD_PLUGIN_PATH . '/src/assets/js/';
    $css_folder = SD_PLUGIN_PATH . '/src/assets/css/';
    $scripts = scandir($js_folder);
    //var_dump($scripts);
    $styles = scandir($css_folder);
    foreach ($styles as $style) {
      if( !is_dir($style) ) {
        wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/css/' . $style);
      }
    }
    foreach ($scripts as $script) {
      if( !is_dir($script) ) {
        wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/js/' . $script);
      }
    }
  }

  /**
   * Register only assets that will be use in admin page
   * @return
   */
  public function register_assets_admin() {
    $js_folder = SD_PLUGIN_PATH . '/src/assets/admin/js/';
    $css_folder = SD_PLUGIN_PATH . '/src/assets/admin/css/';
    $scripts = scandir($js_folder);
    //var_dump($scripts);
    $styles = scandir($css_folder);
    foreach ($styles as $style) {
      if( !is_dir($style) ) {
        wp_enqueue_style( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/admin/css/' . $style);
      }
    }
    foreach ($scripts as $script) {
      if( !is_dir($script) ) {
        wp_enqueue_script( URL_SCOPE . mt_rand(0, 9000), '/wp-content/plugins/'.sanitize_key(PLUGIN_NAME).'/src/assets/admin/js/' . $script);
      }
    }
  }

  /**
   * Generate a view for admin page
   * @return [type] [description]
   */
  public function admin_page() {
     echo $this->generateView('index', []);
  }

  public function register_posts() {
    
    $labels = [
      'name'                  => _x( 'Banner', 'Post type general name', 'textdomain' ),
      'singular_name'         => _x( 'Banner', 'Post type singular name', 'textdomain' ),
      'menu_name'             => _x( 'Banners', 'Admin Menu text', 'textdomain' ),
      'name_admin_bar'        => _x( 'Banners', 'Add New on Toolbar', 'textdomain' ),
      'add_new'               => __( 'Criar novo Banner', 'textdomain' ),
      'add_new_item'          => __( 'Criar novo Banner', 'textdomain' ),
      'new_item'              => __( 'Novo Banner', 'textdomain' ),
      'edit_item'             => __( 'Editar Banner', 'textdomain' ),
      'view_item'             => __( 'Ver Banner', 'textdomain' ),
      'all_items'             => __( 'Todos os Banners', 'textdomain' ),
      'search_items'          => __( 'Procurar Banners', 'textdomain' ),
      'parent_item_colon'     => __( 'Banner pai:', 'textdomain' ),
      'not_found'             => __( 'Nenhum Banner encontrado.', 'textdomain' ),
      'not_found_in_trash'    => __( 'Nenhum Banner encontrado na lixeira.', 'textdomain' ),
      'featured_image'        => _x( 'Imagem do Banner', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'set_featured_image'    => _x( 'Selecione a imagem do Banner', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'remove_featured_image' => _x( 'Remover imagem do Banner', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'use_featured_image'    => _x( 'Usar como imagem do Banner', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
      'archives'              => _x( 'Arquivos do Banner', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
      'insert_into_item'      => _x( 'Inserir em Banner', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
      'uploaded_to_this_item' => _x( 'Upload para Banner', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
      'filter_items_list'     => _x( 'Filtrar lista de Banners', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
      'items_list_navigation' => _x( 'Navegação em lista de Banners', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
      'items_list'            => _x( 'Lista de Banners', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    ];
    $args = array(
      'labels'             => $labels,
      'public'             => false,
      'publicly_queryable' => false,
      'menu_icon'          => 'dashicons-groups',
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => false,
      'rewrite'            => array( 'slug' => 'banner' ),
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array('title'),
    );
    register_post_type('banner', $args);
  }

}

/**
 * Automatically start plugin after index.php
 * @var Setup
 */
$setup = new Setup();
