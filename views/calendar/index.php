<?php
/**
 * Displays the index page to Calendar CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data Calendar
 * @var $model Calendar
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('calendar', 'Calendars');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-calendar-o",
        "active" => true,
        "url" => Url::to(["calendar/index"])
    ]
];
?>
<div class="calendar-index">

    <p>
        <?= Html::a(Yii::t('general', 'Add'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->getStatus();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'header' => Yii::t('general', 'Actions'),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', [
                            'delete', 'id' => $model->id
                        ], [
                            'data' => [
                                'confirm' => Yii::t('calendar', 'Do you want to delete this calendar?'),
                                'method' => 'post',
                            ],
                        ]);
                    }
                ]
            ],
        ],
    ]);
    ?>

</div>
