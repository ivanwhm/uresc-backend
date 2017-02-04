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
use app\models\User;
use kartik\icons\Icon;
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
        "icon" => Icon::show('newspaper-o'),
        "active" => true,
        "url" => Url::to(["news/index"])
    ]
];
?>
<div class="news-index">

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
            'title',
            [
                'attribute' => 'published',
                'format' => 'html',
                'width' => '120px',
                'value' => function (News $data) {
                    return $data->getPublished();
                },
            ],
            [
                'attribute' => 'date_published',
                'format' => ['datetime', 'short'],
                'width' => '150px',
            ],
            [
                'attribute' => 'user_published',
                'format' => 'html',
                'width' => '200px',
                'value' => function (News $data) {
                    return ($data->getUserPublished() instanceof User) ? Html::a($data->getUserPublished()->name, $data->getUserPublished()->getLink()) : '';
                }
            ],
            [
                'class' => ActionColumn::className(),
                'width' => '100px',
                'template' => '{view} {update} {delete} {published} {unpublished}',
                'buttons' => [
                    'delete' => function ($url, News $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('news', 'Do you want to delete this news?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'published' => function ($url, News $model) {
                        return Html::a(Icon::show('upload', '', Icon::BSG), [
                            'published', 'id' => $model->id
                        ], [
                            'title' => Yii::t('news', 'Publish'),
                            'data' => [
                                'confirm' => Yii::t('news', 'Do you want to publish this news?'),
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'unpublished' => function ($url, News $model) {
                        return Html::a(Icon::show('download', '', Icon::BSG), [
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
