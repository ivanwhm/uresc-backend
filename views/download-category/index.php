<?php
/**
 * Displays the index page to Download Category CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\DownloadCategory;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('download_category', 'Download\'s categories');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('file-archive-o'),
        "active" => true,
        "url" => Url::to(["download-category/index"])
    ]
];
?>
<div class="download-category-index">

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
                'attribute' => 'status',
                'format' => 'html',
                'width' => '120px',
                'value' => function (DownloadCategory $data) {
                    return $data->getStatus();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, DownloadCategory $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('download_category', 'Do you want to delete this download\'s category?'),
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
