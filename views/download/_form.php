<?php
/**
 * Displays the create page to Download CRUD.
 *
 * @var $this View
 * @var $model Download
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Download;
use app\models\DownloadCategory;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="download-form">

    <?php $form = ActiveForm::begin([
            'id' => 'download-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome do arquivo.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(DownloadCategory::getDownloadCategories(), ['prompt' => '---', 'aria-describedby' => 'hbCategory']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a categoria do arquivo.', ['id' => 'hbCategory', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o endereço do arquivo.', ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(Download::getStatusData(), ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe se o arquivo está ativo ou inativo.', ['id' => 'hbStatus', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Criado em ' . Yii::$app->getFormatter()->asDatetime($model->date_created) . ' por ' . $model->getUserCreated()->getName() . '.', ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Última alteração em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated) . ' por ' . $model->getUserUpdated()->getName() . '.', ['class' => 'help-block']) ?>
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
