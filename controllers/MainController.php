<?php

namespace frontend\controllers;

use frontend\forms\SearchForm;
use frontend\helpers\TodoHelper;
use frontend\models\Todo;
use frontend\services\SearchService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\VarDumper;


/**
 * Site controller
 */
class MainController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $sort=TodoHelper::getQuery(Yii::$app->request->url,'sort');
        $sort=($sort=='default' or $sort===null) ? ['id' => SORT_DESC] : $sort;

        $provider=new ActiveDataProvider([
            'query' => Todo::find()->orderBy($sort),
        ]);


        return $this->render('index',[
            'provider' => $provider,
        ]);
    }

    public function actionSearch()
    {
        $form=new SearchForm();
        $service=new SearchService();

        if($form->load(Yii::$app->request->post()) and $form->validate()){
            $items=$service->getSearchResult($form->search);
        }

        return $this->render('search',[
            'items' => $items ?? [],
            'form' => $form,
        ]);
    }

}
