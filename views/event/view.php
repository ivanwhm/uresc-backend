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
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('event', 'View event');
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
        "url" => Url::to(["event/view", 'id' => $model->id])
    ]
];
?>
<div class="event-view">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('event', 'Do you want to delete this event?'),
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
                'attribute' => 'calendar_id',
                'value' => $model->getCalendar()->name
            ],
            'date:date',
            'start_time:time',
            'end_time:time',
            'place:ntext',
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
