<?php
/**
 * Написать функцию которая из этого массива
 */
$data1 = [
    'parent.child.field' => 1,
    'parent.child.field2' => 2,
    'parent2.child.name' => 'test',
    'parent2.child2.name' => 'test',
    'parent2.child2.position' => 10,
    'parent3.child3.position' => 10,
];

//сделает такой и наоборот
$data = [
    'parent' => [
        'child' => [
            'field' => 1,
            'field2' => 2,
        ]
    ],
    'parent2' => [
        'child' => [
            'name' => 'test'
        ],
        'child2' => [
            'name' => 'test',
            'position' => 10
        ]
    ],
    'parent3' => [
        'child3' => [
            'position' => 10
        ]
    ],
];

function arrayReverse (Array $array)
{
    if (count($array) - count($array, COUNT_RECURSIVE) == 0) {
        return explodeArrayKeys($array);
    } else {
        return implodeArrayKeys($array);

    }
}

function implodeArrayKeys(Array $array, $key_helper = '', $array_return = [])
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array_return = implodeArrayKeys($value, "{$key_helper}{$key}.", $array_return);
        } else {
            $array_return["{$key_helper}{$key}"] = $value;
        }
    }
    return $array_return;
}

function explodeArrayKeys(Array $array) {
    $new_array = [];
    foreach ($array as $key => $value) {
        $array_keys = explode('.', $key);
        $array_helper = [];
        for ($i = count($array_keys); $i > 0; $i--) {
            if ($i == count($array_keys)) {
                $array_helper[$array_keys[$i - 1]] = $value;
            } else {
                $array_helper[$array_keys[$i - 1]] = $array_helper;
                if (isset($array_helper[$array_keys[$i]])) {
                    unset($array_helper[$array_keys[$i]]);
                }
            }
        }
        $new_array = array_merge_recursive($new_array, $array_helper);
    }
    return $new_array;
}

print_r(arrayReverse($data1));
print_r(arrayReverse($data));