<?php
$this->title='Редактирование задачи';
$this->params['breadcrumbs'][]=['label' => 'Редактирование задачи'];
?>
<div class="row text-center">
    <div class="col-xl-6 m-auto">
        <?php $activeForm=\yii\bootstrap4\ActiveForm::begin() ?>
        <?= $activeForm->field($form,'name')->textInput(['value' => $item->name]) ?>
        <?= $activeForm->field($form,'description')->textarea(['value' => $item->description]) ?>
        <?= $activeForm->field($form,'status')->dropdownList(\frontend\models\Todo::getStatuses()) ?>
        <?= $activeForm->field($form,'priority')->dropdownList(\frontend\models\Todo::getPriorities()) ?>
        <?= \yii\helpers\Html::submitButton('Редактировать задачу',['class' => 'btn btn-primary']) ?>
        <?php \yii\bootstrap4\ActiveForm::end() ?>
    </div>
</div>