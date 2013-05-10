<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function getPriceId($inputPrice)
{
    if($inputPrice === "PIJ")
        return 3;
    if($inputPrice === "PGJ")
        return 1; 
    if($inputPrice === "UGJ")
        return 2;
    if($inputPrice === "UIJ")
        return 4;
    if($inputPrice === "PGS")
        return 5;
    if($inputPrice === "UGS")
        return 6;
    if($inputPrice === "PIS")
        return 7;
    if($inputPrice === "UIS")
        return 8;

}
?>
