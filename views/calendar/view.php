<?php
/**
 * Displays the update page to Calendar CRUD.
 *
 * @var $this View
 * @var $model Calendar
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar calendário";
$this->params['breadcrumbs'] = [
    [
        "label" => "Calendários",
        "icon" => "fa-calendar-o",
        "active" => false,
        "url" => Url::to(["calendar/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-calendar-o",
        "active" => true,
        "url" => Url::to(["calendar/view", 'id' => $model->id])
    ]
];
?>
<div class="calendar-view">

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
                'confirm' => 'Deseja excluir este calendário?',
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
                'value' => Calendar::$statusData[$model->status]
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
