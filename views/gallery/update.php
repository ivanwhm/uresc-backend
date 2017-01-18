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

$this->title = Yii::t('gallery', 'Update gallery');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('gallery', 'Galleries'),
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
