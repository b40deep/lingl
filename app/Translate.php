<?php

namespace App;

class Translate
{
    public static function helper(){
        $res = json_decode(file_get_contents("https://api.kanye.rest"));
        return $res->quote;
        // return file_get_contents("https://random-word-api.herokuapp.com/word?number=5&swear=0");
    }
}

?>
