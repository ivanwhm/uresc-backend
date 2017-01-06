<?php
/**
 * Displays the index page to Download CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Download;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Arquivos';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-archive",
        "active" => true,
        "url" => Url::to(["download/index"])
    ]
];
?>
<div class="download-index">

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
                'attribute' => 'category_id',
                'value' => function ($data) {
                    return $data->getCategory()->name;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Download::$statusData[$data->status];
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
                            'class' => 'Download',
                            'data' => [
                                'confirm' => 'Deseja excluir este arquivo?',
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
