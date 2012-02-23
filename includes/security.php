<?php

function tencode($val){
    $token = $_COOKIE['token'];
    $factor = $token*23;
    return $val+$factor;
}

function tdecode($val){
    $token = $_COOKIE['token'];
    $factor = $token*23;
    return $val-$factor;
}

?>