<?php
/**
 * Displays the index page to Download CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use kartik\icons\Icon;
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
        "icon" => Icon::show('archive'),
        "active" => true,
        "url" => Url::to(["download/index"])
    ]
];
?>
<div class="download-index">

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
            'name',
            [
                'attribute' => 'category_id',
                'format' => 'html',
                'width' => '180px',
                'value' => function (Download $data) {
                    return Html::a($data->getCategory()->name, $data->getCategory()->getLink());
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'width' => '120px',
                'value' => function (Download $data) {
                    return $data->getStatus();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, Download $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
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
