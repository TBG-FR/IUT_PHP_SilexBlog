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
     * @param string $title
     * @param string $content
     * @param string $image [can be null]
     * @return null : This function returns nothing
     */
    public function __construct($title, $content, $id = null, $image = null){
        
        $this->date = date('Y-m-d H:i:s');
        
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

            $datetime = date('l jS \o\f F Y \a\t H:i', strtotime($this->date));

            return $datetime;

        }

        else if($type == 3) {

            $datetime = date('d-m-Y H:i', strtotime($this->date));

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
     * Accessor 'getContent' : Returns the content of that Blogpost
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getContent() {
        return $this->content;
    }
    
    /**
     * Accessor 'getShortcontent' : Returns the first 300 characters of that Blogpost's content
     * @param null : This function needs no parameters
     * @return string
     */    
    public function getShortcontent() {
        
        //$shortcontent = substr($this->content, 0, 300);
        $shortcontent = strip_tags($this->content);
        $shortcontent = substr($shortcontent, 0, 300);
        
        return $shortcontent;
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
    function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Mutator 'setContent' : Modify the content of that post
     * @param string $content : The new content of that post
     * @return null : This function returns nothing
     */
    function setContent($content) {
        $this->content = $content;
    }

    /**
     * Mutator 'setImage' : Modify the image of that post
     * @param string $image : The new path to the image of that post
     * @return null : This function returns nothing
     */
    function setImage($image) {
        $this->image = $image;
    }

//    
//    /**
//     * Mutator 'setTeacherID' : Modify the Owner of that QCM
//     * @param int $tid : The new Owner id of that QCM
//     * @return null : This function returns nothing
//     */
//    function setTeacherID($tid) {
//        $this->teacher_id = $tid;
//    }
//    /**
//     * Mutator 'setTitle' : Modify the title of that QCM
//     * @param string $title : The new title of that QCM
//     * @return null : This function returns nothing
//     */
//    function setTitle($title) {
//        $this->title = $title;
//    }
//    /**
//     * Mutator 'setTopic' : Modify the title of that QCM
//     * @param string $title : The new title of that QCM
//     * @return null : This function returns nothing
//     */
//    function setTopic($topic) {
//        $this->topic = $topic;
//    }
//    /**
//     * Mutator 'setLink' : Modify the link of that QCM
//     * @param string $link : The new link of that QCM
//     * @return null : This function returns nothing
//     */
//    function setLink($link) {
//        $this->link = $link;
//    }
//    
//    /**
//     * Mutator 'setQuestions' : Modify the answers array of that QCM
//     * @param array<Question> $questions : The new array of questions
//     * @return null : This function returns nothing
//     */
//    function setQuestions($questions) {
//        $this->questions = $questions;
//    }
//
//    /**
//     * Mutator 'setQuestion' : Modify a specific answer
//     * @param string $id : The id of the question to change
//     * @param string $question : The new question
//     * @return null : This function returns nothing
//     */
//    function setQuestion($id, $question) {
//        
//        //$this->question[$id] = new Question()
//    }
    
    /* ----- -----  ----- ----- Method(s) ----- -----  ----- ----- */
    
////    /**
////     * Function 'addQuestion' : to add a question to the QCM 
////     * @param Question $question
////     * @return null : This function returns nothing
////     */
//     function addQuestion($question){
//        $this->questions[]=$question;
//        
//    }
////    /**
////     * Function 'saveIntoDB' : to save the QCM into the Database 
////     * @param Database DB
////     * @return bool worked
////     */
////    private function saveIntoDB($DB){
////        
////        //CODE
////        
////        return true;
////    }
////    
////    /**
////     * Function 'correction' : to check the match between the subject and the answers
////     * @param QCM answeredQCM
////     * @return bool worked
////     */
////    private function correction($answeredQCM){
////        
////        //CODE
////        
////        return true;
////    }
////    
////    /**
////     * Function 'display' : to check the match between the subject and the answers
////     * @param null : This function needs no parameters
////     * @return null : This function returns nothing
////     */
//    public function display(){
//        echo '<h2>'.$this->title.'<h2>';
//        echo '<h3>'.$this->topic.'<h3></br>';
//        foreach ($this->questions as $question){
//            echo '</br>'.$question->getTitle().'</br>';
//            foreach($question->getAnswers() as $answer){
//                echo $answer->getProposition()."       ".$answer->getCorrect()."</br>";
//                
//            }
//        }
//        
//        
//    }
    
    
    /* ----- -----  ----- ----- End of Class ----- -----  ----- ----- */
}

// End of file ~ We don't close the PHP tag here, in order to avoid inserting invisible characters