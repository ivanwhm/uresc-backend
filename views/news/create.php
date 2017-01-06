<?php
/**
 * Displays the create page to News CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model News
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Adicionar notícia';
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
        "active" => true
    ]
];

?>
<div class="news-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
