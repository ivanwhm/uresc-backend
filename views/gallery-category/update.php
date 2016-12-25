<?php
/**
 * Displays the update page to Gallery Category CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $model GalleryCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryCategory;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar categoria de galerias';
$this->params['breadcrumbs'] = [
    [
        "label" => "Categorias de galerias",
        "icon" => "fa-file-picture-o",
        "active" => false,
        "url" => Url::to(["gallery-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-file-picture-o",
        "active" => true,
        "url" => Url::to(["gallery-category/update", 'id' => $model->id])
    ]
];
?>
<div class="gallery-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
