<?php
// Function to perform Quick Sort algorithm
function quick_sort($my_array)
{
    // Base case: if array has 0 or 1 elements, it's already sorted
    $length = count($my_array);
    if ($length <= 1) {
        return $my_array;
    }
    

    // Select pivot element (here, we choose the middle element)
    $pivot_key = (int)($length / 2);
    $pivot = $my_array[$pivot_key];

    // Partition the array into elements less than pivot and elements greater than pivot
    $left = $right = array();
    foreach ($my_array as $key => $value) {
        if ($key == $pivot_key) {
            continue;
        }
        if ($value <= $pivot) {
            $left[] = $value;
        } else {
            $right[] = $value;
        }
    }

    // Recursively sort the partitions
    return array_merge(
        quick_sort($left),
        array($pivot), // Pivot element
        quick_sort($right)
    );
}

$my_array = array(31, 0, 21, 55, -11, 41, 1);
$my_array = quick_sort($my_array);
echo 'Sorted Array : ' . implode(',', $my_array);
?>
