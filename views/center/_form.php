<?php
/**
 * Displays the create page to Center CRUD.
 *
 * @var $this View
 * @var $model Center
 * @var $form ActiveForm
 * @var $mask string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Center;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

?>

<div class="center-form">

    <?php $form = ActiveForm::begin([
            'id' => 'center-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the name of the spiritist center.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the address of the spiritist center.'), ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'neighborhood')->textInput(['maxlength' => true, 'aria-describedby' => 'hbNeighborhood']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the neighborhood of the spiritist center.'), ['id' => 'hbNeighborhood', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'aria-describedby' => 'hbCity']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the city of the spiritist center.'), ['id' => 'hbCity', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'aria-describedby' => 'hbState']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the state of the spiritist center.'), ['id' => 'hbState', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['mask' => $mask]) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the phone of the spiritist center.'), ['id' => 'hbPhone', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'aria-describedby' => 'hbEmail']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the e-mail of the spiritist center.'), ['id' => 'hbEmail', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'business_hours')->textarea(['maxlength' => true, 'row' => 5, 'aria-describedby' => 'hbBusinessHours']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('center', 'Enter the business hours of the spiritist center.'), ['id' => 'hbBusinessHours', 'class' => 'help-block']) ?>

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
