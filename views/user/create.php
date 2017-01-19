<?php
/**
 * Displays the create page to User CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model User
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('user', 'Add user');
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
        "active" => true
    ]
];

?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
