<?php 

class RBT {
    
    public const RED = TRUE;
    public const BLACK = FALSE;
    
    /**
     * 
     * @var Node
     */
    private $root = null;
    
    /**
     * 
     * @param Node $root
     */
    public function __construct() {
        
    }
    
    /**
     * 
     * @param string $key;
     * @param integer $value
     */
    public function insert($key,$value) {
        $this->root = $this->put($this->root, $key, $value);
        $this->root->color = self::BLACK;
    }
    
    /**
     *
     * @param string $value
     */
    public function remove($value) {
        
    }
    
    /**
     *
     * @param string $value
     */
    public function find($value) {
        
    }
    
    public function print() {
        echo print_r($this->root);
    }
    
    /**
     * 
     * @param Node $node
     * @param integer $key
     * @param string $value
     * @return Node
     */
    private function put($node, $key, $value) {
        if (is_null($node)) return new Node($key, $value, 1, self::RED);
        
        $cmp = strcmp($node->key,$key);
        if ($cmp < 0) {
            $node->left = $this->put($node->left, $key, $value);
        }
        
        elseif ($cmp > 0) {
            $node->right = $this->put($node->right, $key, $value);
        }
        
        else {
            $node->value = $value;
        }
        
        if ($this->is_red($node->right) && (!$this->is_red($node->left))) $node = $this->rotate_left($node);
        if ($this->is_red($node->left) && $this->is_red($node->left->left)) $node = $this->rotate_right($node);
        if ($this->is_red($node->left) && $this->is_red($node->right)) $this->flip_colors($node);
        
        $node->n = $this->size($node->left) + $this->size($node->right) + 1;
        
        return $node;
    }
    
    /**
     * 
     * @param Node $node
     * @return number|string
     */
    private function size($node) {
        if ($node == null) return 0;
        return $node->n;
    }
    
    /**
     * 
     * @param Node $node
     * @return boolean
     */
    private function is_red($node) {
        if (is_null($node)) return FALSE;
        return ($node->color == self::RED);
    }
    
    /**
     * 
     * @param Node $node
     */
    private function flip_colors(&$node) {
        $node->color = self::RED;
        $node->left->color = self::BLACK;
        $node->right->color = self::RED;
    }
    
    /**
     *
     * @param Node $node
     * @return Node
     */
    private function rotate_left(&$node) {
        $x = $node->right;
        $node->right = $x->left;
        $x->left = $node;
        $x->color = $node->color;
        $node->color = self::RED;
        $x->n = $node->n;
        $node->n = 1 + $this->size($node->left) + $this->size($node->right);
        
        return $x;
    }
    
    /**
     *
     * @param Node $node
     * @return Node
     */
    private function rotate_right(&$node) {
        $x = $node->left;
        $node->left = $x->right;
        $x->right = $node;
        $x->color = $node->color;
        $node->color = self::RED;
        $x->n = $node->n;
        $node->n = 1 + $this->size($node->left) + $this->size($node->right);
        
        return $x;
    }
    
}