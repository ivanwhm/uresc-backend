<?php
/**
 * Displays the change password page to User CRUD.
 *
 * @var $this View
 * @var $model ChangePasswordForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use kartik\icons\Icon;
use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\ChangePasswordForm;
use yii\widgets\ActiveForm;

$this->title = Yii::t('password', 'Change password');
$this->params['breadcrumbs'] = array(
    array(
        "label" => Yii::t('password', 'Change password'),
        "icon" => Icon::show('key'),
        "active" => false,
        "url" => Url::to(array("site/password"))
    )
);

?>

<div class="change-password">

    <div class="change-password-form">

        <?php $form = ActiveForm::begin([
                'id' => 'change-password-form',
            ]
        ); ?>

        <?= $form->field($model, 'oldPassword')->widget(PasswordInput::classname(), ['options' => ['autofocus' => true, 'aria-describedby' => 'hbOldPassword'], 'pluginOptions' => ['showMeter' => false, 'toggleMask' => true]]); ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('password', 'Enter the old password.'), ['id' => 'hbOldPassword', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'newPassword')->widget(PasswordInput::classname(), ['options' => ['aria-describedby' => 'hbNewPassword'], 'pluginOptions' => ['showMeter' => true, 'toggleMask' => true]]); ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('password', 'Enter the new password.'), ['id' => 'hbNewPassword', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'repeatNewPassword')->widget(PasswordInput::classname(), ['options' => ['aria-describedby' => 'hbRepeatNewPassword'], 'pluginOptions' => ['showMeter' => true, 'toggleMask' => true]]); ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('password', 'Enter the new password (again).'), ['id' => 'hbRepeatNewPassword', 'class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton(Icon::show('pencil') . Yii::t('password', 'Change password'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Icon::show('ban') . Yii::t('general', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

