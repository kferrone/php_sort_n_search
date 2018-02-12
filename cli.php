<?php

function load($class) {
    if (file_exists(($class_file = getcwd() . "/${class}.php"))) require $class_file;
}

function percent_dif($a,$b) {
    return round(((($a - $b) / $a) * 100),2);
}

function run_test($fx) {
    //$my_array = array(3, 0, 2, 5, -1, 4, 1);
    $my_array = array('zap',1,'c','world','hello','burgers',7,3,true);
    //$my_array = 'hello';
    
    echo 'Original Array : '.implode(',',$my_array)."\n";
    $before = microtime(true);
    $my_array = Quick::$fx($my_array);
    $after = microtime(true);
    
    echo 'Sorted Array : '.implode(',',$my_array)."\n";
    $run_time = ($after - $before);
    echo "The sort took: $run_time"."\n";
    return $run_time;
}

load('Quick');

if ((!isset($argv[1])) || is_null($argv[1])) {
    $sort_time = run_test('sort');
    $simple_sort_time = run_test('simple_sort');
    
    if ($sort_time < $simple_sort_time) {
        echo "The sort algo is faster by ".percent_dif($simple_sort_time,$sort_time)."%"."\n";
    }
    
    elseif ($sort_time > $simple_sort_time) {
        echo "The simple sort is faster by ".percent_dif($sort_time,$simple_sort_time)."%"."\n";
    }
    
} 

else {
    if (!method_exists(Quick::class, ($fx = $argv[1]))) {
        throw new Exception("The method does not exist. The two options are: sort or simple_sort");
    } else {
        
        run_test($fx);
    }
}







