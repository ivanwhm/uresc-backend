<?php
/**
 * Displays the create page to Event CRUD.
 *
 * @var $this View
 * @var $model Event
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use app\models\Event;
use kartik\datecontrol\DateControl;
use wadeshuler\ckeditor\widgets\CKEditor;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="event-form">

    <?php $form = ActiveForm::begin([
            'id' => 'event-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome do evento.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'calendar_id')->dropDownList(Calendar::getCalendars(), ['prompt' => '---', 'aria-describedby' => 'hbCalendar']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Selecione o calendário que está associado ao evento.', ['id' => 'hbCalendar', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'date')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_DATE]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a data do evento.', ['id' => 'hbDate', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'start_time')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_TIME]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a hora de início do evento.', ['id' => 'hbStartTime', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'end_time')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_TIME]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a hora de término do evento.', ['id' => 'hbEndTime', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'info')->widget(CKEditor::className()) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva as informações sobre o evento.', ['id' => 'hbInfo', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Criado em ' . Yii::$app->getFormatter()->asDatetime($model->date_created, 'short') . ' por ' . $model->getUserCreated()->getName() . '.', ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Última alteração em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated, 'short') . ' por ' . $model->getUserUpdated()->getName() . '.', ['class' => 'help-block']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Alterar', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a('Cancelar', ['index'], [
            'class' => 'btn btn-danger',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
