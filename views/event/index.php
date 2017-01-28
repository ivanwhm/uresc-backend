<?php
/**
 * Displays the index page to Event CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Event
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\data\ActiveDataProvider;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use \app\models\Event;

$this->title = Yii::t('event', 'Events');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-calendar",
        "active" => true,
        "url" => Url::to(["event/index"])
    ]
];
?>
<div class="event-index">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'calendar_id',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->getCalendar()->name, $data->getCalendar()->getLink());
                }
            ],
            'date:date',
            'start_time:time',
            'end_time:time',
            [
                'class' => ActionColumn::className(),
                'header' => Yii::t('general', 'Actions'),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('event', 'Do you want to delete this event?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]);
    ?>

</div>
