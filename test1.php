<?php
/**
 * Нужно написать код, который из массива выведет то что приведено ниже в комментарии.
 */
$x = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

/*
print_r($x) - должен выводить это:
Array
(
    [h] => Array
        (
            [g] => Array
                (
                    [f] => Array
                        (
                            [e] => Array
                                (
                                    [d] => Array
                                        (
                                            [c] => Array
                                                (
                                                    [b] => Array
                                                        (
                                                            [a] =>
                                                        )

                                                )

                                        )

                                )

                        )

                )

        )

);*/

function splitArray (Array $x)
{
    $array = [];
    $last_key = null;
    foreach ($x as $value) {
        $array[$value] = $array;
        if (isset($array[$last_key])) {
            unset($array[$last_key]);
        }
        $last_key = $value;
    }
    return $array;
}

print_r(splitArray($x));