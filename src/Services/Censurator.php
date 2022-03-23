<?php


namespace App\Services;


class Censurator
{
    protected $censoredWords = ["lorem", "ipsum", "blabla" ];

    public function purify($string):string
    {
        foreach($this->censoredWords as $word){
            if(strpos($string, $word) !== false){
                $string = preg_replace('/'.$word.'/', "*", $string);
             }
        }
        return $string;
    }
}