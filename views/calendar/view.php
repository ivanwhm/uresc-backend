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
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('calendar', 'View calendar');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('calendar', 'Calendars'),
        "icon" => Icon::show('calendar-o'),
        "active" => false,
        "url" => Url::to(["calendar/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('eye'),
        "active" => true,
        "url" => Url::to(["calendar/view", 'id' => $model->id])
    ]
];
?>
<div class="calendar-view">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Icon::show('pencil') . Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Icon::show('trash') . Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
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
