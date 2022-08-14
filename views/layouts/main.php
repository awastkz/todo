<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
        <a class="navbar-brand" href="<?= \yii\helpers\Url::to(['/']) ?>">Todo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <?php if(Yii::$app->controller->route=='main/index'): ?>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Сортировка
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php $requestSort=\frontend\helpers\TodoHelper::getQuery(Yii::$app->request->url,'sort') ?>
                        <?php foreach(\frontend\models\Todo::getSortNames() as $sort => $label): ?>
                            <a class="dropdown-item <?= $requestSort==$sort ? 'active' : '' ?>" href="<?= \yii\helpers\Url::to(['main/index','sort' => $sort]) ?>"><?= $label ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
            </ul>
        <?php else: ?>
            <ul class="navbar-nav mr-auto"></ul>
        <?php endif; ?>

        <?php $form=new \frontend\forms\SearchForm() ?>
        <?php $activeForm=ActiveForm::begin([
            'validateOnBlur' => false,
            'validateOnChange' => false,
            'action' => ['main/search'],
            'fieldConfig' => [
                'options' => [
                    'class' => 'form-inline my-2 my-lg-0',
                ],
                'template' => "{input}<button class='btn btn-sm btn-outline-primary my-2 my-sm-0'
                  id='search_btn' type='submit'>Поиск</button>{error}",
            ],

        ]) ?>
        <?= $activeForm->field($form,'search')->textInput(['class' => 'form-control w-75 mr-sm-2','autocomplete' => 'off','placeholder' => 'Поиск'])->label(false) ?>
        <?php ActiveForm::end() ?>
    </div>
    </nav>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Главная', 'url' => '/'],
            'itemTemplate' => "<li>{link}/</li>",
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => [
                    'class' => 'p-3'
            ]
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>
