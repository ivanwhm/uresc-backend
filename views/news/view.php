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
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar notícia";
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
        "url" => Url::to(["news/view", 'id' => $model->id])
    ]
];
?>
<div class="news-view">

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= (!$model->getIsPublished()) ? Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Deseja excluir esta notícia?', 'method' => 'post']]) ?>
        <?= (!$model->getIsPublished()) ? Html::a('Publicar', ['published', 'id' => $model->id], ['class' => 'btn btn-info', 'data' => ['confirm' => 'Deseja publicar esta notícia?', 'method' => 'post']]) : '' ?>
        <?= ($model->getIsPublished()) ? Html::a('Despublicar', ['unpublished', 'id' => $model->id], ['class' => 'btn btn-info', 'data' => ['confirm' => 'Deseja despublicar esta notícia?', 'method' => 'post']]) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'published',
                'value' => $model->getPublished()
            ],
            'date_created:datetime',
            'usercreated.name',
            'date_updated:datetime',
            'userupdated.name',
        ],
    ]) ?>

</div>
