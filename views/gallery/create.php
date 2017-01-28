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
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('gallery', 'Add gallery');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('gallery', 'Galleries'),
        "icon" => Icon::show('picture-o'),
        "active" => false,
        "url" => Url::to(["gallery/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="gallery-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
