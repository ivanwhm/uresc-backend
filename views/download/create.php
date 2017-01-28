<?php
/**
 * Displays the create page to Download CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Download
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Download;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('download', 'Add download');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('download', 'Downloads'),
        "icon" => Icon::show('archive'),
        "active" => false,
        "url" => Url::to(["download/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="download-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
