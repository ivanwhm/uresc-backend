<?php
/**
 * Displays the index page to Gallery CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data Gallery
 * @var $model Gallery
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
use \app\models\Gallery;

$this->title = Yii::t('gallery', 'Galleries');
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
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data->getCategory()->name, $data->getCategory()->getLink());
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->getStatus();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'header' => Yii::t('general', 'Actions'),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('gallery', 'Do you want to delete this gallery?'),
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
