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

$this->title = 'Alterar senha';
$this->params['breadcrumbs'] = array(
    array(
        "label" => "Alterar senha",
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
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a sua senha atual.', ['id' => 'hbOldPassword', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbNewPassword']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a nova senha.', ['id' => 'hbNewPassword', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'repeatNewPassword')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbRepeatNewPassword']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Repita a senha do usuário que irá acessar o sistema.', ['id' => 'hbRepeatNewPassword', 'class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton('Alterar senha', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-danger']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

