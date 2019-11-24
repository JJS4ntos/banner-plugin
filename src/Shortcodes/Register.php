<?php
namespace App\Shortcodes;

use App\Shortcodes\Names;

/*
*   Register shortcode and link to function in controller;
*/
class Register {

  use Names;

  /**
   * Install all shortcodes registred in names array
   */
  public function __construct() {
    foreach ($this->names as $name => $function) {
      $this->install($name, $function);
    }
  }

  /**
   * Install a shortcode
   * @param  String $name     Name of shortcode
   * @param  String $function Controller method that will render shortcode.
   * @return
   */
  public function install(String $name, String $function) {
    $meta = explode('@', $function);
    $class = 'App\\Controllers\\'.$meta[0];
    add_shortcode( $name, array( new $class, $meta[1] ) );
  }

}
