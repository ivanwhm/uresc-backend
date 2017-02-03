<?php
/**
 * Displays the create page to Centre CRUD.
 *
 * @var $this View
 * @var $model Centre
 * @var $form ActiveForm
 * @var $mask string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Calendar;
use app\models\Centre;
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>

<div class="centre-form">

    <?php $form = ActiveForm::begin([
            'id' => 'centre-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the name of the spiritist centre.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the address of the spiritist centre.'), ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'neighborhood')->textInput(['maxlength' => true, 'aria-describedby' => 'hbNeighborhood']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the neighborhood of the spiritist centre.'), ['id' => 'hbNeighborhood', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'aria-describedby' => 'hbCity']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the city of the spiritist centre.'), ['id' => 'hbCity', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'aria-describedby' => 'hbState']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the state of the spiritist centre.'), ['id' => 'hbState', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['mask' => $mask]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the phone of the spiritist centre.'), ['id' => 'hbPhone', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'aria-describedby' => 'hbEmail']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the e-mail of the spiritist centre.'), ['id' => 'hbEmail', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'business_hours')->textarea(['maxlength' => true, 'row' => 5, 'aria-describedby' => 'hbBusinessHours']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Enter the business hours of the spiritist centre.'), ['id' => 'hbBusinessHours', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'calendar_id')->widget(Select2::classname(), ['data' => Calendar::getCalendars(), 'options' => ['prompt' => '---', 'aria-describedby' => 'hbCalendar']]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('centre', 'Select the calendar of the spiritist centre.'), ['id' => 'hbCalendar', 'class' => 'help-block']) ?>

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
