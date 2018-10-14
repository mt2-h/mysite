<?php

$ary_1 = range(1,5);
$ary_2 = range(6,10);

print_r(shuffle_1($ary_1,100));
shuffle_1($ary_2,100);
print_r(shuffle_1($ary_1,100));
shuffle_1($ary_1,400);
shuffle_1($ary_1,500);

function shuffle_fix_seed($ary,$seed){
    $rand_ary = range(1,count($ary));
    $tmp_ary = array();
    $ret_ary = array();
    
    foreach($rand_ary as $v){
        srand($seed);
        $rand_seed = $v*rand();
        $tmp_ary[$rand_seed] = $v;
        $seed = (int)$rand_seed;
    }

    ksort($tmp_ary);

    foreach($tmp_ary as $v){
        $ret_ary[($v-1)] = $ary[($v-1)];
    }

    return $ret_ary;         
}

#test_text
