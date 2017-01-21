<?php
/**
 * Displays the update page to Contact CRUD.
 *
 * @var $this View
 * @var $model Contact
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Contact;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = Yii::t('contact', 'View contact');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('contact', 'Contacts'),
        "icon" => "fa-mail-reply-all",
        "active" => false,
        "url" => Url::to(["contact/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-mail-reply-all",
        "active" => true,
        "url" => Url::to(["contact/view", 'id' => $model->id])
    ]
];
?>
<div class="contact-view">

    <p>
        <?= (!$model->getIsAnswerSent()) ? Html::a(Yii::t('contact', 'Answer it'), ['answer', 'id' => $model->id], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'contact_email:email',
            'contact_date:datetime',
            'contact_message:ntext',
            'contact_ip',
            [
                'attribute' => 'answer_sent',
                'format' => 'html',
                'value' => $model->getAnswerSent(),
                'visible' => ($model->getIsAnswerSent())
            ],
            [
                'attribute' => 'answer_date',
                'format' => 'datetime',
                'visible' => ($model->getIsAnswerSent())
            ],
            [
                'attribute' => 'answeruser.name',
                'visible' => ($model->getIsAnswerSent())
            ],
            [
                'attribute' => 'answer_message',
                'format' => 'ntext',
                'visible' => ($model->getIsAnswerSent())
            ]
        ],
    ]) ?>

</div>
