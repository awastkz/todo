<?php

namespace frontend\forms;

use yii\base\Model;

class SearchForm extends Model
{
    public $search;

    public function rules()
    {
        return [
            ['search','required'],
            ['search','string','max' => 40],
        ];
    }
}