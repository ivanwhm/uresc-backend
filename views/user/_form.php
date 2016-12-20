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
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\widgets\Pjax;

?>

<div class="user-form">

    <?php Pjax::begin(); ?>

    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if ($model->getIsNewRecord()) : ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'new_password')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList(User::$statusData, ['prompt' => '---']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::label('Criado em ' . Yii::$app->getFormatter()->asDatetime($model->date_created, 'long') . ' por ' . $model->getUserCreated()->getName() . '.') . Html::tag('br') ?>
        <?= Html::label('Alterado em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated, 'long') . ' por ' . $model->getUserUpdated()->getName() . '.') ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php Pjax::end(); ?>

</div>
