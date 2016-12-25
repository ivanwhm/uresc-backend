<?php
/**
 * Displays the update page to Department CRUD.
 *
 * @var $this View
 * @var $model Department
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Department;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar departamento";
$this->params['breadcrumbs'] = [
    [
        "label" => "Departamentos",
        "icon" => "fa-files-o",
        "active" => false,
        "url" => Url::to(["department/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-files-o",
        "active" => true,
        "url" => Url::to(["department/view", 'id' => $model->id])
    ]
];
?>
<div class="department-view">

    <p>
        <?= Html::a('Novo', ['create'], [
                'class' => 'btn btn-success'
        ]) ?>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], [
            'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Deseja excluir este departamento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'status',
                'value' => Department::$statusData[$model->status]
            ],
            [
                'attribute' => 'date_created',
                'format' => ['datetime', 'long']
            ],
            [
                'attribute' => 'user_created',
                'value' => ($model->getUserCreated() instanceof User) ? $model->getUserCreated()->getName() : ''
            ],
            [
                'attribute' => 'date_updated',
                'format' => ['datetime', 'long']
            ],
            [
                'attribute' => 'user_updated',
                'value' => ($model->getUserUpdated() instanceof User) ? $model->getUserUpdated()->getName() : ''
            ],
        ],
    ]) ?>

</div>
