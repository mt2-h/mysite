<?php
function shuffle_fix_seed_1($ary,$seed){
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

function shuffle_fix_seed_2($ary,$seed){
    $cnt = 0;
    $rand_ary = range(0,(count($ary)-1));

    foreach ($rand_ary as $k => $v) {
        $cnt++;
        if($cnt <= 3){  
            $sg_1[] = $v;   
        }elseif($cnt <= 7){
            $sg_2[] = $v;   
        }else{
            $sg_3[] = $v;   
        }
    }

    $group_ary[1] = $sg_1;
    $group_ary[2] = $sg_2;
    $group_ary[3] = $sg_3;

    foreach ($group_ary as $k => $v) {
        $tmp = array();
        foreach ($v as $k1 => $v1) {
            srand($seed);
            $rand_seed = (10*$k+$k1)*rand();
            $tmp[$rand_seed] = $v1;
            $seed = (int)$rand_seed;
        }
        ksort($tmp);
        $group_ary[$k] = $tmp;
    }

    $tmp_ary = array();
    $mrg_ary = array();
    $ret_ary = array();
    
    foreach($group_ary as $k => $v){
        srand($seed);
        $rand_seed = $k*rand();
        $tmp_ary[$rand_seed] = $v;
        $seed = (int)$rand_seed;
    }

    ksort($tmp_ary);
    
    foreach($tmp_ary as $k => $v){
        foreach ($v as $k1 => $v1) {
            $ret_ary[$v1] = $ary[$v1];
        }
    }    

//    print_r($tmp_ary);

    return $ret_ary;         
}

$ary1 = range(1,10);
$ary2 = range(6,10);
$ary3 = range(11,20);
$ary4 = range(60,100);
echo "<pre>";
print_r(shuffle_fix_seed_1($ary1,100));
print_r(shuffle_fix_seed_1($ary3,100));
print_r(shuffle_fix_seed_2($ary1,100));
print_r(shuffle_fix_seed_2($ary3,200));
echo "</pre>";
