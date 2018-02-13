<?php 

define('BASEPATH', getcwd());

function load($file_name) {
    if (file_exists(($file = BASEPATH."/src/${file_name}.php"))) require $file;
}

load('Quick');
load('Node');
load('RBT');
load('util');
load('tests');

if (!isset($argv[1])) {
    echo 'no command supplied';
} 

else {
    
    switch ($argv[1]) {
        case 'sort':
            if (isset($argv[2])) {
                run_sort_test($argv[2]);
            } else run_both_sort_Tests();
            break;
        case 'rbt':
            run_rbt_test();
            break;
        default:
            echo 'unknown command';
            break;
    }
    
}







