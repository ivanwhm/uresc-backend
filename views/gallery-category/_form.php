<?php
/**
 * Displays the create page to Gallery Category CRUD.
 *
 * @var $this View
 * @var $model GalleryCategory
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryCategory;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="gallery-category-form">

    <?php $form = ActiveForm::begin([
            'id' => 'gallery-category-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome da categoria de galeria.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(GalleryCategory::$statusData, ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe se a categoria de galeria está ativa ou inativa.', ['id' => 'hbStatus', 'class' => 'help-block']) ?>

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
