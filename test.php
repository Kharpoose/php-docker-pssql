<?php
function sorta($array)
{
    foreach ($array as $value) {
        if (!is_numeric($value)) {
            echo "Error: All elements must be numeric.<br/>";
            return;
        }
    }

    sort($array);
    if (count($array) < 5) {
        echo "Error: Array must contain at least two elements.<br/>";
        return;
    } elseif (count($array) > 10) {
        echo "Error: Array must contain no more than ten elements.<br/>";
        return;
    } else {
        for ($i = 0; $i < count($array); $i++) {
            echo $array[$i] . "<br/> ";
        }
    }
}


$input1 = [51, 55, "a", 145, 1, "114", 4, 51];
$input2 = [51, 55, 31, 145, 1, 144, 4, 51, 51, 55, 31, 145, 1, 144, 4, 51];

sorta($input1);
sorta($input2);
