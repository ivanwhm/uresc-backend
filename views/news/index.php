<?php
/**
 * Displays the index page to News CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data News
 * @var $model News
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
use \app\models\News;

$this->title = Yii::t('news', 'News');
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
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title',
            [
                'attribute' => 'published',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->getPublished();
                },
            ],
            [
                'attribute' => 'date_created',
                'format' => ['datetime', 'short']
            ],
            [
                'class' => ActionColumn::className(),
                'header' => Yii::t('general', 'Actions'),
                'width' => '100px',
                'template' => '{view} {update} {delete} {published} {unpublished}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('news', 'Do you want to delete this news?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'published' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-upload"></span>', [
                            'published', 'id' => $model->id
                        ], [
                            'title' => Yii::t('news', 'Publish'),
                            'data' => [
                                'confirm' => Yii::t('news', 'Do you want to publish this news?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'unpublished' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-download"></span>', [
                            'unpublished', 'id' => $model->id
                        ], [
                            'title' => Yii::t('news', 'Unpublish'),
                            'data' => [
                                'confirm' => Yii::t('news', 'Do you want to unpublish this news?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                ],
                'visibleButtons' => [
                    'update' => function ($model, $key, $index) {
                        return !$model->getIsPublished();
                    },
                    'published' => function ($model, $key, $index) {
                        return !$model->getIsPublished();
                    },
                    'unpublished' => function ($model, $key, $index) {
                        return $model->getIsPublished();
                    }
                ]
            ],
        ],
    ]);
    ?>

</div>
