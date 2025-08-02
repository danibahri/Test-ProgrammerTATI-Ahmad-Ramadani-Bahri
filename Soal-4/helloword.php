<?php

function helloworld($n)
{
    if ($n < 0) {
        return "Input tidak valid";
    }

    $output = [];
    for ($i = 1; $i <= $n; $i++) {
        if ($i == 4) {
            $output[] = "hello";
        } elseif ($i == 5) {
            $output[] = "world";
        } else {
            $output[] = $i;
        }
        echo "helloworld(" . $i . ") => " . implode(" ", $output) . "<br>";
    }
}

helloworld(6);
