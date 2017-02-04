<?php
/**
 * Displays the create page to GalleryFiles CRUD.
 *
 * @var $this View
 * @var $model GalleryFiles
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\GalleryFiles;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="gallery-link-form">

    <?php $form = ActiveForm::begin([
            'id' => 'gallery-link-form',
        ]
    ); ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('gallery', 'Enter the address of the download.'), ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'file')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('gallery', 'Select cover file to upload.'), ['id' => 'hbFile', 'class' => 'help-block']) ?>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('download') . Yii::t('general', 'Save'), [
            'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a(Icon::show('ban') . Yii::t('general', 'Cancel'), ['view', 'id' => $model->gallery_id], [
            'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
