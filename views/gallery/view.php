<?php
/**
 * Displays the update page to Gallery CRUD.
 *
 * @var $this View
 * @var $model Gallery
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Gallery;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = Yii::t('gallery', 'View gallery');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('gallery', 'Galleries'),
        "icon" => "fa-picture-o",
        "active" => false,
        "url" => Url::to(["gallery/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-picture-o",
        "active" => true,
        "url" => Url::to(["gallery/view", 'id' => $model->id])
    ]
];
?>
<div class="gallery-view">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('gallery', 'Do you want to delete this gallery?'),
                'method' => 'post'
            ]
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'category.name',
            'address:url',
            [
                'attribute' => 'status',
                'value' => $model->getStatus()
            ],
            'date_created:datetime',
            'usercreated.name',
            'date_updated:datetime',
            'userupdated.name',
        ],
    ]) ?>

</div>
