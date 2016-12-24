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
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Criar um arquivo';
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
        "active" => true
    ]
];

?>
<div class="download-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
