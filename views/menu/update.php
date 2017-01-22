<?php
/**
 * Displays the update page to User CRUD.
 *
 * @var $this View
 * @var $model Menu
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('menu', 'Change menu order');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('menu', 'Menus'),
        "icon" => "fa-bars",
        "active" => false,
        "url" => Url::to(["user/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-bars",
        "active" => true,
        "url" => Url::to(["menu/update", 'id' => $model->id])
    ]
];
?>
<div class="menu-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
