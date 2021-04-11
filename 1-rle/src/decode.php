<?php

function verif_alphaNum($str){
      // On cherche tt les caractères autre que [A-Za-z] ou [0-9]
      preg_match("/([^A-Za-z0-9\s])/",$str,$result);
      // si on trouve des caractère autre que A-Za-z ou 0-9
      if(!empty($result)){
        return false;
      }
      return true;
}

function verif($str) {
    $i = 0;
    $number_c = strlen($str);
    $alpha = verif_alphaNum($str);

    if ($str == '') {
        return (1);
    }
    if ($alpha == 0) {
        return (0);
    }
    if (verif_alpha($str[0]) == 1) {
        return (0);
    }
    while ($i < $number_c) {
        if (verif_alpha($str[$i]) == 1 && ($i + 1) != $number_c) {
            if (verif_alpha($str[$i + 1]) == 1) {
                return (0);
            }
        }
        if (verif_alpha($str[$i]) == 0 && ($i + 1) == $number_c) {
            return (0);
        }
        $i = $i + 1;
    }
    return (1);
}




function decode_rle(string $str)
{
    $i = 0;
    $out = 0;
    $position = 0;
    $new = "";
    $number_c = strlen($str);
    $alpha = verif($str);
    if ($alpha == 0) {
        return('$$$');
    }

    while ($i != $number_c && $out == 0) {
        $compteur = 0;
        while (verif_alpha($str[$i]) == 0) {
            $compteur = $compteur * 10 + $str[$i];
            $i = $i + 1;
        }
        $test = 0;
        while ($test < $compteur){
            $new[$position] = $str[$i];
            $position = $position + 1;
            $test = $test + 1;
        }
        $i = $i + 1;
    }
    return("$new\n");
}

?>
