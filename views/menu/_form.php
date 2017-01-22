<?php
/**
 * Displays the create page to User CRUD.
 *
 * @var $this View
 * @var $model Menu
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Menu;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="menu-form">

    <?php $form = ActiveForm::begin([
            'id' => 'menu-form',
        ]
    ); ?>

    <?= $form->field($model, 'order')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbOrder']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('menu', 'Enter the order of the menu.'), ['id' => 'hbOrder', 'class' => 'help-block']) ?>

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
