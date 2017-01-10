<?php
/**
 * Displays the index page to Contact CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Contact;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Contatos';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-mail-reply-all",
        "active" => true,
        "url" => Url::to(["contact/index"])
    ]
];
?>
<div class="contact-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'id',
            'contact_email:email',
            'contact_date:datetime',
            'contact_message',
            [
                'attribute' => 'answer_sent',
                'value' => function ($data) {
                    return $data->getAnswerSent();
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {answer}',
                'buttons' => [
                    'answer' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-send"></span>', [
                            'answer', 'id' => $model->id
                        ], ['class' => 'Contact']);
                    },
                ],
                'visibleButtons' => [
                    'answer' => function ($model, $key, $index) {
                        return $model->getIsNoAnswerSent();
                    },
                ],
            ],
        ],
    ]);
    ?>

</div>
