<?php
namespace App\Console;

/**
 * Default methods for the creators class
 * @var Interface
 */
interface CreatorInterface {

   public function create();

   public function template(array $args);

}
