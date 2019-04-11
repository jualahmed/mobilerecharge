<?php

if (! function_exists('square_brackets_to_dots')) {
    /**
     * Turns a string from bracket-type array to dot-notation array.
     * Ex: array[0][property] turns into array.0.property.
     *
     * @param $path
     *
     * @return string
     */
    function square_brackets_to_dots($string)
    {
        $string = str_replace(['[', ']'], ['.', ''], $string);

        return $string;
    }
}
