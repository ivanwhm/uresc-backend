<?php
/**
 * Displays the update page to department info.
 *
 * @var $this View
 * @var $model User
 * @var $model Department
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Department;
use app\models\User;
use wadeshuler\ckeditor\widgets\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Departamento: ' . $model->name;
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-file-o",
        "active" => true,
        "url" => Url::to(["department/info", 'id' => $model->id])
    ]
];
?>

<div class="department-update">

    <div class="department-form">

        <?php $form = ActiveForm::begin(['id' => 'department-form']); ?>

        <?= $form->field($model, 'info')->widget(CKEditor::className()) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva o texto relacionado ao departamento.', ['id' => 'hbName', 'class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Última alteração em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated, 'long') . ' por ' . $model->getUserUpdated()->getName() . '.', ['class' => 'help-block']) ?>


        <div class="form-group">
            <?= Html::submitButton('Atualizar', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
