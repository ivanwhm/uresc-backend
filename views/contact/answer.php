<?php
/**
 * Displays the update page to Contact CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $model Contact
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Contact;
use app\models\User;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Responder contato';
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
        "url" => Url::to(["contact/answer", 'id' => $model->id])
    ]
];
?>
<div class="contact-answer">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
