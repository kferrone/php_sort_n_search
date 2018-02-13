<?php 

function run_sort_test($arg) {
    
    switch ($arg) {
        case 'simple':
            $fx = 'simple_sort';
            break;
        case 'quick':
            $fx = 'sort';
            break;
        default:
            throw new Exception("The method does not exist. The two options are: quick or simple");
            break;
    }
    
    //$my_array = array(3, 0, 2, 5, -1, 4, 1);
    $my_array = array('zap',1,'c','world','hello','burgers',7,3,true);
    //$my_array = 'hello';
    
    echo "------------- $fx -------------"."\n";
    echo 'Original Array : '.implode(',',$my_array)."\n";
    $before = microtime(true);
    $my_array = Quick::$fx($my_array);
    $after = microtime(true);
    
    echo 'Sorted Array : '.implode(',',$my_array)."\n";
    $run_time = ($after - $before);
    echo "The sort took: $run_time"."\n";
    echo "-------------------------------"."\n";
    return $run_time;
}

function run_both_sort_Tests() {
    $sort_time = run_sort_test('quick');
    $simple_sort_time = run_sort_test('simple');
    
    if ($sort_time < $simple_sort_time) {
        echo "The sort algo is faster by ".percent_dif($simple_sort_time,$sort_time)."%"."\n";
    }
    
    elseif ($sort_time > $simple_sort_time) {
        echo "The simple sort is faster by ".percent_dif($sort_time,$simple_sort_time)."%"."\n";
    }
}

function run_rbt_test() {
    
    $search_term = 'Hello Red and Black World!';
    $rbt = new RBT();
    
    for ($i = 0; $i < count(($keys = str_split($search_term)));$i++) {
        $rbt->insert($keys[$i],$i);
    }
    
    $rbt->print();
    
}