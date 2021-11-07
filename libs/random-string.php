<?php
function str_rand($len) {
    $str = '';
    $times = ceil($len/32);
    for ($i = 0; $i < $times; $i++) {
        $str .= md5(rand());
    }
    return substr($str, 0, $len);
}
?>
