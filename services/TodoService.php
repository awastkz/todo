<?php
namespace frontend\services;

use frontend\forms\TodoForm;
use frontend\models\Todo;
use Yii;
use yii\bootstrap4\Html;

class TodoService
{
    public function create(TodoForm $form)
    {
        $model=new Todo();

        $model->name=$form->name;
        $model->description=$form->description;
        $model->status=Todo::STATUS_CREATED;
        $model->priority=$form->priority;

        if(!$model->save()){
            throw new \RuntimeException('Создать задачу не удалось');
        }
    }

    public function update(TodoForm $form,Todo $item)
    {
        $item->name=$form->name;
        $item->description=$form->description;
        $item->status=$form->status;
        $item->priority=$form->priority;

        if(!$item->save()){
            throw new \RuntimeException('Редактировать задачу не удалось');
        }
    }


    public static function prettyStatus($status)
    {
        if($status===null){
            return false;
        }

        switch($status){
            case Todo::STATUS_CREATED:
                $statusName=Todo::getStatuses()[Todo::STATUS_CREATED];
                $color=Todo::getStatusColors()[Todo::STATUS_CREATED];
                break;
            case Todo::STATUS_PROCESS:
                $statusName=Todo::getStatuses()[Todo::STATUS_PROCESS];
                $color=Todo::getStatusColors()[Todo::STATUS_PROCESS];
                break;
            case Todo::STATUS_COMPLETED:
                $statusName=Todo::getStatuses()[Todo::STATUS_COMPLETED];
                $color=Todo::getStatusColors()[Todo::STATUS_COMPLETED];
                break;
            default:
                $statusName=Todo::getStatuses()[Todo::STATUS_CREATED];
                $color=Todo::getStatusColors()[Todo::STATUS_CREATED];
        }

        $text=Html::tag('span',$statusName,['class' => 'badge badge-'.$color]);

        return $text;
    }

    public static function prettyDate($date)
    {
        return Yii::$app->formatter->asDate($date,'medium').' '.Yii::$app->formatter->asDate($date,'H:i');
    }
}