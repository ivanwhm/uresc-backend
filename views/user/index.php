<?php
/**
 * Displays the index page to User CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data User
 * @var $model User
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
use \app\models\User;

$this->title = Yii::t('user', 'Users');
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
                    'class' => ActionColumn::className(),
                    'header' => Yii::t('general', 'Actions'),
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'delete' => function($url, $model){
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                                    'delete', 'id' => $model->id
                            ], [
                                'class' => '',
                                'data' => [
                                    'confirm' => Yii::t('user', 'Do you want to delete this user?'),
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
