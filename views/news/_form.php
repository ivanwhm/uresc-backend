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
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Informe o título da notícia.', ['id' => 'hbTitle', 'class' => 'help-block']) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className()) ?>
    <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva o texto da notícia.', ['id' => 'hbName', 'class' => 'help-block']) ?>

    <?php if (!$model->getIsNewRecord()) : ?>
        <?= Html::tag('br') ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printCreatedInformation(), ['class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('general', 'Save'), [
            'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
        ]) ?>
        <?= Html::a(Yii::t('general', 'Cancel'), $model->getIsNewRecord() ? ['index'] : ['view', 'id' => $model->id], [
            'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
