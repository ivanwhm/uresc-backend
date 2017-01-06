<?php
/**
 * Displays the create page to Gallery Category CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model GalleryCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryCategory;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Adicionar categoria de galerias';
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
        "active" => true
    ]
];

?>
<div class="gallery-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
