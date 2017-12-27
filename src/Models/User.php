<?php

namespace DUT\Models;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 * No further description given
 */
class User {
    
    /* ----- ----- ----- Attributes ----- ----- ----- */
    
    /**
     * @var int : User ID
     */
    protected $id;
    
    /**
     * @var string : Username
     */
    protected $username;
    
    /**
     * @var string : Hashed Password
     */
    protected $password;
    
    /**
     * @var int : Determines if the user is an Administrator
     */
    protected $admin;
        
    /**
     * @var Array<Comment> : Array of Comments of this User
     *
     * One User has Many Comments.
     * @OneToMany(targetEntity="Comment", mappedBy="user")
     */
    protected $comments;
    
    /* ----- ----- ----- Constructors ----- ----- ----- */
    
    /**
     * User's Constructor with values
     * @params : Class' attributes
     * @return null : This function returns nothing
     */
    public function __construct($username, $password, $admin = 0, $id = null) {
        
        $this->username = $username;
        $this->password = $password;
        $this->admin = $admin;
        
        $this->comments = new ArrayCollection();
    
    }
        
    /* ----- -----  ----- ----- Accessor(s) ----- -----  ----- ----- */
    
    /**
     * Accessor 'getID' : Returns the id of that User
     * @param null : This function needs no parameters
     * @return int
     */    
    public function getID() {
        
        return $this->id;
    }
    
    /**
     * Accessor 'getUsername' : Returns the username of that User
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getUsername() {
        
        return $this->username;
    }
    
    /**
     * Accessor 'getPassword' : Returns the password of that User
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getPassword() {
        
        return $this->password;
    }
    
    /**
     * Accessor 'getAdmin' : Returns the status of that User (admin = 1, user = 0)
     * @param null : This function needs no parameters
     * @return int
     */    
    public function getAdmin() {
        
        return $this->admin;
    }
    
    /**
     * Accessor 'getComments' : Returns the array of Comments linked to that User
     * @param null : This function needs no parameters
     * @return Array<Comment>
     */
    public function getComments() {
        
        return $this->comments;
    }
    
    /**
     * Accessor 'getNbComments' : Counts the number of Comments linked to that User
     * @param null : This function needs no parameters
     * @return int
     */
    public function getNbComments() {
        
        $nb_com = 0;
        foreach($this->comments as $com) { $nb_com++; }
        
        return $nb_com;
    }
    
    /* ----- -----  ----- ----- Mutator(s) ----- -----  ----- ----- */

    /**
     * Mutator 'setUsername' : Modify the username of that User
     * @param string $username : The new username of that User
     * @return null : This function returns nothing
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * Mutator 'setPassword' : Modify the password of that User
     * @param string $password : The new password of that User
     * @return null : This function returns nothing
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * Mutator 'setAdmin' : Modify the status of that User
     * @param int $admin : The new status of that User (admin = 1, user = 0)
     * @return null : This function returns nothing
     */
    public function setAdmin($admin) {
        
        if($admin == 1) { $this->username = 1; }
        
        else { $this->username = 0; }
    }
    
    /* ----- -----  ----- ----- Method(s) ----- -----  ----- ----- */
    
    /* CODE */
    
    /* ----- -----  ----- ----- End of Class ----- -----  ----- ----- */
    
}

// End of file ~ We do not close the PHP tag here, in order to avoid inserting invisible characters