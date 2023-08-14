<?php

namespace App\Helpers;
use Request;


class Helper {   

    public static function cleanText($text) {
        $cleanText = strip_tags($text);
        return $cleanText;
    }   

}