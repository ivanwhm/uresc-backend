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
use kartik\dialog\DialogAsset;
use kartik\grid\ActionColumn;
use kartik\grid\CheckboxColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

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
            [
                'attribute' => 'category_id',
                'value' => $model->getCategory()->name
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->getStatus()
            ],
            'date_created:datetime',
            [
                'attribute' => 'user_created',
                'value' => $model->getUserCreated()->getName()
            ],
            'date_updated:datetime',
            [
                'attribute' => 'user_updated',
                'value' => $model->getUserUpdated()->getName()
            ],

        ],
    ]) ?>


    <?= Html::tag('br') ?>
    <?= Html::tag('h3', Yii::t('gallery', 'Files')) ?>

    <p>
        <?php DialogAsset::register($this); ?>
        <?= Html::a(Yii::t('gallery', 'Upload files'), ['upload', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('gallery', 'Delete files'), null, ['id' => 'deleteButton', 'class' => 'btn btn-danger']) ?>
        <?= $this->registerJs("
            $('#deleteButton').on('click', function()
            {
                var keys = $('#gallery-files-grid').yiiGridView('getSelectedRows');
                if (keys != '')
                {
                    if (confirm('" . Yii::t('gallery', 'Do you want to delete selected files?') . "'))
                    {
                        window.location = '" . Url::to(['gallery/dropsel', 'gallery_id' => $model->id]) . "&ids='+keys;
                    }
                }
            });
        "); ?>
    </p>

    <?= GridView::widget([
        'id' => 'gallery-files-grid',
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'columns' => [
            [
                'class' => CheckboxColumn::className()
            ],
            [
                'attribute' => 'filename',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img(Url::to(['gallery/image', 'id' => $data->id]));
                },
            ],
            [
                'class' => ActionColumn::className(),
                'header' => Yii::t('general', 'Actions'),
                'template' => '{delete}',
                'buttons' => [
                    'delete' => function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'drop', 'id' => $model->id
                        ], [
                            'class' => '',
                            'data' => [
                                'confirm' => Yii::t('gallery', 'Do you want to delete this file?'),
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
