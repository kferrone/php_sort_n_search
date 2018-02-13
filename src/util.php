<?php 

function percent_dif($a,$b) {
    return round(((($a - $b) / $a) * 100),2);
}