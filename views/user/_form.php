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
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Enter the name of the user.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'aria-describedby' => 'hbEmail']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Enter the e-mail of the user.'), ['id' => 'hbEmail', 'class' => 'help-block']) ?>

    <?php if ($model->getIsNewRecord()) : ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'aria-describedby' => 'hbUsername']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Enter the username of the user.'), ['id' => 'hbUsername', 'class' => 'help-block']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbPassword']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Enter the password of the user.'), ['id' => 'hbPassword', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbNewPassword']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Enter the password of the user (again).'), ['id' => 'hbNewPassword', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'can_config')->dropDownList(User::getCanConfigData(), ['prompt' => '---', 'aria-describedby' => 'hbConfig']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Please tell us if the user can access the settings.'), ['id' => 'hbConfig', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(User::getStatusData(), ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('user', 'Please tell us if the user is active or inactive.'), ['id' => 'hbStatus', 'class' => 'help-block']) ?>

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
