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
    echo $alpha;
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

    for ($i = 0; $i < $number_c; $i = $i + 1) {
        if (unpack("C", $str[$i])[1] == 0) {
            $i = $i + 1;
            if ($i == $number_c) {
                return 1;
            }
            $nbr_loop = unpack("C", $str[$i])[1];           
            $i = $i + 1;
            for ($loop = 0; $loop < $nbr_loop; $loop = $loop + 1) {
                if ($i == $number_c) {
                    return 1;
                } else {
                    $new = $new . $str[$i];
                    if ($loop + 1 != $nbr_loop) {
                        $i = $i + 1;
                    }
                }
            }
        } else {
            $nbr_loop = unpack("C", $str[$i])[1];
            if (($i + 1) != $number_c) {
                $i = $i + 1;
                for ($x = 0; $x < $nbr_loop; $x = $x + 1) {
                    $new .= $str[$i];
                }
            } else {
                return 1;
            }
        }
    }
    
    return($new);
}

function decode_advanced_rle(string $input_path, string $output_path) {
    $file_src = fopen("$input_path", 'r+');

    $ligne = fread($file_src, filesize("$input_path"));
    
    fclose($file_src);
    $code = decode_rle($ligne);

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
