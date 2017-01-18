<?php
/**
 * Displays the update page to News CRUD.
 *
 * @var $this View
 * @var $model News
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = Yii::t('news', 'View news');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('news', 'News'),
        "icon" => "fa-newspaper-o",
        "active" => false,
        "url" => Url::to(["news/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-newspaper-o",
        "active" => true,
        "url" => Url::to(["news/view", 'id' => $model->id])
    ]
];
?>
<div class="news-view">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= (!$model->getIsPublished()) ? Html::a(Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : ''?>
        <?= Html::a(Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('news', 'Do you want to delete this news?'),
                'method' => 'post'
            ]
        ]) ?>
        <?= (!$model->getIsPublished()) ? Html::a(Yii::t('news', 'Publish'), ['published', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data' => [
                    'confirm' => Yii::t('news', 'Do you want to publish this news?'),
                    'method' => 'post'
                ]
        ]) : '' ?>
        <?= ($model->getIsPublished()) ? Html::a(Yii::t('news', 'Unpublish'), ['unpublished', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data' => [
                        'confirm' => Yii::t('news', 'Do you want to unpublish this news?'),
                        'method' => 'post'
                ]
        ]) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'published',
                'value' => $model->getPublished()
            ],
            'date_created:datetime',
            'usercreated.name',
            'date_updated:datetime',
            'userupdated.name',
        ],
    ]) ?>

</div>
