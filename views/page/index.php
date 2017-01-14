<?php
/**
 * Displays the index page to Page CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Page
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
use \app\models\Page;

$this->title = Yii::t('page', 'Pages');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-clipboard",
        "active" => true,
        "url" => Url::to(["page/index"])
    ]
];
?>
<div class="page-index">

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
                                'confirm' => Yii::t('page', 'Do you want to delete this page?'),
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
