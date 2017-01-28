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
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('event', 'View event');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('event', 'Events'),
        "icon" => Icon::show('calendar'),
        "active" => false,
        "url" => Url::to(["event/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('eye'),
        "active" => true,
        "url" => Url::to(["event/view", 'id' => $model->id])
    ]
];
?>
<div class="event-view">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Icon::show('pencil') . Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Icon::show('trash') . Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
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
                'format' => 'html',
                'value' => Html::a($model->getCalendar()->name, $model->getCalendar()->getLink())
            ],
            'date:date',
            'start_time:time',
            'end_time:time',
            'place:ntext',
            'date_created:datetime',
            [
                'attribute' => 'user_created',
                'format' => 'html',
                'value' => Html::a($model->getUserCreated()->getName(), $model->getUserCreated()->getLink())
            ],
            'date_updated:datetime',
            [
                'attribute' => 'user_updated',
                'format' => 'html',
                'value' => Html::a($model->getUserUpdated()->getName(), $model->getUserUpdated()->getLink())
            ],
        ],
    ]) ?>

</div>
