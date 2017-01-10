<?php
/**
 * Displays the update page to Center CRUD.
 *
 * @var $this View
 * @var $model Center
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Center;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar centro espírita";
$this->params['breadcrumbs'] = [
    [
        "label" => "Centros espíritas",
        "icon" => "fa-hospital-o",
        "active" => false,
        "url" => Url::to(["center/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-hospital-o",
        "active" => true,
        "url" => Url::to(["center/view", 'id' => $model->id])
    ]
];
?>
<div class="center-view">

    <p>
        <?= Html::a('Adicionar', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], ['class' => 'btn btn-danger', 'data' => ['confirm' => 'Deseja excluir este centro espírita?', 'method' => 'post']]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'address',
            'neighborhood',
            'city',
            'state',
            'phone:phone',
            'email:email',
            'business_hours:ntext',
            'date_created:datetime',
            'usercreated.name',
            'date_updated:datetime',
            'userupdated.name',
        ],
    ]) ?>

</div>
