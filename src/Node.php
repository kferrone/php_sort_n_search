<?php 

class Node {
    
    /**
     * 
     * @var integer
     */
    public $key = 0;
    
    /**
     * 
     * @var string
     */
    public $value = null;
    
    /**
     * 
     * @var Node
     */
    public $left = null;
    
    /**
     * 
     * @var Node
     */
    public $right = null;
    
    /**
     * 
     * @var integer
     */
    public $n = 0;
    
    /**
     * 
     * @var boolean
     */
    public $color = TRUE;
    
    public function __construct($key,$value,$n,$color) {
        $this->key = $key;
        $this->value = $value;
        $this->n = $n;
        $this->color = $color;
    }
    
}