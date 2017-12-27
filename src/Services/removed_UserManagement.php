<?php

/* Links to solve the issue (Usine Doctrine/EntityManager in Service with Silex/Doctrine ORM)
 * http://dflydev.com/projects/doctrine-orm-service-provider
 * https://github.com/dflydev/dflydev-doctrine-orm-service-provider
 * [DEAD] https://github.com/docteurklein/SilexServiceProviders
 * https://github.com/ooXei1sh/silex-ske-sandbox/tree/v0.1.4
 * https://stackoverflow.com/questions/15909096/silex-and-doctrine-orm?rq=1
 * https://stackoverflow.com/questions/15284837/silex-auth-system-with-doctrine-orm?rq=1
 * https://stackoverflow.com/questions/16029527/how-to-use-silex-with-doctrine-orm-entitymanager
 * https://matthiasnoback.nl/2014/05/inject-a-repository-instead-of-an-entity-manager/#factory-service
 * https://www.tomasvotruba.cz/blog/2017/10/16/how-to-use-repository-with-doctrine-as-service-in-symfony/
 * https://stackoverflow.com/questions/8342031/symfony2-use-doctrine-in-service-container
 * 
 * https://openclassrooms.com/forum/sujet/symfony2-utilisation-de-doctrine-dans-un-service
 * + see config/services.yml
 */

namespace DUT\Services;

use Silex\Application;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Silex\Provider\DoctrineServiceProvider;

session_start();

/**
 * @class UserManagement
 * Manages user instance(s), stored into PHP session
 */
class Removed_UserManagement {
    
    private $myrepository;

    /**
     * UserManagement's Constructor
     * @param null : This function needs no parameters
     * @return null : This function returns nothing
     */
    public function __construct($myrepository)
    {
        if (!isset($_SESSION['user'])) { $_SESSION['user'] = ''; }
        
        $this->myrepository = $myrepository ;
        var_dump($myrepository);
        
        $myrepository->getRepository('DUT\Models\User');        
        var_dump($myrepository);
    }

    /**
     * Method 'Disconnect' : UserManagement's Deconstructor
     * @param null : This function needs no parameters
     * @return null : This function returns nothing
     */
    public function disconnect($var) {

        unset($_SESSION['user']);

    }

    /**
     * User constructor by Login
     * @param string $login
     * @param string $pass
     * @return $user : This function returns an Instance of User
     */
    public static function constructByLogin($login, $pass) {

        // Récupérer les valeurs de la base de données
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\User');        
        $userRequested = $entityManager->find('DUT\\Models\\Blogpost', $login);

        if( is_null($userRequested) == false ) {

            if( $userRequested->getPassword() == /*hash(*/$pass/*)*/) {

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
    public static function constructByRegister($login, $pass, $pass_v) {

        // Récupérer les valeurs de la base de données
        $entityManager = $app['em'];
        $repository = $entityManager->getRepository('DUT\\Models\\User');        
        $userRequested = $entityManager->find('DUT\\Models\\Blogpost', $login);

        // If an User with the same Username has been found => Throw Exception
        if( is_null($userRequested) == false ) { throw new Exception('Err_UsernameExists'); }

        // Else, If the Password and the "Verification Password" aren't the same => Throw Exception
        else if ( $pass != $pass_v ) { throw new Exception('Err_PasswordMatch'); }

        // Else, add the User into the Database
        else {

            $userToAdd = new User($login, $pass);

            $entityManager->persist($newpost);
            $entityManager->flush();

        }

        // Insertion Verification
        if($entityManager->find('DUT\\Models\\Blogpost', $login) != null) { return true; }
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

    function isLogged() {

        if($_SESSION['user'] instanceof User) { return true; }

        else { return false; }

    }                   

    function isAdmin() { 

        if( $this->isLogged() && $_SESSION['user']->getAdmin() == 1) { return true; }

        else { return false; }

    }

}