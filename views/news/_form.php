<?php
/**
 * Displays the create page to News CRUD.
 *
 * @var $this View
 * @var $model News
 * @var $form ActiveForm
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use kartik\icons\Icon;
use wadeshuler\ckeditor\widgets\CKEditor;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="news-form">

    <?php $form = ActiveForm::begin([
            'id' => 'news-form',
        ]
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbTitle']) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('news', 'Enter the title of the news.'), ['id' => 'hbTitle', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className()) ?>
    <?= Html::tag('span', Icon::show('info-circle') . Yii::t('news', 'Enter the text of the news.'), ['id' => 'hbName', 'class' => 'help-block']) ?>

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
