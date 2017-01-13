<?php
/**
 * Displays the index page to Center CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('center', 'Spiritist centers');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-hospital-o",
        "active" => true,
        "url" => Url::to(["center/index"])
    ]
];
?>
<div class="center-index">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => SerialColumn::className()
            ],
            'id',
            'name',
            'city',
            'state',
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
                                'confirm' => Yii::t('center', 'Do you want to delete this spiritist center?'),
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
