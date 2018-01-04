<?php

/**
 * SILEX APPLICATION & REQUIREMENTS
 */

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Silex\Application\UrlGeneratorTrait;

//This should be a service, but it is complicated (Doctrine ORM with Silex, Entities, Repositories, etc...)
//use DUT\Models\UserManagement;

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
 * USER MANAGEMENT
 */
session_start();
$app['user'] = new UserManagement($app['em']);
var_dump($_SESSION['user']);

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
$app->get('/error', 'DUT\\Controllers\\BlogpostsController::errorAction')
    ->bind('error');

$app->get('/', 'DUT\\Controllers\\BlogpostsController::listPostsAction')
    ->bind('home');

$app->get('/post/{post_index}', 'DUT\\Controllers\\BlogpostsController::singlePostAction')
    ->bind('post');

$app->get('/post/{post_index}/comments', 'DUT\\Controllers\\BlogpostsController::listCommentsAction')
    ->bind('comments');

$app->get('/post/{post_index}/comments/{com_index}', 'DUT\\Controllers\\BlogpostsController::singleCommentAction')
    ->bind('comment');

/* ===== ===== ===== Routes ~ BlogpostsController - Admin ===== ===== ===== */

$app->get('/admin/posts', 'DUT\\Controllers\\BlogpostsController::listPostsShortAction')
    ->bind('admin-posts');
    //->before($app['user']->isAdmin());

$app->get('/admin/newpost', 'DUT\\Controllers\\BlogpostsController::newPostAction')
    ->bind('admin-new');
    //->before(isAdmin());

$app->post('/admin/newpost', 'DUT\\Controllers\\BlogpostsController::newPostAction')
    ->bind('admin-new-save');
    //->before(isAdmin());

$app->get('/post/{post_index}/{action}', 'DUT\\Controllers\\BlogpostsController::adminPostAction')
    ->bind('admin-action');
    //->before(isAdmin());

/* ===== ===== ===== Routes ~ CommentsController  ===== ===== ===== */

$app->get('/post/{post_index}/comments/new/', 'DUT\\Controllers\\BlogpostsController::newCommentAction');
    //->bind('admin-new');
    //->before(isAdmin());

$app->post('/post/{post_index}/comments/new/', 'DUT\\Controllers\\BlogpostsController::newCommentAction');
    //->bind('admin-new-save');
    //->before(isAdmin());

$app->get('/post/{post_index}/comments/{com_index}/{action}', 'DUT\\Controllers\\BlogpostsController::manageCommentAction');
    //->bind('admin-action');
    //->before(isAdmin());

/* ===== ===== ===== Routes ~ UsersController  ===== ===== ===== */


$app->get('/auth', 'DUT\\Controllers\\UsersController::authAction')
    ->bind('auth');
    //->before(isAdmin());

$app->post('/auth', 'DUT\\Controllers\\UsersController::authAction')
    ->bind('auth-try');
    //->before(isAdmin());

$app->get('/auth/logout', 'DUT\\Controllers\\UsersController::logoutAction')
    ->bind('auth-logout');
    //->before(isAdmin());


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

/*/--------------------------------------------------------------------------------/
 |--------- THIS SHOULD BE A SERVICE BUT IT IS REALLY COMPLICATED -----------------|
 | I know that this Class shouldn't be here... But that's the only way I found     |
 | Look at DUT\Services\removed_UserManagement.php for more informations !         |
 |---------------------------------------------------------------------------------|
*/

//namespace DUT\Services;
//
//use Silex\Application;
//use Doctrine\ORM\Tools\Setup;
//use Doctrine\ORM\EntityManager;
//use Silex\Provider\DoctrineServiceProvider;
use DUT\Models\User;

//session_start();

/**
 * @class UserManagement
 * Manages user instance(s), stored into PHP session
 */
class UserManagement {
    
    private $entityManager;

    /**
     * UserManagement's Constructor
     * @param null : This function needs no parameters
     * @return null : This function returns nothing
     */
    public function __construct($entityManager) {
        
        if (!isset($_SESSION['user'])) { $_SESSION['user'] = ''; }
        
        $this->entityManager = $entityManager;
    }

    /**
     * Method 'Disconnect' : UserManagement's Deconstructor
     * @param null : This function needs no parameters
     * @return null : This function returns nothing
     */
    public function disconnect() {

        unset($_SESSION['user']);

    }

    /**
     * User constructor by Login
     * @param string $login
     * @param string $pass
     * @return $user : This function returns an Instance of User
     */
    public static function constructByLogin($app, $login, $pass) {

        // Récupérer les valeurs de la base de données
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\User');        
        $userRequested = $repository->findOneBy(array('username' => $login));
        
        //throw new Exception($login . $pass . $userRequested->getUsername() . $userRequested->getPassword());

        if( is_null($userRequested) == false ) {

            if( $userRequested->getPassword() == $pass) { /* TODO : HASH */

                return $userRequested;
                /* TODO : SUCCESSFUL LOGIN MESSAGE */

            }

            else { throw new Exception('Err_BadCredentials'); }

        }

        else { throw new Exception('Err_UnknownUsername'); }

    }

    /**
     * User constructor by Registration
     * @param string $login
     * @param string $pass
     * @return boolean : Insertion status (true = successful)
     */
    public static function constructByRegister($app, $login, $pass, $pass_v) {

        // Récupérer les valeurs de la base de données
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\User');      
        $userRequested = $repository->findOneBy(array('username' => $login));

        // If an User with the same Username has been found => Throw Exception
        if( is_null($userRequested) == false ) { throw new Exception('Err_UsernameExists'); }

        // Else, If the Password and the "Verification Password" aren't the same => Throw Exception
        else if ( $pass != $pass_v ) { throw new Exception('Err_PasswordMatch'); }

        // Else, add the User into the Database
        else {

            $userToAdd = new User($login, $pass);
            var_dump($userToAdd);

            $entityManager->persist($userToAdd);
            $entityManager->flush();

        }

        // Insertion Verification
        if( $repository->findOneBy(array('username' => $login)) != null) { return true; }
        else { return false; }

    }

    public function isLogged() {

        if($_SESSION['user'] instanceof User) { return true; }

        else { return false; }

    }                   

    public function isAdmin() { 

        if( $this->isLogged() && $_SESSION['user']->getAdmin() == 1) { return true; }

        else { return false; }

    }

    /**
    * @author : Robin Frere (https://www.widee.fr/)
    *
    * Method 'hash' : Hashes the given string
    * @param string $password : The string to hash
    * @return string : The hashed string
    */
    private function hash($password) {

        //return md5($password); <= We could use this method

        $options = array(
            'salt' => 'Zbk6s2i!!?vs+_tM2-&-=mvTpW4ReC945VH64Vb9&7$+R2UxW6Gb!@6eH#7P' // Here we choose a code, making the encryption algorithm reversible
        );

        return password_hash($password, CRYPT_BLOWFISH, $options);
    }

}