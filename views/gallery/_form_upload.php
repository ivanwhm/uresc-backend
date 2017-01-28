<?php
/**
 * Displays the upload page to Gallery CRUD.
 *
 * @var $this View
 * @var $model Gallery
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Gallery;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="gallery-upload-form">

    <?php $form = ActiveForm::begin([
            'id' => 'gallery-upload-form',
            'options' => [
                    'enctype' => 'multipart/form-data'
            ]
        ]
    ); ?>

    <?= $form->field($model, 'files[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('gallery', 'Select all the files to upload.'), ['id' => 'hbFiles', 'class' => 'help-block']) ?>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('upload') . Yii::t('general', 'Save'), [
            'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a(Icon::show('ban') . Yii::t('general', 'Cancel'), $model->getIsNewRecord() ? ['index'] : ['view', 'id' => $model->id], [
            'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
