<?php
/**
 * Displays the update page to Gallery Category CRUD.
 *
 * @var $this View
 * @var $model GalleryCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryCategory;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('gallery_category', 'Update gallery\'s category');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('gallery_category', 'Gallery\'s categories'),
        "icon" => Icon::show('file-picture-o'),
        "active" => false,
        "url" => Url::to(["gallery-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('pencil'),
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
