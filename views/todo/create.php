<?php
$this->title='Создать задачу';
$this->params['breadcrumbs'][]=['label' => 'Создать задачу'];
?>
<div class="row text-center">
    <div class="col-xl-6 m-auto">
        <?php $activeForm=\yii\bootstrap4\ActiveForm::begin() ?>
        <?= $activeForm->field($form,'name')->textInput() ?>
        <?= $activeForm->field($form,'description')->textarea() ?>
        <?= $activeForm->field($form,'priority')->dropdownList(\frontend\models\Todo::getPriorities()) ?>
        <?= \yii\helpers\Html::submitButton('Создать задачу',['class' => 'btn btn-success']) ?>
        <?php \yii\bootstrap4\ActiveForm::end() ?>
    </div>
</div>