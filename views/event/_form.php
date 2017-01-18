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
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Enter the name of the event.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'calendar_id')->dropDownList(Calendar::getCalendars(), ['prompt' => '---', 'aria-describedby' => 'hbCalendar']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Select the calendar of the event.'), ['id' => 'hbCalendar', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'date')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_DATE]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Enter the date of the event.'), ['id' => 'hbDate', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'start_time')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_TIME]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Enter the start time of the event.'), ['id' => 'hbStartTime', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'end_time')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_TIME]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Enter the end time of the event.'), ['id' => 'hbEndTime', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'place')->textarea(['maxlength' => true, 'rows' => 3, 'aria-describedby' => 'hbPlace']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Enter the place (full address) of the event.'), ['id' => 'hbPlace', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'info')->widget(CKEditor::className()) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('event', 'Give us more information about the event.'), ['id' => 'hbInfo', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('general', 'Save'), [
            'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a(Yii::t('general', 'Cancel'), $model->getIsNewRecord() ? ['index'] : ['view', 'id' => $model->id], [
            'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
