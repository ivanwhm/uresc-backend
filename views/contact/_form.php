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

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true, 'readonly' => true, 'aria-describedby' => 'hbContactEmail']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Contém o e-mail do contato.', ['id' => 'hbContactEmail', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'contact_message')->textarea(['maxlength' => true, 'readonly' => true, 'aria-describedby' => 'hbContactMessage', 'rows' => 5]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Contém a mensagem do contato.', ['id' => 'hbContactMessage', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'answer_message')->textarea(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbAnswerMessage', 'rows' => 10]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva o texto da resposta.', ['id' => 'hbAnswerMessage', 'class' => 'help-block']) ?>

    <div class="form-group">
        <?= Html::submitButton('Responder', [
                'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::a('Cancelar', ['view', 'id' => $model->id], [
                'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
