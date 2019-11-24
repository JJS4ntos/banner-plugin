<?php
namespace App\Creator;

use App\Console\CreatorInterface as creator;

class ModelCreator implements creator{


  /**
   * Create a model based commands
   * @return
   */
   public function create() {
     global $argv;
     if( isset($argv[2]) ) {
        $name = ucwords($argv[2]);
        $file = 'src/Models/'.$name.'.php';
        if( file_exists($file) ) {
          echo 'Model already exist!' . PHP_EOL;
        } else {
          $controller = file_put_contents ( $file , $this->template(['className' => $name]) );
        }
     }

   }

   /**
    * Create model template
    * @param  array $args Params will be used in template
    * @return String      Class template
    */
   public function template(array $args) {
     return "<?php
namespace App\Models;

use WP_Post;


class {$args['className']} extends WP_User {

}";
   }

}
