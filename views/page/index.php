<?php
/**
 * Displays the index page to Page CRUD.
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
use \app\models\Page;

$this->title = Yii::t('page', 'Pages');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('clipboard'),
        "active" => true,
        "url" => Url::to(["page/index"])
    ]
];
?>
<div class="page-index">

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
            [
                'attribute' => 'icon',
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
                'width' => '60px',
                'value' => function(Page $data) {
                    return (($data->icon == ''?Icon::show('clipboard'):Icon::show($data->icon)));
                }
            ],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function(Page $data) {
                    return Html::a($data->name, $data->getLink());
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, Page $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('page', 'Do you want to delete this page?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ]
    ]); ?>

</div>
