<?php
/**
 * Displays the update page to configuration info.
 *
 * @var $this View
 * @var $model Config
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Config;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = 'Configurações';
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-gear",
        "active" => true,
        "url" => Url::to(["site/config", 'id' => $model->id])
    ]
];
?>

<div class="config-update">

    <div class="config-form">

        <?php $form = ActiveForm::begin(['id' => 'config-form']); ?>

        <?= $form->field($model, 'page_title')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbPageTitle']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva o título da página principal.', ['id' => 'hbPageTitle', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phrase')->textInput(['maxlength' => true, 'aria-describedby' => 'hbPhrase']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva a frase a ser exibida no cabeçalho da página principal.', ['id' => 'hbPhrase', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phrase_author')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAuthorPhrase']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> Descreva o autor da frase a ser exibida no cabeçalho da página principal.', ['id' => 'hbAuthorPhrase', 'class' => 'help-block']) ?>

        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> Última alteração em ' . Yii::$app->getFormatter()->asDatetime($model->date_updated) . ' por ' . $model->getUserUpdated()->getName() . '.', ['class' => 'help-block']) ?>


        <div class="form-group">
            <?= Html::submitButton('Salvar', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
