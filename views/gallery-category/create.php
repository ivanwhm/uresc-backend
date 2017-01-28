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
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('gallery_category', 'Add gallery\'s category');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('gallery_category', 'Gallery\'s categories'),
        "icon" => Icon::show('file-picture-o'),
        "active" => false,
        "url" => Url::to(["gallery-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="gallery-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
