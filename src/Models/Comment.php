<?php

namespace DUT\Models;

/**
 * Class Comment
 * No further description given
 */
class Comment {

    /* ----- -----  ----- ----- Attribute(s) ----- -----  ----- ----- */

    /**
     * @var int : Unique id of the comment
     */
    protected $id;

    /**
     * @var string : Date of creation of the comment, with European format (Day-Month-Year)
     */
    protected $date;

    /**
     * @var string : Raw content of the comment, containing text.
     */
    protected $content;

    /**
     * @var Blogpost : Blogpost which "owns"/"hosts" that comment
     *
     * Many Comments have One Blogpost.
     * @ManyToOne(targetEntity="Blogpost", inversedBy="comments")
     * @JoinColumn(name="id_post", referencedColumnName="id")
     */
    protected $blogpost;

    /**
     * @var User : User which wrote that comment
     *
     * Many Comments have One User.
     * @ManyToOne(targetEntity="User", inversedBy="comments")
     * @JoinColumn(name="id_user", referencedColumnName="id")
     */
    protected $user;

    /* ----- -----  ----- ----- Constructor(s) ----- -----  ----- ----- */

    /**
     * Comment's Constructor with values
     * @params : Class' attributes
     * @return null : This function returns nothing
     */
    public function __construct($content, $id = null){

        $this->date = date('Y-m-d H:i:s');

        $this->content = $content;

    }

    /* ----- -----  ----- ----- Accessor(s) ----- -----  ----- ----- */

    /**
     * Accessor 'getID' : Returns the id of that Comment
     * @param null : This function needs no parameters
     * @return int
     */    
    public function getID() {
        return $this->id;
    }

    /**
     * Accessor 'getDate' : Returns the date of that Comment, with the selected format
     * @param int $type : The wanted format (0 = DateTime (SQL), 1 = ISO, 2 = Human (Long), 3 = Human (Short))
     * @return string
     */    
    public function getDate($type) {

        if($type == 1) {

            $datetime = new \DateTime($this->date);
            $datetime = $datetime->format(\DateTime::ATOM); // Updated ISO8601

            return $datetime;

        }

        else if($type == 2) {

            $datetime = date('l \t\h\e jS \o\f F Y \a\t H:i', strtotime($this->date));

            return $datetime;

        }

        else if($type == 3) {

            $datetime = date('d-m-Y \a\t H:i', strtotime($this->date));

            return $datetime;

        }

        else { return $this->date; }

    }

    /**
     * Accessor 'getContent' : Returns the content of that Comment
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getContent() {
        return $this->content;
    }

    /**
     * Accessor 'getPost' : Returns the Post which hosts that Comment
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getPost() {
        return $this->blogpost;
    }

    /**
     * Accessor 'getUser' : Returns the author of that Comment
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getUser() {
        return $this->user;
    }

    /* ----- -----  ----- ----- Mutator(s) ----- -----  ----- ----- */
    
    /**
     * Mutator 'setCurrentDate' : Modify the date of that Comment with the actual date/time
     * @param null : This function needs no parameters
     * @return null : This function returns nothing
     */    
    public function setCurrentDate() {
                
        $this->date = date('Y-m-d H:i:s');
        
    }

    /**
     * Mutator 'setContent' : Modify the content of that Comment
     * @param string $content : The new content of that Comment
     * @return null : This function returns nothing
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Mutator 'setUser' : Modify the author which wrote that Comment
     * @param User $user : The new User related to that Comment
     * @return null : This function returns nothing
     */
    public function setUser($user) {
        $this->user = $user;
    }

    /**
     * Mutator 'setPost' : Modify the Post which hosts that Comment
     * @param Blogpost $post : The new Post hosting that Comment
     * @return null : This function returns nothing
     */
    public function setPost($post) {
        $this->blogpost = $post;
    }

    /* ----- -----  ----- ----- Method(s) ----- -----  ----- ----- */

    /* CODE */
    
    /* ----- -----  ----- ----- End of Class ----- -----  ----- ----- */
    
}

// End of file ~ We do not close the PHP tag here, in order to avoid inserting invisible characters