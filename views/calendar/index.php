<?php
/**
 * Displays the index page to Calendar CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Calendários';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-calendar-o",
        "active" => true,
        "url" => Url::to(["calendar/index"])
    ]
];
?>
<div class="calendar-index">

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
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return $data->getStatus();
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'class' => 'Calendar',
                            'data' => [
                                'confirm' => 'Deseja excluir este calendário?',
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
