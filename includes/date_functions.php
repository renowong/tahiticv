<?php

function to_mysql_format($val){
    $arrdate = explode("/",$val);
    return $arrdate[2]."-".$arrdate[1]."-".$arrdate[0];
}

function to_french_format($val){
    $arrdate = explode("-",$val);
    return $arrdate[2]."/".$arrdate[1]."/".$arrdate[0];
}

?>