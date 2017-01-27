<?php
/**
 * Displays the update page to Calendar CRUD.
 *
 * @var $this View
 * @var $model Calendar
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('calendar', 'View calendar');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('calendar', 'Calendars'),
        "icon" => "fa-calendar-o",
        "active" => false,
        "url" => Url::to(["calendar/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-calendar-o",
        "active" => true,
        "url" => Url::to(["calendar/view", 'id' => $model->id])
    ]
];
?>
<div class="calendar-view">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                        'confirm' => Yii::t('calendar', 'Do you want to delete this calendar?'),
                        'method' => 'post'
                ]
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->getStatus()
            ],
            'date_created:datetime',
            [
                'attribute' => 'user_created',
                'value' => $model->getUserCreated()->getName()
            ],
            'date_updated:datetime',
            [
                'attribute' => 'user_updated',
                'value' => $model->getUserUpdated()->getName()
            ],
        ],
    ]) ?>

</div>
