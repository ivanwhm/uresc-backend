<?php
/**
 * Displays the update page to Gallery CRUD.
 *
 * @var $this View
 * @var $model Gallery
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Gallery;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar arquivo da galeria';
$this->params['breadcrumbs'] = [
    [
        "label" => "Galerias",
        "icon" => "fa-picture-o",
        "active" => false,
        "url" => Url::to(["gallery/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-picture-o",
        "active" => true,
        "url" => Url::to(["gallery/update", 'id' => $model->id])
    ]
];
?>
<div class="gallery-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
