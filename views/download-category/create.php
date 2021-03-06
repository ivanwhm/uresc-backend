<?php
/**
 * Displays the create page to Download Category CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model DownloadCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\DownloadCategory;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('download_category', 'Add download\'s category');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('download_category', 'Download\'s categories'),
        "icon" => Icon::show('file-archive-o'),
        "active" => false,
        "url" => Url::to(["download-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="download-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
