<?php
/**
 * Displays the update page to department info.
 *
 * @var $this View
 * @var $model Department
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Department;
use kartik\icons\Icon;
use wadeshuler\ckeditor\widgets\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('department', 'Department: {name}',[
        'name' => $model->name
]);
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('file-text-o'),
        "active" => true,
        "url" => Url::to(["department/info", 'id' => $model->id])
    ]
];
?>

<div class="department-update">

    <div class="department-form">

        <?php $form = ActiveForm::begin(['id' => 'department-form']); ?>

        <?= $form->field($model, 'info')->widget(CKEditor::className()) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('department', 'Enter the text of the department.'), ['id' => 'hbName', 'class' => 'help-block']) ?>
        <?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton(Icon::show('download') . Yii::t('general', 'Save'), [
                'class' => $model->getIsNewRecord() ? 'btn btn-success' : 'btn btn-primary'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
