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
use kartik\icons\Icon;
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
        "icon" => Icon::show('mail-reply-all'),
        "active" => true,
        "url" => Url::to(["contact/index"])
    ]
];
?>
<div class="contact-index">

    <?= GridView::widget([
        'pjax' => true,
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'hAlign' => GridView::ALIGN_LEFT,
                'width' => '70px',
            ],
            'contact_name',
            'contact_email:email',
            [
                'attribute' => 'contact_date',
                'format' => 'datetime',
                'width' => '150px',
            ],
            [
                'attribute' => 'answer_sent',
                'format' => 'html',
                'width' => '120px',
                'value' => function (Contact $data) {
                    return $data->getAnswerSent();
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {answer}',
                'buttons' => [
                    'answer' => function ($url, Contact $model) {
                        return Html::a(Icon::show('send', '', Icon::BSG), [
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
