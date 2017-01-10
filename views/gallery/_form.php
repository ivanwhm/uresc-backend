<?php
/**
 * Displays the create page to Gallery CRUD.
 *
 * @var $this View
 * @var $model Gallery
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Gallery;
use app\models\GalleryCategory;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin([
            'id' => 'gallery-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o nome do arquivo da galeria.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(GalleryCategory::getGalleryCategories(), ['prompt' => '---', 'aria-describedby' => 'hbCategory']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe a categoria do arquivo da galeria.', ['id' => 'hbCategory', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o endereço do arquivo da galeria.', ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(Gallery::getStatusData(), ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe se o arquivo da galeria está ativo ou inativo.', ['id' => 'hbStatus', 'class' => 'help-block']) ?>

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
