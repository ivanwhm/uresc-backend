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
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar categoria de arquivos";
$this->params['breadcrumbs'] = [
    [
        "label" => "Categorias de arquivos",
        "icon" => "fa-file-archive-o",
        "active" => false,
        "url" => Url::to(["download-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-file-archive-o",
        "active" => true,
        "url" => Url::to(["download-category/view", 'id' => $model->id])
    ]
];
?>
<div class="download-category-view">

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Deseja excluir esta categoria de arquivo?', 'method' => 'post']]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'status',
                'value' => $model->getStatus()
            ],
            'date_created:datetime',
            'usercreated.name',
            'date_updated:datetime',
            'userupdated.name'
        ],
    ]) ?>

</div>
