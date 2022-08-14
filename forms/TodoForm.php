<?php
namespace frontend\forms;

class TodoForm extends \yii\base\Model
{
    public $name;
    public $description;
    public $status;
    public $priority;
    public $date;

    public function rules()
    {
        return [
            ['id','safe'],
            ['name','required'],
            ['description','required'],
            ['status','safe'],
            ['priority','required'],
            [['created_at','updated_at'],'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
            'status' => 'Статус',
            'priority' => 'Приоритет',
            'created_at' => 'Дата создание',
            'updated_at' => 'Дата обновление',
        ];
    }
}