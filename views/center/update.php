<?php
/**
 * Displays the update page to Center CRUD.
 *
 * @var $this View
 * @var $model Center
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Center;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar centro espírita';
$this->params['breadcrumbs'] = [
    [
        "label" => "Centros espíritas",
        "icon" => "fa-hospital-o",
        "active" => false,
        "url" => Url::to(["center/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-hospital-o",
        "active" => true,
        "url" => Url::to(["center/update", 'id' => $model->id])
    ]
];
?>
<div class="center-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
