<?php
global $argv;

$content = explode(PHP_EOL, file_get_contents("./" . $argv[1]));
array_shift($content);
array_pop($content);

function to_binary($array)
{
    $cache = $array;
    $pos = [];
    $max = 0;
    for ($i = 0; $i < count($array); $i++) {
        for ($j = 0; $j < strlen($array[$i]); $j++) {
            if ($i == 0 && $array[$i][$j] == '.') {
                $array[$i][$j] = 1;
                if ($array[$i][$j] > $max) {
                    $max = $array[$i][$j];
                    $pos = [$i, $j];
                }
            } else if ($i > 0 && $array[$i][$j] == '.') {
                if (isset($array[$i - 1][$j - (strlen($array[$i]) + 1)]) && isset($array[$i - 1][$j]) && isset($array[$i][$j - (strlen($array[$i]) + 1)])) {
                    $checking = [$array[$i - 1][$j - (strlen($array[$i]) + 1)], $array[$i - 1][$j], $array[$i][$j - (strlen($array[$i]) + 1)]];
                    $array[$i][$j] = min($checking) + 1;
                    if ($array[$i][$j] > $max) {
                        $max = $array[$i][$j];
                        $pos = [$i, $j];
                    }
                } else {
                    $array[$i][$j] = 1;
                }
            } else {
                $array[$i][$j] = 0;
            }
        }
    }
    return [$array, $max, $pos, $cache];
}


function find_square($array)
{
    $data = to_binary($array);
    $array = $data[0];
    $max = $data[1];
    $x = $data[2][0];
    $y = $data[2][1];
    $min_y = $y - $max;
    $min_x = $x - $max;
    $cache = $data[3];

    for ($i = $x; $i >= 0; $i--) {
        for ($j = $y; $j >= 0; $j--) {
            if ($j > $min_y && $i > $min_x) {
                $cache[$i][$j] = 'x';
            }
        }
    }

    for ($i = 0; $i < count($cache); $i++) {
        for ($j = 0; $j < strlen($cache[$i]); $j++) {
            if ($j == strlen($cache[$i]) - 1) {
                echo $cache[$i][$j] . PHP_EOL;
            } else {
                echo $cache[$i][$j];
            }
        }
    }
}

find_square($content);
