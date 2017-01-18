<?php
/**
 * Displays the create page to Gallery CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Gallery
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Gallery;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('gallery', 'Add gallery');
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
        "active" => true
    ]
];

?>
<div class="gallery-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
