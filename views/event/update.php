<?php
/**
 * Displays the update page to Event CRUD.
 *
 * @var $this View
 * @var $model Event
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Event;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('event', 'Update event');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('event', 'Events'),
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
