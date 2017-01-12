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
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\ChangePasswordForm;
use yii\widgets\ActiveForm;

$this->title = Yii::t('password', 'Change password');
$this->params['breadcrumbs'] = array(
    array(
        "label" => Yii::t('password', 'Change password'),
        "icon" => "fa-key",
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

        <?= $form->field($model, 'oldPassword')->passwordInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbOldPassword']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('password', 'Enter the old password.'), ['id' => 'hbOldPassword', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbNewPassword']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('password', 'Enter the new password.'), ['id' => 'hbNewPassword', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'repeatNewPassword')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbRepeatNewPassword']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('password', 'Enter the new password (again).'), ['id' => 'hbRepeatNewPassword', 'class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('password', 'Change password'), ['class' => 'btn btn-success']) ?>
            <?= Html::a(Yii::t('general', 'Cancel'), ['index'], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

