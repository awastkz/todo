<?php
$this->title='Поиск';
$this->params['breadcrumbs'][]=['label' => 'Поиск'];
?>
<?php if(!empty($items)): ?>
    <?php if($form->search): ?>
        <div class="text-center">
            <h2>Результат поиска</h2>
            <h4>Поиск: <?= $form->search ?></h4>
        </div>
    <?php endif; ?>

<?php foreach($items as $item): ?>
    <div class="alert alert-primary">
        <h5>Название: <?= $item['name'] ?></h5>
        <h5>Описание: <?= $item['description'] ?></h5>
        <h5>Статус: <?= \frontend\services\TodoService::prettyStatus($item['status']) ?></h5>
        <h5>Приоритет: <?= $item['priority'] ?></h5>
        <h5>Дата создания: <?= \frontend\services\TodoService::prettyDate($item['created_at']) ?></h5>
        <h5>Дата последнего обновления: <?= \frontend\services\TodoService::prettyDate($item['updated_at']) ?></h5>
    </div>
<?php endforeach; ?>

<?php else: ?>
    <div class="text-center">
        <h2>К сожелению в поиске не нашлось данных</h2>
    </div>
<?php endif; ?>
