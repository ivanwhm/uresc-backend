<?php
/**
 * Displays the upload page to Gallery CRUD.
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

$this->title = Yii::t('gallery', 'Upload files');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('gallery', 'Galleries'),
        "icon" => Icon::show('picture-o'),
        "active" => false,
        "url" => Url::to(["gallery/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('upload'),
        "active" => true,
        "url" => Url::to(["gallery/view", 'id' => $model->id])
    ]];

?>
<div class="gallery-upload">

    <?= $this->render('_form_upload', [
        'model' => $model,
    ]) ?>

</div>
