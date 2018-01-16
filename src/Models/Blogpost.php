<?php

namespace DUT\Models;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Blogpost
 * No further description given
 */
class Blogpost {
    
    /* ----- -----  ----- ----- Attribute(s) ----- -----  ----- ----- */
        
    /**
     * @var int : Unique id of the post
     */
    protected $id;
        
    /**
     * @var string : Date of creation of the post, with European format (Day-Month-Year)
     */
    protected $date;
        
    /**
     * @var string : Title of the post
     */
    protected $title;
        
    /**
     * @var string : Raw content of the post, containing text, links, etc.
     */
    protected $content;
        
    /**
     * @var string : Path to the image displayed on the Blogpost thumbnail (can be empty)
     */
    protected $image;
        
    /**
     * @var Array<Comment> : Array of Comments of this Blogpost
     *
     * One Blogpost has Many Comments.
     * @OneToMany(targetEntity="Comment", mappedBy="blogpost")
     */
    protected $comments;
    
    /* ----- -----  ----- ----- Constructor(s) ----- -----  ----- ----- */
    
    /**
     * Blogpost's Constructor with values
     * @params : Class' attributes
     * @return null : This function returns nothing
     */
    public function __construct($title, $content, $id = null, $image = null){
        
		//$this->date = date('Y-m-d H:i:s');
        $this->setCurrentDate();
        
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image = $image;
        
        $this->comments = new ArrayCollection();
        
    }
        
    /* ----- -----  ----- ----- Accessor(s) ----- -----  ----- ----- */
    
    /**
     * Accessor 'getID' : Returns the id of that Blogpost
     * @param null : This function needs no parameters
     * @return int
     */    
    public function getID() {
        
        return $this->id;
    }
    
    /**
     * Accessor 'getDate' : Returns the date of that Blogpost, with the selected format
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
     * Accessor 'getTitle' : Returns the title of that Blogpost
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getTitle() {
        
        return $this->title;
    }
    
    /**
     * Accessor 'getImage' : Returns the image of that Blogpost
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getImage() {
        
        return $this->image;
    }
    
    /**
     * Accessor 'getContent' : Returns the content of that Blogpost
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getContent() {
        
        return $this->content;
    }
    
    /**
     * Accessor 'getShortcontent' : Returns the first 300 chars of the content, without HTML tags (prevents for "bugs" like cutting in the middle of a tag (div, strong, ...))
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getShortcontent() {
        
        //$shortcontent = substr($this->content, 0, 300);
        $shortcontent = strip_tags($this->content);
        $shortcontent = substr($shortcontent, 0, 600);
        
        return $shortcontent;
    }
    
    /**
     * Accessor 'getComments' : Returns the array of Comments linked to that Blogpost
     * @param null : This function needs no parameters
     * @return Array<Comment>
     */
    public function getComments() {
        
        return $this->comments;
    }
    
    /**
     * Accessor 'getNbComments' : Counts the number of Comments linked to that Blogpost
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
     * Mutator 'setCurrentDate' : Modify the date of that Post with the actual date/time
     * @param null : This function needs no parameters
     * @return null : This function returns nothing
     */    
    public function setCurrentDate() {
                
        $this->date = date('Y-m-d H:i:s');
        
    }

    /**
     * Mutator 'setTitle' : Modify the title of that post
     * @param string $title : The new title of that post
     * @return null : This function returns nothing
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Mutator 'setContent' : Modify the content of that post
     * @param string $content : The new content of that post
     * @return null : This function returns nothing
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Mutator 'setImage' : Modify the image of that post
     * @param string $image : The new path to the image of that post
     * @return null : This function returns nothing
     */
    public function setImage($image) {
        $this->image = $image;
    }
    
    /* ----- -----  ----- ----- Method(s) ----- -----  ----- ----- */
    
    /* CODE */
    
    /* ----- -----  ----- ----- End of Class ----- -----  ----- ----- */
    
}

// End of file ~ We do not close the PHP tag here, in order to avoid inserting invisible characters