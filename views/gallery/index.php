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
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Galerias';
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
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => SerialColumn::className()
            ],
            'id',
            'name',
            'category.name',
            [
                'attribute' => 'status',
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
                                'confirm' => 'Deseja excluir este arquivo da galeria?',
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
