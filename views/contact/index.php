<?php
/**
 * Displays the index page to Contact CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data Contact
 * @var $model Contact
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports

use app\models\Contact;
use yii\data\ActiveDataProvider;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;


$this->title = Yii::t('contact', 'Contacts');
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
            'id',
            'contact_name',
            'contact_email:email',
            'contact_date:datetime',
            [
                'attribute' => 'answer_sent',
                'format' => 'html',
                'value' => function ($data) {
                    return $data->getAnswerSent();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'header' => Yii::t('general', 'Actions'),
                'template' => '{view} {answer}',
                'buttons' => [
                    'answer' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-send"></span>', [
                            'answer', 'id' => $model->id
                        ], [
                            'title' => Yii::t('contact', 'Answer it')
                        ]);
                    },
                ],
                'visibleButtons' => [
                    'answer' => function ($model, $key, $index) {
                        return !$model->getIsAnswerSent();
                    },
                ],
            ],
        ],
    ]);
    ?>

</div>
