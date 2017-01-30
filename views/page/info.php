<?php
/**
 * Displays the update page to Page info.
 *
 * @var $this View
 * @var $model Page
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Page;
use kartik\icons\Icon;
use wadeshuler\ckeditor\widgets\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('page', 'Page: {name}', ['name' => $model->name]);
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => (($model->icon == ''?Icon::show('clipboard'):Icon::show($model->icon))),
        "active" => true,
        "url" => Url::to(["page/info", 'id' => $model->id])
    ]
];
?>

<div class="page-update">

    <div class="page-form">

        <?php $form = ActiveForm::begin(['id' => 'page-form']); ?>

        <?= $form->field($model, 'text')->widget(CKEditor::className()) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('page', 'Enter the related text of the page.'), ['id' => 'hbName', 'class' => 'help-block']) ?>
        <?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton(Icon::show('download') . Yii::t('general', 'Save'), [
                'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
