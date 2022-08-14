<?php
$this->title='Просмотр задачи';
$this->params['breadcrumbs'][]=['label' => 'Просмотр задачи'];
?>
<div class="row text-center">
    <div class="alert alert-primary col-xl-6 m-auto">
        <h5>Название: <?= $item['name'] ?></h5>
        <h5>Описание: <?= $item['description'] ?></h5>
        <h5>Статус: <?= \frontend\services\TodoService::prettyStatus($item['status']) ?></h5>
        <h5>Приоритет: <?= $item['priority'] ?></h5>
        <h5>Дата создания: <?= \frontend\services\TodoService::prettyDate($item['created_at']) ?></h5>
        <h5>Дата последнего обновления: <?= \frontend\services\TodoService::prettyDate($item['updated_at']) ?></h5>
    </div>
</div>