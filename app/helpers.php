<?php

if (!function_exists('numberToShortString')) {
    function numberToShortString($number)
    {
        $suffixes = ["", "k", "M", "B", "T"];

        $suffixIndex = 0;
        while ($number >= 1000 && $suffixIndex < count($suffixes) - 1) {
            $number /= 1000;
            $suffixIndex++;
        }

        return round($number, 1) . $suffixes[$suffixIndex];
    }
}
