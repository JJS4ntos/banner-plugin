<?php
namespace App\Creator;

use App\Console\CreatorInterface as creator;

class ControllerCreator implements creator{

   /**
    * Create a controller based commands
    * @return
    */
   public function create() {
     global $argv;
     if( isset($argv[2]) ) {
        $name = ucwords($argv[2]);
        if( !strpos('Controller', $name) ) {
          $name = $name.'Controller';
        }
        $file = 'src/Controllers/'.$name.'.php';
        if( file_exists($file) ) {
          echo 'Controller already exist!' . PHP_EOL;
        } else {
          $controller = file_put_contents ( $file , $this->template(['className' => $name]) );
        }
     }

   }

   /**
    * Controller template
    * @param  array $args Params will be used in template
    * @return String      Class template
    */
   public function template(array $args) {
     return "<?php
namespace App\Controllers;

use App\Controllers\Controller;

class {$args['className']} extends Controller {

}";
   }

}
