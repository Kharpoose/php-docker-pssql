<?php
function quickSort($array)
{
    foreach ($array as $value) {
        if (!is_numeric($value)) {
            echo "Error: All elements must be numeric.<br/>";
            return;
        }
    }

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

    $lenght = count($array);

    $middle_key =   (int)($lenght/2);
    $middle = $array[$middle_key];

    $left = $right = array();
    foreach ($array as $key => $value) {
        if ($key == $middle_key) {
            continue;
        }
        if ($value <= $middle) {
            $left[] = $value;
        } else {
            $right[] = $value;
        }
    }

    return  array_merge(
        quickSort($left),
        array($middle),
        quickSort($right)
    );
    
}


$input1 = array(3,5,1,2,8,7,6,9,4);
$input2 = array(3,5,1,2,8,7,6,29,4);

quickSort($input1);
quickSort($input2);
