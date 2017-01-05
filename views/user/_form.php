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
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome completo do usuário que irá acessar o sistema.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'aria-describedby' => 'hbEmail']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o endereço de e-mail do usuário que irá acessar o sistema.', ['id' => 'hbEmail', 'class' => 'help-block']) ?>

    <?php if ($model->getIsNewRecord()) : ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'aria-describedby' => 'hbUsername']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o identificador do usuário que irá acessar o sistema. De preferência utilize apenas uma palavra.', ['id' => 'hbUsername', 'class' => 'help-block']) ?>
    <?php endif; ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbPassword']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a senha do usuário que irá acessar o sistema.', ['id' => 'hbPassword', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true, 'aria-describedby' => 'hbNewPassword']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Repita a senha do usuário que irá acessar o sistema.', ['id' => 'hbNewPassword', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'can_config')->dropDownList(User::$configData, ['prompt' => '---', 'aria-describedby' => 'hbConfig']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe se o usuário pode acessar as configurações do sistema.', ['id' => 'hbConfig', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(User::$statusData, ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe se o usuário está ativo ou inativo para acessar o sistema.', ['id' => 'hbStatus', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Criado em ' . Yii::$app->getFormatter()->asDatetime($model->date_created, 'short') . ' por ' . $model->getUserCreated()->getName() . '.', ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Última alteração em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated, 'short') . ' por ' . $model->getUserUpdated()->getName() . '.', ['class' => 'help-block']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Alterar', [
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a('Cancelar', $model->getIsNewRecord() ? ['index'] : ['view', 'id' => $model->id], [
            'class' => 'btn btn-danger',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
