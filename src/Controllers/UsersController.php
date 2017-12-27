<?php

namespace DUT\Controllers;
use DUT\Models\User;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\Application;

//This should be a service, but it is complicated (Doctrine ORM with Silex, Entities, Repositories, etc...)
use UserManagement;

/**
 * @class UserController
 * Manages User related actions (Login, Register, ...)
 */
class UsersController {
    
    /**
     * Displays the Authentification page (Login/Register), based on if the user is logged or not
     */
    public function authAction(Application $app, Request $request) {
        
        // Gets the sent values form the form (the "request") or null if there is nothing
        $type = $request->get('type', null);
        $id = $request->get('username', null);
        $pass = $request->get('password', null);
        $pass_v = $request->get('password_verif', null);
        
        // IF the user is already logged => Display the user/admin homepage
        if($app['user']->isLogged()) { 
            
            if($app['user']->isAdmin()) {return $app['twig']->render('admin_home.twig', ['user' => $_SESSION['user']]); }
            else {return $app['twig']->render('user_home.twig', ['user' => $_SESSION['user']]); }
            
        }
        
        // ELSE (IF the user isn't logged)
        else {
            
            switch($type){

            // => Try to Log this User
            case "login":
                    
                    try { $_SESSION['user'] = UserManagement::constructByLogin($app, $id, $pass); }
                    
                    catch (Exception $e) {
                        
                        //echo $e->getMessage();
                        $_SESSION['errors'] = $e->getMessage();
                        
                        /*if($e->getMessage() == 'Err_BadCredentials') {                             
                            echo "<div class='notification alert alert-danger' role='alert'>Error : Wrong User/Password combination ! Please try again.</div>"; }
                        
                        else if ($e->getMessage() == 'Err_UnknownUsername') {
                            echo "<div class='notification alert alert-danger' role='alert'>Error : Unknown Username ! Please try again.</div>"; }*/
                        
                    }

                $url = $app['url_generator']->generate('home');
                return $app->redirect($url);

                break;

            // => Try to Register this User
            case "register":
                    
                    try { 
                        
                        
                        
                        if(UserManagement::constructByRegister($app, $id, $pass, $pass_v)) { $_SESSION['user'] = UserManagement::constructByLogin($app, $id, $pass);  }
                    
                    }
                    
                    catch (Exception $e) {
                        
                        //echo $e->getMessage();
                        $_SESSION['errors'] = $e->getMessage();
                        
                        /*if($e->getMessage() == 'Err_UsernameExists') {                             
                            echo "<div class='notification alert alert-danger' role='alert'>Error : Username already taken ! Please try again with another one.</div>"; }
                        
                        else if ($e->getMessage() == 'Err_PasswordMatch') {
                            echo "<div class='notification alert alert-danger' role='alert'>Error : Passwords aren't matching ! Please try again.</div>"; }
                        
                        else if ($e->getMessage() == 'Err_RegisterFail') {
                            echo "<div class='notification alert alert-danger' role='alert'>Error : Registering failed ! Please try again or Contact us.</div>"; }}*/
                        
                    }

                $url = $app['url_generator']->generate('home');
                return $app->redirect($url);

                break;

            // => Display the page (with errors if needed)
            default :

                /* TODO : Add error notification */
                if(isset($_SESSION['errors'])) { var_dump($_SESSION['errors']); }
                    
                return $app['twig']->render('user_auth.twig'/*, ['errors' => $errors]*/);                    
                    
            }
        
        }
    }
    
    /**
     * Disconnects the User and redirects him
     */
    public function logoutAction(Application $app) {
        
        $app['user']->disconnect();
        
        $url = $app['url_generator']->generate('home');            
        return $app->redirect($url);
        
    }

}