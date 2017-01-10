<?php
/**
 * Displays the update page to Download CRUD.
 *
 * @var $this View
 * @var $model Download
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Download;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar arquivo";
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
        "url" => Url::to(["download/view", 'id' => $model->id])
    ]
];
?>
<div class="download-view">

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Deseja excluir este arquivo?', 'method' => 'post']]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'category.name',
            'address:url',
            [
                'attribute' => 'status',
                'value' => $model->getStatus()
            ],
            'date_created:datetime',
            'usercreated.name',
            'date_updated:datetime',
            'userupdated.name',
        ],
    ]) ?>

</div>
