<?php
/**
 * Displays the update page to Centre CRUD.
 *
 * @var $this View
 * @var $model Centre
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use app\models\Centre;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('centre', 'View spiritist centre');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('centre', 'Spiritist centres'),
        "icon" => Icon::show('hospital-o'),
        "active" => false,
        "url" => Url::to(["centre/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('eye'),
        "active" => true,
        "url" => Url::to(["centre/view", 'id' => $model->id])
    ]
];
?>
<div class="centre-view">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Icon::show('pencil') . Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Icon::show('trash') . Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('centre', 'Do you want to delete this spiritist centre?'),
                'method' => 'post'
            ]
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            'neighborhood',
            'city',
            'state',
            'phone',
            'email:email',
            'business_hours:ntext',
            [
                'attribute' => 'calendar_id',
                'format' => 'html',
                'value' => ($model->getCalendar() instanceof Calendar) ? Html::a($model->getCalendar()->name, $model->getCalendar()->getLink()) : ''
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
