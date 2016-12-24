<?php
/**
 * Displays the update page to Download CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $model Download
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\DownloadCategory;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar arquivo';
$this->params['breadcrumbs'] = [
    [
        "label" => "Arquivos",
        "icon" => "fa-archive",
        "active" => false,
        "url" => Url::to(["download/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-archive",
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
