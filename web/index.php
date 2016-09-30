<?php
//Allow PHP's built-in server to serve our static content in local dev:
if (php_sapi_name() === 'cli-server' && is_file(__DIR__.'/static'.preg_replace('#(\?.*)$#','', $_SERVER['REQUEST_URI']))
   ) {
  return false;
}

// web/index.php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();


// Register Twig provider and define a path for twig templates
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

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


// Home page
$app->get('/', function() use($app) {
    return $app['twig']->render('index.html');
})->bind('index');


$app->get('/api/bearing/shaftsize/{queryType}', function($queryType) use ($toys) {
    // radial
    // 4point
    // angular
    return $queryType;
});

$app->get('/api/bearing/search/{insideRadius}', function($insideRadius) use ($toys) {
    return json_encode($toys);
});

$app->get('/api/bearing/search/{insideRadius}/{outsideRadius}', function($insideRadius, $outsideRadius) use ($toys) {
    return json_encode($toys);
});

// run
$app->run();
