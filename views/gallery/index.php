<?php
/**
 * Displays the index page to Gallery CRUD.
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
use \app\models\Gallery;

$this->title = Yii::t('gallery', 'Galleries');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('picture-o'),
        "active" => true,
        "url" => Url::to(["gallery/index"])
    ]
];
?>
<div class="gallery-index">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'value' => function (Gallery $data) {
                    return Html::a($data->getCategory()->name, $data->getCategory()->getLink());
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (Gallery $data) {
                    return $data->getStatus();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, Gallery $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
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
