<?php

include 'src/encode.php';
include 'src/decode.php';

$number_arg = count($argv);


if ($number_arg > 0 && $number_arg < 4 ) {
    return -1;
} else if ($number_arg > 4) {
    return -1;
}

if ($argv[1] == "encode") {
    if (file_exists($argv[2])) {
        $new_code = encode_advanced_rle($argv[2], $argv[3]);
    }
} else if ($argv[1] == "decode") {
        if (file_exists($argv[2])) {
            $new_code = decode_advanced_rle($argv[2], $argv[3]);
        }
} else {
    return -1;
}

?>
