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
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'Update user');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('user', 'Users'),
        "icon" => "fa-user",
        "active" => false,
        "url" => Url::to(["user/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-user",
        "active" => true,
        "url" => Url::to(["user/update", 'id' => $model->id])
    ]
];
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
