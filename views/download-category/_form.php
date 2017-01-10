<?php
/**
 * Displays the create page to Download Category CRUD.
 *
 * @var $this View
 * @var $model DownloadCategory
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\DownloadCategory;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="download-category-form">

    <?php $form = ActiveForm::begin([
            'id' => 'download-category-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome da categoria de arquivo.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(DownloadCategory::getStatusData(), ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe se a categoria de arquivo está ativa ou inativa.', ['id' => 'hbStatus', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
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
