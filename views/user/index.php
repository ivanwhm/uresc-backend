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
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use \app\models\User;

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('user'),
        "active" => true,
        "url" => Url::to(["user/index"])
    ]
];
?>
<div class="user-index">

    <p>
        <?= Html::a(Icon::show('plus') . Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'columns' => [
            'id',
            'name',
            'email:email',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function (User $data) {
                    return $data->getStatus();
                },
            ],
            [
                'attribute' => 'can_access_settings',
                'format' => 'html',
                'value' => function (User $data) {
                    return $data->getCanAccessSettings();
                },
            ],
            [
                'attribute' => 'language',
                'format' => 'html',
                'value' => function (User $data) {
                    return Icon::show($data->getLanguageCountry(), '', Icon::FI) . $data->getLanguage();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, User $model) {
                        return Html::a(Icon::show('trash', '', Icon::BSG), [
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
