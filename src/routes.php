<?php
/**
 * Route controllers to execute functions according urls.
 */
namespace App;

use App\Controllers\RouterController;
use App\Shortcodes\Register;

$register = new Register();
$router = new RouterController();
