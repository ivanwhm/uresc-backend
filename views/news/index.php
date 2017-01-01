<?php
/**
 * Displays the index page to News CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Notícias';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-newspaper-o",
        "active" => true,
        "url" => Url::to(["news/index"])
    ]
];
?>
<div class="news-index">

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
            'title',
            [
                'attribute' => 'published',
                'value' => function ($data) {
                    return News::$publishedData[$data->published];
                },
            ],
            [
                'attribute' => 'date_created',
                'format' => ['datetime', 'short']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {published} {unpublished}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'class' => 'News',
                            'data' => [
                                'confirm' => 'Deseja excluir esta notícia?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'published' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-upload"></span>', [
                            'published', 'id' => $model->id
                        ], [
                            'class' => 'News',
                            'data' => [
                                'confirm' => 'Deseja publicar esta notícia?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'unpublished' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-download"></span>', [
                            'unpublished', 'id' => $model->id
                        ], [
                            'class' => 'News',
                            'data' => [
                                'confirm' => 'Deseja despublicar esta notícia?',
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return $model->published === News::PUBLISHED_NO;
                    },
                    'published' => function ($model, $key, $index) {
                        return $model->published === News::PUBLISHED_NO;
                    },
                    'unpublished' => function ($model, $key, $index) {
                        return $model->published === News::PUBLISHED_YES;
                    }
                ]
            ],
        ],
    ]);
    ?>

</div>
