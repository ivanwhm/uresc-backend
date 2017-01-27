<?php
/**
 * Displays the create page to Contact CRUD.
 *
 * @var $this View
 * @var $model Contact
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Contact;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="contact-form">

    <?php $form = ActiveForm::begin([
            'id' => 'contact-form',
        ]
    ); ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true, 'readonly' => true, 'aria-describedby' => 'hbContactName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('contact', 'Contact\'s name.'), ['id' => 'hbContactName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true, 'readonly' => true, 'aria-describedby' => 'hbContactEmail']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('contact', 'Contact\'s e-mail.'), ['id' => 'hbContactEmail', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'contact_message')->textarea(['maxlength' => true, 'readonly' => true, 'aria-describedby' => 'hbContactMessage', 'rows' => 5]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('contact', 'Contact\'s message.'), ['id' => 'hbContactMessage', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'answer_message')->textarea(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbAnswerMessage', 'rows' => 10]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('contact', 'Enter the text of the answer.'), ['id' => 'hbAnswerMessage', 'class' => 'help-block']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('contact', 'Answer it'), [
                'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::a(Yii::t('general', 'Cancel'), ['view', 'id' => $model->id], [
                'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
