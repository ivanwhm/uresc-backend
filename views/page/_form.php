<?php
/**
 * Displays the create page to Page CRUD.
 *
 * @var $this View
 * @var $model Page
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Page;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="page-form">

    <?php $form = ActiveForm::begin([
            'id' => 'page-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('page', 'Enter the name of the page.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true, 'aria-describedby' => 'hbIcon']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('page', 'Enter the icon description based on font-awesome library of the page.'), ['id' => 'hbIcon', 'class' => 'help-block']) ?>

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
