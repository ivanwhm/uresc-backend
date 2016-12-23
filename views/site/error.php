<?php

/**
 * This file is responsible to show error default page.
 *
 * @var $exception Exception
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\helpers\Html;

$this->title = 'Erro';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-times",
        "active" => true
    ]
];
?>

<?= Html::tag('p', $exception->getMessage(), ['class' => 'lead']); ?>
<?= Html::tag('br') ?>
<?= Html::tag('p', '<strong>Código do erro</strong>: ' . $exception->getCode(), ['class' => 'lead']); ?>
<?= Html::tag('p', '<strong>Linha do erro</strong>: ' . $exception->getLine(), ['class' => 'lead']); ?>
<?= Html::tag('p', '<strong>Trace do erro</strong>: ' . $exception->getTraceAsString(), ['class' => 'lead']); ?>
