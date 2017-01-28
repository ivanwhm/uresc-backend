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
use kartik\icons\Icon;
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
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('gallery', 'Enter the name of the gallery.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'category_id')->dropDownList(GalleryCategory::getGalleryCategories(), ['prompt' => '---', 'aria-describedby' => 'hbCategory']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('gallery', 'Enter the category of the gallery.'), ['id' => 'hbCategory', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'status')->dropDownList(Gallery::getStatusData(), ['prompt' => '---', 'aria-describedby' => 'hbStatus']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('gallery', 'Please tell us if the gallery is active or inactive.'), ['id' => 'hbStatus', 'class' => 'help-block']) ?>

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
