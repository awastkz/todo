<?php

namespace frontend\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class Todo extends ActiveRecord
{
    const STATUS_CREATED=1;
    const STATUS_PROCESS=2;
    const STATUS_COMPLETED=3;

    const SORT_DEFAULT='default';
    const SORT_PRIORITY='priority';
    const SORT_CREATED_AT='created_at';


    public static function tableName()
    {
        return 'list';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public static function getPriorities()
    {
        return [1 => 1,2,3,4,5];
    }

    public static function getStatuses()
    {
        return [
            static::STATUS_CREATED => 'Создан',
            static::STATUS_PROCESS => 'В работе',
            static::STATUS_COMPLETED => 'Выполнен',
        ];
    }

    public static function getStatusColors()
    {
        return [
            static::STATUS_CREATED => 'info',
            static::STATUS_PROCESS => 'primary',
            static::STATUS_COMPLETED => 'success',
        ];
    }

    public static function getSortNames()
    {
        return [
            static::SORT_DEFAULT => 'По умолчанию',
            static::SORT_PRIORITY => 'По приоритету',
            static::SORT_CREATED_AT => 'По дате',
        ];
    }



}