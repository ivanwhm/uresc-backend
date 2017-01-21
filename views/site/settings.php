<?php
/**
 * Displays the update page to configuration info.
 *
 * @var $this View
 * @var $model Settings
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Settings;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('settings', 'Settings');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-gear",
        "active" => true,
        "url" => Url::to(["site/settings", 'id' => $model->id])
    ]
];
?>

<div class="settings-update">

    <div class="settings-form">

        <?php $form = ActiveForm::begin(['id' => 'settings-form']); ?>

        <?= $form->field($model, 'page_title')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbPageTitle']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('config', 'Enter the main page title.'), ['id' => 'hbPageTitle', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phrase')->textInput(['maxlength' => true, 'aria-describedby' => 'hbPhrase']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('config', 'Enter the main phrase.'), ['id' => 'hbPhrase', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phrase_author')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAuthorPhrase']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('config', 'Enter the main phrase author.'), ['id' => 'hbAuthorPhrase', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phone_mask')->textInput(['maxlength' => true, 'aria-describedby' => 'hbSettings']) ?>
        <?= Html::tag('span', '<i class="fa fa-fw fa-question"></i> ' . Yii::t('settings', 'Enter the mask to the phone\'s field.'), ['id' => 'hbSettings', 'class' => 'help-block']) ?>

        <?= Html::tag('span', '<i class="fa fa-fw fa-user"></i> ' . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('general', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>