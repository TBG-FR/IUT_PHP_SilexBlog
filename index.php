<?php

/**
 * SILEX APPLICATION & REQUIREMENTS
 */

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$app = new Silex\Application();
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), [ 'twig.path' => __DIR__.'/views', ]);

/**
 * DATABASE INFORMATIONS
 */

$app['connection'] = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'dbname' => 'bdd',
    'charset'   => 'utf8'
];

$app['doctrine_config'] = Setup::createYAMLMetadataConfiguration([__DIR__ . '/config'], true);

$app['em'] = function ($app) { return EntityManager::create($app['connection'], $app['doctrine_config']); };

/**
 * ROUTES
 */
 
// ROUTE : Base ('/')
/*
$app->get('/', function() {
    $html = '<h1>ProjetWeb - TP3</h1>';
    $html .= ' <br/>/list 
				<br/>/create
				<br/>/remove/{i}
				<br/>/check/{i}';
    
    return new Response($html);
});*/

/* ===== ===== ===== Routes ~ BlogpostsController  ===== ===== ===== */
$app->get('/', 'DUT\\Controllers\\BlogpostsController::listPostsAction')
    ->bind('home');

$app->get('/post/{post_index}', 'DUT\\Controllers\\BlogpostsController::singlePostAction')
    ->bind('post');

$app->get('/post/{post_index}/comments', 'DUT\\Controllers\\BlogpostsController::listCommentsAction')
    ->bind('comments');

$app->get('/post/{post_index}/comments/{com_index}', 'DUT\\Controllers\\BlogpostsController::singleCommentAction')
    ->bind('comment');

/* ===== ===== ===== Routes ~ CommentsController  ===== ===== ===== */



/* ===== ===== ===== Routes & Co [Sujet]  ===== ===== ===== */
$app->get('/list_old', 'DUT\\Controllers\\ItemsController::listAction_OLD')
    ->bind('home_OLD');

$app->get('/create_old', 'DUT\\Controllers\\ItemsController::createAction_OLD');
$app->post('/create_old', 'DUT\\Controllers\\ItemsController::createAction_OLD');

$app->get('/remove_old/{index}', 'DUT\\Controllers\\ItemsController::deleteAction_OLD');

/* ===== ===== ===== TP2 - Exercice 3 : Lister les éléments  ===== ===== ===== */

$app->get('/list', 'DUT\\Controllers\\ItemsController::listAction')
    ->bind('homey');

$app->get('/create', 'DUT\\Controllers\\ItemsController::createAction');
$app->post('/create', 'DUT\\Controllers\\ItemsController::createAction');

$app->get('/remove/{index}', 'DUT\\Controllers\\ItemsController::deleteAction');

$app->get('/check/{index}', 'DUT\\Controllers\\ItemsController::checkAction');

/* ===== ===== ===== TP3 - Twig  ===== ===== ===== */

$app->get('/test/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});

$app->get('/test', function () use ($app) {
    return $app['twig']->render('hello.twig');
});

/**
 * RUN & DEBUG
 */
$app['debug'] = true;
$app->run();
