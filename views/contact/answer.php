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
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('contact', 'Answer contact');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('contact', 'Contacts'),
        "icon" => Icon::show('mail-reply-all'),
        "active" => false,
        "url" => Url::to(["contact/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('send'),
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
