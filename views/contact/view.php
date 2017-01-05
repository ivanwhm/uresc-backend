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
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\DetailView;

$this->title = "Visualizar contato";
$this->params['breadcrumbs'] = [
    [
        "label" => "Contatos",
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
        <?= ($model->answer_sent == Contact::ANSWER_SENT_NO) ? Html::a('Responder', ['answer', 'id' => $model->id], ['class' => 'btn btn-success']) : '' ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'contact_email:email',
            [
                'attribute' => 'contact_date',
                'format' => ['datetime', 'short']
            ],
            'contact_message',
            'contact_ip',
            [
                'attribute' => 'answer_sent',
                'value' => Contact::$answerSentData[$model->answer_sent]
            ],
            [
                'attribute' => 'answer_date',
                'format' => ['datetime', 'short']
            ],
            [
                'attribute' => 'answer_user_id',
                'value' => ($model->getAnswerUser() instanceof User) ? $model->getAnswerUser()->getName() : ''
            ],
            'answer_message'
        ],
    ]) ?>

</div>
