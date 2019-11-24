<?php

namespace App\Controllers;

class RouterController {

  /**
   * Execute a hook
   * @param  String $hook      Hook name
   * @param  function $callback Function will be executed
   * @return
   */
  public function hook(String $hook, String $callback) {
    $this->resolveHook($hook, $callback);
  }

  /**
   * Execute a controller method inside a hook
   * @param  String $hook      Hook name
   * @param  function $callback Function will be executed
   * @return
   */
  private function resolveHook($hook, $callback) {
    $meta = explode('@', $callback);
    $class = 'App\\Controllers\\'.$meta[0];
    $controller = new $class();
    add_action($hook, function() use($controller, $meta) {
      echo $controller->{$meta[1]}();
    });
  }

  /**
   * Capture GET request and execute a function
   * @param  String $url      Endpoint of request
   * @param  function $callback Function will be executed
   * @return
   */
  public function get(String $url, $callback){
    $this->resolveCallback($url, $callback, 'GET');
  }

  /**
   * Capture POST request and execute a function
   * @param  String $url      Endpoint of request
   * @param  function $callback Function will be executed
   * @return
   */
  public function post($url, $callback){
    $this->resolveCallback($url, $callback, 'POST');
  }

  /**
   * Register a admin page
   * @param  String $title    Title of page
   * @param  String $name     Name or slug of page
   * @param  String $callback Controller function like: Controller@my_admin_page
   * @return
   */
  public function register_admin_page(String $title, String $name, String $callback) {
    $meta = explode('@', $callback);
    $class = 'App\\Controllers\\'.$meta[0];
    $controller = new $class();
    add_action('admin_menu', function() use($title, $name, $controller, $meta) {
      add_submenu_page( sanitize_key(PLUGIN_NAME), PLUGIN_NAME, $title, 'manage_options', sanitize_key($name),  array( $controller, $meta[1] ) );
    });
  }

  /**
   * Register a callback based on endpoint and controller method
   * @param  String $url      Endpoint when requested execute function
   * @param  String $callback Controller function like: Controller@my_admin_page
   * @param  String $method   Type of request
   * @return
   */
  private function resolveCallback(String $url, String $callback, String $method){
    try {
      $meta = explode('@', $callback);
      $class = 'App\\Controllers\\'.$meta[0];
      $controller = new $class();
      add_action('rest_api_init', function() use($controller, $meta, $method, $url){
        register_rest_route(URL_SCOPE, $url, [
          'methods' => $method,
          'callback' => function()use($controller, $meta){return $controller->{$meta[1]}();}
        ]);
      });
    } catch (Exception $e) {
      die('Cannot read callback like that');
    }
  }

}
