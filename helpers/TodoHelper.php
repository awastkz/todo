<?php

namespace frontend\helpers;

class TodoHelper
{
    public static function getQuery($url,$query)
    {
        $urlQueries=parse_url($url)['query'];

        if(!$urlQueries){
            return null;
        }

        parse_str($urlQueries,$output);

        return $output[$query];

    }
}