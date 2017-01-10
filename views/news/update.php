<?php
/**
 * Displays the update page to News CRUD.
 *
 * @var $this View
 * @var $model News
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar notícia';
$this->params['breadcrumbs'] = [
    [
        "label" => "Notícias",
        "icon" => "fa-newspaper-o",
        "active" => false,
        "url" => Url::to(["news/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-newspaper-o",
        "active" => true,
        "url" => Url::to(["news/update", 'id' => $model->id])
    ]
];
?>
<div class="news-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
