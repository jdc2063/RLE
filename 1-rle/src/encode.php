<?php

function verif_alpha($str){
    // On cherche tt les caractères autre que [A-z]
    preg_match("/([^A-Za-z\s])/",$str,$result);
    // si on trouve des caractère autre que A-z
    if(!empty($result)){
        return false;
    }
    return true;
}

function power_f($int)
{
    $i = 1;
    $value= 1;
    while ($i < $int) {
        $value = $value * 10;
        $i = $i + 1;
    }
    return ($value);
}

function encode_rle(string $str)
{
    $i = 0;
    $out = 0;
    $position = 0;
    $new = "";
    $nbr_char = strlen($str);
    if (verif_alpha($str) == 0) {
        return('$$$');
    }
    while ($i != $nbr_char && $out == 0) {
        $compteur = 1;
        if ($i + 1 != $nbr_char) {
            while ($str[$i] == $str[$i+1] && $out == 0) {
                $compteur = $compteur + 1;
                if ($i + 2 == $nbr_char) {
                    $out = 1;
                } else {
                    $i = $i + 1;
                }
            }
        }
        $power = strlen($compteur);
        while ($power > 0) {
            $new_power = power_f($power);
            $new[$position] = ($compteur/($new_power))%10;
            $position = $position + 1;
            $power = $power - 1;
        }
        $new[$position] = $str[$i];
        $position = $position + 1;
        $i = $i + 1;
    }
    return("$new\n");
}

?>
