<?php
namespace App\Controllers;

use Jenssegers\Blade\Blade;

abstract class Controller {

  /**
   * Builder to generate views using blade
   * @var [type]
   */
  private $viewBuilder;

  /**
   * Instance viewBuilder and load pages cached
   */
  public function __construct() {
    $this->viewBuilder = new Blade( SD_PLUGIN_PATH . 'src/frontend', SD_PLUGIN_PATH . 'src/cache' );
  }

  /**
   * Generate a view using Blade
   * @param  String $page      Name of view file
   * @param  array  $variables Variables will be used in view
   * @return String            View generated html
   */
  protected function generateView(String $page, array $variables) {
    return $this->viewBuilder->make($page, $variables);
  }

}
