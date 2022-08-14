<?php

use yii\helpers\Url;

$this->title = 'Todo';
?>

<div class="container">
    <div class="row">
        <div class="col-xl-12 text-center mb-3">
            <h3>Todo List</h3>
        </div>
        <hr>
        <?php if($sort=\frontend\helpers\TodoHelper::getQuery(Yii::$app->request->url,'sort')): ?>
            <div class="col-xl-12 text-center mb-3">
                <h5>Сортировка: <?= \frontend\models\Todo::getSortNames()[$sort] ?></h5>
            </div>
        <?php endif; ?>
    </div>
    <a class="btn btn-sm btn-outline-success mb-3" href="<?= Url::to(['todo/create']) ?>">Создать задачу</a>


    <?php if(!empty($items=$provider->models)): ?>
        <table class="table table-sm table-hover table-bordered text-center">
            <thead>
            <th>#</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Статус</th>
            <th>Приоритет</th>
            <th>Дата создания</th>
            <th>Редактирование</th>
            <th>Подробнее</th>
            <th>Удаление</th>
            </thead>
            <tbody>
            <?php $count=1 ?>
            <?php foreach($items as $item): ?>
            <tr>
                <td><?= $count ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['description'] ?></td>
                <td><?= \frontend\services\TodoService::prettyStatus($item['status']) ?></td>
                <td><?= $item['priority'] ?></td>
                <td><?= \frontend\services\TodoService::prettyDate($item['created_at']) ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="<?= Url::to(['todo/edit','id' => $item['id']]) ?>">Редактировать</a>
                </td>
                <td>
                    <a class="btn btn-sm btn-warning" href="<?= Url::to(['todo/view','id' => $item['id']]) ?>">Просмотр</a>
                </td>
                <td><a class="btn btn-sm btn-danger" href="<?= Url::to(['todo/remove','id' => $item['id']]) ?>" onclick="return confirm('Удалить задачу?')">Удалить</a></td>
            </tr>
            <?php $count++ ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    
    <?php else: ?>
        <div class="text-center">
            <h2>В списке нет задач</h2>
        </div>
    <?php endif; ?>


</div>

