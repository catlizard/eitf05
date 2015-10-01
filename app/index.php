<?php 
session_start();
define('APP_URL', '/eitf05/app'); 

// Autoload it all
require '../vendor/autoload.php';
require 'config/database.php'; 
require 'models/Database.php'; 

// Namespaces
use Philo\Blade\Blade;
use Carbon\Carbon;

use Klein\Klein; 

$base  = dirname($_SERVER['PHP_SELF']);

// Update request when we have a subdirectory
if (ltrim($base, '/')) {
    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

// Instantiate stuff
$faker = Faker\Factory::create();

// Directories for Blade
$views = __DIR__ . '/../app/views';
$cache = __DIR__ . '/../app/cache';

// Blade view engine
$blade = new Blade($views, $cache);

// Instantiate DB here
$db = new Database($databaseConfig); 

/** Routing */
$klein = new Klein();

// Separate the routes in its own file
require 'routes.php'; 

// Last thing to do: 
$klein->dispatch();