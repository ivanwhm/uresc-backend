<?php
/**
 * Displays the update page to Download CRUD.
 *
 * @var $this View
 * @var $model Download
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Download;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('download', 'View download');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('download', 'Downloads'),
        "icon" => "fa-archive",
        "active" => false,
        "url" => Url::to(["download/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-archive",
        "active" => true,
        "url" => Url::to(["download/view", 'id' => $model->id])
    ]
];
?>
<div class="download-view">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('download', 'Do you want to delete this download?'),
                'method' => 'post'
            ]
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'value' => Html::a($model->getCategory()->name, $model->getCategory()->getLink())
            ],
            'address:url',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->getStatus()
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
