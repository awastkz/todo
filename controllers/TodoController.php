<?php

namespace frontend\controllers;

use frontend\forms\TodoForm;
use frontend\helpers\TodoHelper;
use frontend\models\Todo;
use frontend\services\TodoService;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TodoController extends Controller
{

    public function actionCreate()
    {
        $form=new TodoForm();
        $service=new TodoService();

        if($form->load(Yii::$app->request->post()) and $form->validate()){
            try{
                $service->create($form);
                Yii::$app->session->setFlash('success','Задача создана');
                return $this->refresh();
            }
            catch(\Exception $e){
                Yii::$app->session->setFlash('error',$e->getMessage());
                Yii::$app->errorHandler->logException($e);
            }
        }

        return $this->render('create',[
            'form' => $form,
        ]);
    }

    public function actionEdit()
    {
        $id=TodoHelper::getQuery(Yii::$app->request->url,'id');
        $item=Todo::findOne($id);

        if(!$item){
            throw new NotFoundHttpException('Не удалось найти задачу');
        }

        $form=new TodoForm();
        $service=new TodoService();

        $form->status=$item->status;
        $form->priority=$item->priority;

        if($form->load(Yii::$app->request->post()) and $form->validate()){
            try{
                $service->update($form,$item);
                Yii::$app->session->setFlash('success','Задача редактирована');
                return $this->refresh();
            }
            catch(\Exception $e){
                Yii::$app->session->setFlash('error',$e->getMessage());
                Yii::$app->errorHandler->logException($e);
            }
        }

        return $this->render('edit',[
            'item' => $item,
            'form' => $form,
        ]);
    }

    public function actionView()
    {
        $id=TodoHelper::getQuery(Yii::$app->request->url,'id');

        $item=Todo::findOne($id);
        if(!$item){
            throw new NotFoundHttpException('Не удалось найти задачу');
        }

        return $this->render('view',[
            'item' => $item,
        ]);
    }

    public function actionRemove()
    {
        $id=TodoHelper::getQuery(Yii::$app->request->url,'id');

        $item=Todo::findOne($id);
        if(!$item){
            throw new NotFoundHttpException('Не удалось найти задачу');
        }
        if($item->delete()){
            Yii::$app->session->setFlash('success','Задача удалена');
        }

        return Yii::$app->response->redirect(Yii::$app->request->referrer);
    }

}