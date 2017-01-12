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
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = Yii::t('center', 'View spiritist center');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('center', 'Spiritist centers'),
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
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('general', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('general', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('center', 'Do you want to delete this spiritist center?'),
                'method' => 'post'
            ]
        ]) ?>
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
