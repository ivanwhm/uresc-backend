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
use app\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('news', 'View news');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('news', 'News'),
        "icon" => Icon::show('newspaper-o'),
        "active" => false,
        "url" => Url::to(["news/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('eye'),
        "active" => true,
        "url" => Url::to(["news/view", 'id' => $model->id])
    ]
];
?>
<div class="news-view">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= (!$model->getIsPublished()) ? Html::a(Icon::show('pencil') . Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : ''?>
        <?= Html::a(Icon::show('trash') . Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('news', 'Do you want to delete this news?'),
                'method' => 'post'
            ]
        ]) ?>
        <?= (!$model->getIsPublished()) ? Html::a(Icon::show('upload') . Yii::t('news', 'Publish'), ['published', 'id' => $model->id], [
                'class' => 'btn btn-info',
                'data' => [
                    'confirm' => Yii::t('news', 'Do you want to publish this news?'),
                    'method' => 'post'
                ]
        ]) : '' ?>
        <?= ($model->getIsPublished()) ? Html::a(Icon::show('download') . Yii::t('news', 'Unpublish'), ['unpublished', 'id' => $model->id], [
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
                'format' => 'html',
                'value' => $model->getPublished()
            ],
            [
                'attribute' => 'date_published',
                'format' => 'datetime',
                'visible' => ($model->getIsPublished())
            ],
            [
                'attribute' => 'user_published',
                'format' => 'html',
                'value' => ($model->getUserPublished() instanceof User) ? Html::a($model->getUserPublished()->getName(), $model->getUserPublished()->getLink()) : '',
                'visible' => ($model->getIsPublished())
            ],
            'date_created:datetime',
            [
                'attribute' => 'user_created',
                'format' => 'html',
                'value' => Html::a($model->getUserCreated()->getName(), $model->getUserCreated()->getLink())
            ],
            'date_updated:datetime',
            [
                'attribute' => 'user_updated',
                'format' => 'html',
                'value' => Html::a($model->getUserUpdated()->getName(), $model->getUserUpdated()->getLink())
            ],
        ],
    ]) ?>

</div>
