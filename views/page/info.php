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
use wadeshuler\ckeditor\widgets\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Página: ' . $model->name;
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-clipboard",
        "active" => true,
        "url" => Url::to(["page/info", 'id' => $model->id])
    ]
];
?>

<div class="page-update">

    <div class="page-form">

        <?php $form = ActiveForm::begin(['id' => 'page-form']); ?>

        <?= $form->field($model, 'text')->widget(CKEditor::className()) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva o texto relacionado a página.', ['id' => 'hbName', 'class' => 'help-block']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
