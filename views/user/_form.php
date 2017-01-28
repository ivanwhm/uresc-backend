<?php
/**
 * Displays the create page to User CRUD.
 *
 * @var $this View
 * @var $model User
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\User;
use kartik\icons\Icon;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="user-form">

    <?php $form = ActiveForm::begin([
            'id' => 'user-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Enter the name of the user.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'aria-describedby' => 'hbEmail']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Enter the e-mail of the user.'), ['id' => 'hbEmail', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'password')->widget(PasswordInput::classname(), ['options' => ['aria-describedby' => 'hbPassword'], 'pluginOptions' => ['showMeter' => true, 'toggleMask' => true]]); ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Enter the password of the user.'), ['id' => 'hbPassword', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'new_password')->widget(PasswordInput::classname(), ['options' => ['aria-describedby' => 'hbNewPassword'], 'pluginOptions' => ['showMeter' => true, 'toggleMask' => true]]); ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Enter the password of the user (again).'), ['id' => 'hbNewPassword', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'can_access_settings')->dropDownList(User::getCanAccessSettingsData(), ['prompt' => '---', 'aria-describedby' => 'hbConfig']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Please tell us if the user can access the settings.'), ['id' => 'hbConfig', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'language')->dropDownList(User::getLanguageData(), ['prompt' => '---', 'aria-describedby' => 'hbLanguage']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Select the language of the user.'), ['id' => 'hbLanguage', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(User::getStatusData(), ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('user', 'Please tell us if the user is active or inactive.'), ['id' => 'hbStatus', 'class' => 'help-block']) ?>

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
