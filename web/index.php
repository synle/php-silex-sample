<?php
// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// mainly to run local host
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

// ... definitions
$toys = array(
 '00001'=> array(
     'name' => 'Racing Car',
     'quantity' => '53',
     'description' => '...',
     'image' => 'racing_car.jpg',
 ),
 '00002' => array(
     'name' => 'Raspberry Pi',
     'quantity' => '13',
     'description' => '...',
     'image' => 'raspberry_pi.jpg',
 ),
);


$app->get('/', function() use ($toys) {
 return json_encode($toys);
});

// run
$app->run();
