<?php
/**
 * Displays the update page to Download CRUD.
 *
 * @var $this View
 * @var $model Download
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Download;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('download', 'Update download');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('download', 'Downloads'),
        "icon" => Icon::show('download'),
        "active" => false,
        "url" => Url::to(["download/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('pencil'),
        "active" => true,
        "url" => Url::to(["download/update", 'id' => $model->id])
    ]
];
?>
<div class="download-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
