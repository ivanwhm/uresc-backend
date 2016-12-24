<?php
/**
 * Displays the update page to Download Category CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $model DownloadCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\DownloadCategory;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar categoria de download';
$this->params['breadcrumbs'] = [
    [
        "label" => "Categorias de download",
        "icon" => "fa-archive",
        "active" => false,
        "url" => Url::to(["download-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-archive",
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
