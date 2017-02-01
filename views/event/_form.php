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
use app\models\User;
use kartik\datecontrol\DateControl;
use kartik\icons\Icon;
use kartik\select2\Select2;
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
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Enter the name of the event.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'calendar_id')->widget(Select2::classname(), ['data' => Calendar::getCalendars(), 'options' => ['prompt' => '---', 'aria-describedby' => 'hbCalendar']]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Select the calendar of the event.'), ['id' => 'hbCalendar', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'start_date')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_DATE]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Enter the start date of the event.'), ['id' => 'hbStartDate', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'end_date')->widget(DateControl::classname(), ['type'=>DateControl::FORMAT_DATE]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Enter the end date of the event.'), ['id' => 'hbEndDate', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'all_day')->widget(Select2::classname(), [
            'data' => Event::getAlLDayEventData(),
            'options' => [
                'prompt' => '---',
                'aria-describedby' => 'hbConfig',
                'onChange' => '                    
                    if ($(this).val() == "' . Event::ALL_DAY_YES . '") {
                        $("#event_time").fadeOut("slow");
                    } else if ($(this).val() == "' . Event::ALL_DAY_NO . '") {
                        $("#event_time").fadeIn("slow");
                    }',
        ]
    ]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Please tell us if the user can access the settings.'), ['id' => 'hbConfig', 'class' => 'help-block']) ?>

    <div id="event_time" style="<?= ($model->all_day == Event::ALL_DAY_YES) ? 'display: none;' : '' ?>">

        <?= $form->field($model, 'start_time')->widget(DateControl::classname(), ['type' => DateControl::FORMAT_TIME]) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Enter the start time of the event.'), ['id' => 'hbStartTime', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'end_time')->widget(DateControl::classname(), ['type' => DateControl::FORMAT_TIME]) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Enter the end time of the event.'), ['id' => 'hbEndTime', 'class' => 'help-block']) ?>

    </div>

    <?= $form->field($model, 'place')->textarea(['maxlength' => true, 'rows' => 3, 'aria-describedby' => 'hbPlace']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Enter the place (full address) of the event.'), ['id' => 'hbPlace', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'info')->widget(CKEditor::className()) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('event', 'Give us more information about the event.'), ['id' => 'hbInfo', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', Icon::show('user') . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
        <?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('download') . Yii::t('general', 'Save'), [
            'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a(Icon::show('ban') . Yii::t('general', 'Cancel'), $model->getIsNewRecord() ? ['index'] : ['view', 'id' => $model->id], [
            'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
