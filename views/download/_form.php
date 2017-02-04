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
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="download-form">

    <?php $form = ActiveForm::begin([
            'id' => 'download-form',
        ]
    ); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbName']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('download', 'Enter the name of the download.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'category_id')->widget(Select2::classname(), ['data' => DownloadCategory::getDownloadCategories(), 'options' => ['prompt' => '---', 'aria-describedby' => 'hbCategory']]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('download', 'Enter the category of the download.'), ['id' => 'hbCategory', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAddress']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('download', 'Enter the address of the download.'), ['id' => 'hbAddress', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'file')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('download', 'Select cover file to upload.'), ['id' => 'hbFile', 'class' => 'help-block']) ?>

    <?php
    if ($model->cover_filename != '')
    {
        echo Html::tag('br');
        echo Html::img(Url::to(['download/image', 'id' => $model->id]));
        echo Html::tag('br') . Html::tag('br');
    }
    ?>

    <?= $form->field($model, 'status')->widget(Select2::classname(), ['data' => Download::getStatusData(), 'options' => ['prompt' => '---', 'aria-describedby' => 'hbStatus']]) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('download', 'Please tell us if the download is active or inactive.'), ['id' => 'hbStatus', 'class' => 'help-block']) ?>

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
