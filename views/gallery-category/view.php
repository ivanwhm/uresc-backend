<?php
/**
 * Displays the update page to Gallery Category CRUD.
 *
 * @var $this View
 * @var $model GalleryCategory
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryCategory;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar categoria de galerias";
$this->params['breadcrumbs'] = [
    [
        "label" => "Categorias de galerias",
        "icon" => "fa-file-picture-o",
        "active" => false,
        "url" => Url::to(["gallery-category/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-file-picture-o",
        "active" => true,
        "url" => Url::to(["gallery-category/view", 'id' => $model->id])
    ]
];
?>
<div class="gallery-category-view">

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Deseja excluir esta categoria de galeria?', 'method' => 'post']]) ?>
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
            'userupdated.name',
        ],
    ]) ?>

</div>
