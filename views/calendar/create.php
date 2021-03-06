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
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('calendar', 'Add calendar');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('calendar', 'Calendars'),
        "icon" => Icon::show('calendar-o'),
        "active" => false,
        "url" => Url::to(["calendar/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="calendar-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
