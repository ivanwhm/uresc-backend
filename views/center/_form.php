<?php
/**
 * Displays the create page to Center CRUD.
 *
 * @var $this View
 * @var $model Center
 * @var $form ActiveForm
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
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome do centro espírita.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o endereço do centro espírita.', ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'neighborhood')->textInput(['maxlength' => true, 'aria-describedby' => 'hbNeighborhood']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o bairro do centro espírita.', ['id' => 'hbNeighborhood', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true, 'aria-describedby' => 'hbCity']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a cidade do centro espírita.', ['id' => 'hbCity', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'state')->textInput(['maxlength' => true, 'aria-describedby' => 'hbState']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a unidade federativa do centro espírita.', ['id' => 'hbState', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'phone')->widget(MaskedInput::className(), ['mask' => '(99) 9999-9999']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o telefone do centro espírita.', ['id' => 'hbPhone', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'aria-describedby' => 'hbEmail']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o email do centro espírita.', ['id' => 'hbEmail', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'business_hours')->textarea(['maxlength' => true, 'row' => 5, 'aria-describedby' => 'hbBusinessHours']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o horário de funcionamento do centro espírita.', ['id' => 'hbBusinessHours', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Criado em ' . Yii::$app->getFormatter()->asDatetime($model->date_created, 'short') . ' por ' . $model->getUserCreated()->getName() . '.', ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Última alteração em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated, 'short') . ' por ' . $model->getUserUpdated()->getName() . '.', ['class' => 'help-block']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', [
            'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a('Cancelar', $model->getIsNewRecord() ? ['index'] : ['view', 'id' => $model->id], [
            'class' => 'btn btn-danger',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
