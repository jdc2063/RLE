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

function verif_same(string $str, int $i, int $nbr_char) {
    if ($i + 1 != $nbr_char) {
        if ($str[$i] == $str[$i + 1]) {
            return 1;
        }
        return 0;
    } else {
        return 2;
    }
}

function how_same(string $str, int $i, int $nbr_char) {
    $out = 0;
    $same = 1;
    while ($i < $nbr_char && $out == 0) {
        if (verif_same($str, $i, $nbr_char) == 1) {
            $same = $same + 1;
            $i = $i + 1;
        } else {
            $out = 1;
        }
    }
    return ($same);
}

function how_diff(string $str, int $i, int $nbr_char) {
    $out = 0;
    $diff = 0;
    $f = $i + 1;
    while ($i < $nbr_char && $out == 0) {
        if (verif_same($str, $i, $nbr_char) == 0) {
            $diff = $diff + 1;
            $i = $i + 1;
        } else if (verif_same($str, $i, $nbr_char) == 2){
            $diff = $diff + 1;
            $i = $i + 1;
            $out = 1;
        } else {
            $out = 1;
        }
    }
    return ($diff);
}

function encode_rle(string $str)
{
    $i = 0;
    $out = 0;
    $new = "";
    $nbr_char = strlen($str);
    if ($nbr_char == 1) {
        $new = chr(0) . chr(1) . $str[0];
        $i = $i + 1;
    }
    while ($i < $nbr_char && $out == 0) {
        if (verif_same($str, $i, $nbr_char) == 1) {
            $nbr_same = how_same($str, $i, $nbr_char);
            if ($nbr_same <= 255) {
                $new = $new . chr($nbr_same) . $str[$i];
            } else {
                $same = $nbr_same;
                while ($same > 255) {
                    $new = $new . chr(255) . $str[$i];
                    $same = $same - 255 ;
                }
                $new = $new . chr($same) . $str[$i];
            }
            while ($nbr_same > 0) {
                $i = $i + 1;
                $nbr_same = $nbr_same - 1;
            }
        } else if (verif_same($str, $i, $nbr_char) == 0) {
            $nbr_diff = how_diff($str, $i, $nbr_char);
            if ($nbr_diff != 0) {
                $new = $new . chr(0) . chr($nbr_diff);
                while ($nbr_diff > 0) {
                    $new = $new . $str[$i];
                    $i = $i + 1;
                    $nbr_diff = $nbr_diff - 1;
                }
            }
        } else if (verif_same($str, $i, $nbr_char) == 2) {
            $new = $new . chr(0) . chr(1) . $str[$i];
            $i = $i + 1;
        } else {
            $i = $i + 1;
        }
    }
    return($new);
}

function encode_advanced_rle(string $input_path, string $output_path) {

    $file_src = file_get_contents("$input_path");

    $code = encode_rle($file_src);

    if ($code == 1) {
        echo "KO";
        return 1;
    } else {
        $file_dst = fopen("$output_path", 'a');

        ftruncate($file_dst,0);
    
        fputs($file_dst, $code);
        echo "OK";
        return 0;
    }

    
}

?>
