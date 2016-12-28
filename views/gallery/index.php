<?php
/**
 * Displays the index page to Gallery CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Galerias';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-picture-o",
        "active" => true,
        "url" => Url::to(["gallery/index"])
    ]
];
?>
<div class="gallery-index">

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
                'attribute' => 'category_id',
                'value' => function ($data) {
                    return $data->getCategory()->name;
                },
            ],
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return Gallery::$statusData[$data->status];
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
                            'class' => 'Gallery',
                            'data' => [
                                'confirm' => 'Deseja excluir este arquivo da galeria?',
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