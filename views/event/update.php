<?php
/**
 * Displays the update page to Event CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $model Event
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Event;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar evento';
$this->params['breadcrumbs'] = [
    [
        "label" => "Eventos",
        "icon" => "fa-calendar",
        "active" => false,
        "url" => Url::to(["event/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-calendar",
        "active" => true,
        "url" => Url::to(["event/update", 'id' => $model->id])
    ]
];
?>
<div class="event-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
