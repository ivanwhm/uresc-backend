<?php
/**
 * Displays the update page to Calendar CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $model Calendar
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar calendário';
$this->params['breadcrumbs'] = [
    [
        "label" => "Calendários",
        "icon" => "fa-calendar-o",
        "active" => false,
        "url" => Url::to(["calendar/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-calendar-o",
        "active" => true,
        "url" => Url::to(["calendar/update", 'id' => $model->id])
    ]
];
?>
<div class="calendar-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
