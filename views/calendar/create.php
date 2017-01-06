<?php
/**
 * Displays the create page to Calendar CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Calendar
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Adicionar calendário';
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
        "active" => true
    ]
];

?>
<div class="calendar-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
