<?php
/**
 * Displays the update page to Event CRUD.
 *
 * @var $this View
 * @var $model Event
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Event;
use app\models\User;
use app\models\Calendar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar evento";
$this->params['breadcrumbs'] = [
    [
        "label" => "Eventos",
        "icon" => "fa-calendar",
        "active" => false,
        "url" => Url::to(["event/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-calendar",
        "active" => true,
        "url" => Url::to(["event/view", 'id' => $model->id])
    ]
];
?>
<div class="event-view">

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
                'confirm' => 'Deseja excluir este evento?',
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
                'attribute' => 'calendar_id',
                'value' => ($model->getCalendar() instanceof Calendar) ? $model->getCalendar()->name : ''
            ],
            [
                'attribute' => 'date',
                'format' => ['date', 'short']
            ],
            [
                'attribute' => 'start_time',
                'format' => ['time', 'short']
            ],
            [
                'attribute' => 'end_time',
                'format' => ['time', 'short']
            ],
            [
                'attribute' => 'date_created',
                'format' => ['datetime', 'short']
            ],
            [
                'attribute' => 'user_created',
                'value' => ($model->getUserCreated() instanceof User) ? $model->getUserCreated()->getName() : ''
            ],
            [
                'attribute' => 'date_updated',
                'format' => ['datetime', 'short']
            ],
            [
                'attribute' => 'user_updated',
                'value' => ($model->getUserUpdated() instanceof User) ? $model->getUserUpdated()->getName() : ''
            ],
        ],
    ]) ?>

</div>
