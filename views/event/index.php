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
use app\models\Event;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Eventos';
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
        <?= Html::a('Novo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'id',
            'name',
            [
                'attribute' => 'calendar_id',
                'value' => function ($data) {
                    return $data->getCalendar()->name;
                },
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'short']
            ],
            [
                'attribute' => 'start_time',
                'format' => ['time', 'short']
            ],
            [
                'attribute' => 'end_time',
                'format' => ['time', 'short']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'class' => 'Event',
                            'data' => [
                                'confirm' => 'Deseja excluir este evento?',
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
