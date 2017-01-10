<?php
/**
 * Displays the index page to User CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Usuários';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-user",
        "active" => true,
        "url" => Url::to(["user/index"])
    ]
];
?>
<div class="user-index">

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                'id',
                'name',
                'email:email',
                'username',
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return $data->getStatus();
                    },
                ],
                [
                    'attribute' => 'can_config',
                    'value' => function ($data) {
                        return $data->getCanConfig();
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                                    'delete', 'id' => $model->id
                            ], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Deseja excluir este usuário?',
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
