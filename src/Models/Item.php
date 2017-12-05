<?php

namespace DUT\Models;

class Item {
    
    protected $id;
    protected $title;
    protected $check;
    
    public function __construct($title) {
        
        $this->title = $title;
        $this->check = 0;
        
    }
    
    public function getID() {
        
        return $this->id;
        
    }
    
    public function getTitle() {
        
        return $this->title;
        
    }
    
    public function getCheck() {
        
        return $this->check;
        
    }
    
    public function setCheck($state) {
        
        $this->check = $state;
        
    }
    
}