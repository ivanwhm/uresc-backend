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
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'id',
            'name',
            'calendar.name',
            'date:date',
            'start_time.time',
            'end_time.time',
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
