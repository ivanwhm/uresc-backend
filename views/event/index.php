<?php
/**
 * Displays the index page to Event CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use kartik\icons\Icon;
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
        "icon" => Icon::show('calendar'),
        "active" => true,
        "url" => Url::to(["event/index"])
    ]
];
?>
<div class="event-index">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'hAlign' => GridView::ALIGN_LEFT,
                'width' => '70px',
            ],
            'name',
            [
                'attribute' => 'calendar_id',
                'format' => 'html',
                'width' => '180px',
                'value' => function (Event $data) {
                    return Html::a($data->getCalendar()->name, $data->getCalendar()->getLink());
                }
            ],
            [
                'header' => Yii::t('event', 'Starts'),
                'format' => 'raw',
                'width' => '180px',
                'value' => function (Event $data) {
                    return $data->printStarts();
                }
            ],
            [
                'header' => Yii::t('event', 'Ends'),
                'format' => 'raw',
                'width' => '180px',
                'value' => function (Event $data) {
                    return $data->printEnds();
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, Event $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
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
