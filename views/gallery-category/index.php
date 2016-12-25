<?php
/**
 * Displays the index page to Gallery Category CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryCategory;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Categorias de galerias';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-file-picture-o",
        "active" => true,
        "url" => Url::to(["gallery-category/index"])
    ]
];
?>
<div class="gallery-category-index">

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
                'attribute' => 'status',
                'value' => function ($data) {
                    return GalleryCategory::$statusData[$data->status];
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
                            'class' => 'GalleryCategory',
                            'data' => [
                                'confirm' => 'Deseja excluir esta categoria de galeria?',
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
