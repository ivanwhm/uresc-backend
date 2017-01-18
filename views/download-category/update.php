<?php
/**
 * Displays the update page to Download Category CRUD.
 *
 * @var $this View
 * @var $model DownloadCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\DownloadCategory;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('download_category', 'Update download\'s category');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('download_category', 'Download\'s categories'),
        "icon" => "fa-file-archive-o",
        "active" => false,
        "url" => Url::to(["download-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-file-archive-o",
        "active" => true,
        "url" => Url::to(["download-category/update", 'id' => $model->id])
    ]
];
?>
<div class="download-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
