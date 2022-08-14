<?php

namespace frontend\services;

use frontend\models\Todo;

class SearchService
{
    public function getSearchResult($search)
    {
        $items=Todo::find()->where(['like','name',$search])->asArray()->orderBy(['id' => SORT_DESC])->limit(10)->all();

        if(!$items){
            return null;
        }

        return $items;
    }
}