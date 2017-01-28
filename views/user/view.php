<?php
/**
 * Displays the update page to User CRUD.
 *
 * @var $this View
 * @var $model User
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\User;
use app\models\UserAccess;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use kartik\detail\DetailView;

$this->title = Yii::t('user', 'View user');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('user', 'Users'),
        "icon" => Icon::show('user'),
        "active" => false,
        "url" => Url::to(["user/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('eye'),
        "active" => true,
        "url" => Url::to(["user/view", 'id' => $model->id])
    ]
];
?>
<div class="user-view">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Icon::show('pencil') . Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Icon::show('trash') . Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('user', 'Do you want to delete this user?'),
                'method' => 'post'
            ]
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->getStatus()
            ],
            [
                'attribute' => 'can_access_settings',
                'format' => 'html',
                'value' => $model->getCanAccessSettings()
            ],
            [
                'attribute' => 'language',
                'format' => 'html',
                'value' => Icon::show($model->getLanguageCountry(), '', Icon::FI) . $model->getLanguage()
            ],
            'date_created:datetime',
            [
                'attribute' => 'user_created',
                'format' => 'html',
                'value' => Html::a($model->getUserCreated()->getName(), $model->getUserCreated()->getLink())
            ],
            'date_updated:datetime',
            [
                'attribute' => 'user_updated',
                'format' => 'html',
                'value' => Html::a($model->getUserUpdated()->getName(), $model->getUserUpdated()->getLink())
            ],
        ],
    ]) ?>

    <?= Html::tag('br') ?>
    <?= Html::tag('h3', Yii::t('user', 'Last hits')) ?>

    <?= GridView::widget([
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            'date:datetime',
            [
                'attribute' => 'type',
                'format' => 'html',
                'value' => function (UserAccess $data) {
                    return $data->getType();
                },
            ],
            'ip',
        ],
    ]);
    ?>

</div>
