<?php

include 'src/encode.php';
include 'src/decode.php';

$number_arg = count($argv);

if ($number_arg > 0 && $number_arg < 3 ) {
    return -1;
} else if ($number_arg > 3) {
    return -1;
}

if ($argv[1] == "encode") {
    $new_code = encode_rle($argv[2]);
    echo $new_code;
} else if ($argv[1] == "decode") {
    $new_code = decode_rle($argv[2]);
    echo $new_code;
} else {
    return -1;
}

?>
