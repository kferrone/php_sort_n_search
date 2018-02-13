<?php

/**
 * Basic implementation of the quick sort algorithm. 
 * @author kferrone
 *
 */
class Quick {
    
    /**
     * The quicksort with two arrays and no shifting.
     *
     * @param mixed[] $some_array
     * @return mixed[]
     */
    public static function simple_sort($arr) {
        
        //if there is only one thing then it's sorted
        if(count($arr) < 2) {
            return $arr;
        }
        
        //first make the lt(<) and gt(>) arrays
        $lt = $gt = array();
        
        //grab the key of the item in the pointer
        $pivot_key = key($arr);
        
        //grab the first item in the array as the pivot
        $pivot = array_shift($arr);
        
        
        foreach($arr as $val) {
            
            if($val <= $pivot) {
                $lt[] = $val;
            }
            elseif ($val > $pivot) {
                $gt[] = $val;
            }
        }
        return array_merge(self::simple_sort($lt),array($pivot_key=>$pivot),self::simple_sort($gt));
    }
    
    /**
     * Sorts an unsorted array using quicksort. 
     * 
     * @param mixed[] $arr Any array you want sorted. 
     * @return mixed[]
     */
    public static function sort($arr,$shuffle = TRUE) {
        
        if (!is_array($arr)) throw new Exception("The parameter to sort must be an array");
        
        //first we must shuffle the array
        if ($shuffle) shuffle($arr);
        
        $lo = key($arr);
        end($arr);
        $hi = key($arr);
        reset($arr);
        
        self::sub_sort($arr,$lo,$hi);
        
        return $arr;
    }
    
    private static function sub_sort(&$arr, $lo, $hi) {
        if ($hi <= $lo) return;
        
        $j = self::partition($arr, $lo, $hi);
        self::sub_sort($arr, $lo, $j - 1);
        self::sub_sort($arr, $j + 1, $hi);
    }
    
    private static function partition(&$arr, $lo, $hi) {
        
        $i = $lo;
        $j = $hi + 1;
        $val = $arr[$lo];
        
        while (true) {
            
            // find item on lo to swap
            while (self::lt($arr[++$i],$val)) {
                if ($i == $hi) break;
            }
            
            while (self::lt($val,$arr[--$j])) {
                if ($j == $lo) break;
            }
            
            if ($i >= $j) break;
            
            self::swap($arr, $i, $j);
            
        }
        
        self::swap($arr, $lo, $j);
        
        return $j;
    }
    
    /**
     * Simple less than function. 
     * @param mixed $a The value to check if lexically smaller than b. 
     * @param mixed $b The value to check if lexically greater than a.
     * @return boolean
     */
    private static function lt($a,$b) {
        if ($a == $b) return false;
        return ($a < $b);
    }
    
    /**
     * Basically the only way to swap the position of two values in an array with PHP. 
     * 
     * @param mixed[] $arr
     * @param mixed $i
     * @param mixed $j
     */
    private static function swap(&$arr, $i, $j) {
        $swap = $arr[$i];
        $arr[$i] = $arr[$j];
        $arr[$j] = $swap;
    }
    
}

