<?php
/**
 * Displays the index page to Download CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data Download
 * @var $model Download
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
use \app\models\Download;

$this->title = Yii::t('download', 'Downloads');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-archive",
        "active" => true,
        "url" => Url::to(["download/index"])
    ]
];
?>
<div class="download-index">

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
                }
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
                                'confirm' => Yii::t('download', 'Do you want to delete this download?'),
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
