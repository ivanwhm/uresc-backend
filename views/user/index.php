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
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\View;
use yii\data\ActiveDataProvider;
use app\models\User;
use yii\helpers\Url;

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
        <?= Html::a('Novo usuário', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                'user_id',
                'name',
                'email:email',
                'username',
                [
                    'attribute' => 'status',
                    'value' => function ($data) {
                        return User::$statusData[$data->status];
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

    <?php Pjax::end(); ?>

</div>
