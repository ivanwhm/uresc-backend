<?php
/**
 * Displays the update page to configuration info.
 *
 * @var $this View
 * @var $model Settings
 * @var $hasLogo boolean
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Settings;
use kartik\icons\Icon;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->title = Yii::t('settings', 'Settings');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('gear'),
        "active" => true,
        "url" => Url::to(["site/settings", 'id' => $model->id])
    ]
];
?>

<div class="settings-update">

    <div class="settings-form">

        <?php $form = ActiveForm::begin(['id' => 'settings-form']); ?>

        <?= $form->field($model, 'page_title')->textInput(['maxlength' => true, 'autofocus' => true, 'aria-describedby' => 'hbPageTitle']) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Enter the main page title.'), ['id' => 'hbPageTitle', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phrase')->textInput(['maxlength' => true, 'aria-describedby' => 'hbPhrase']) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Enter the main phrase.'), ['id' => 'hbPhrase', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phrase_author')->textInput(['maxlength' => true, 'aria-describedby' => 'hbAuthorPhrase']) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Enter the main phrase author.'), ['id' => 'hbAuthorPhrase', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'language')->widget(Select2::classname(), ['data' => Settings::getLanguageData(), 'options' => ['prompt' => '---', 'aria-describedby' => 'hbLanguage']]) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Main page language'), ['id' => 'hbLanguage', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'phone_mask')->textInput(['maxlength' => true, 'aria-describedby' => 'hbSettings']) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Enter the mask to the phone\'s field.'), ['id' => 'hbSettings', 'class' => 'help-block']) ?>

        <?= $form->field($model, 'logo')->fileInput(['multiple' => false, 'accept' => 'image/*']) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Select logo file to upload.'), ['id' => 'hbLogo', 'class' => 'help-block']) ?>

        <?php
            if ($hasLogo && $model->login_logo_image != '')
            {
                echo Html::tag('br');
                echo Html::img($model->login_logo_image);
                echo Html::tag('br') . Html::tag('br');
            }
        ?>

        <?= $form->field($model, 'default_business_hours')->textarea(['maxlength' => true, 'rows' => 5, 'aria-describedby' => 'hbDefaultBusinessHours']) ?>
        <?= Html::tag('span', Icon::show('info-circle') . Yii::t('settings', 'Enter the default business hours to a new spiritist centre record.'), ['id' => 'hbDefaultBusinessHours', 'class' => 'help-block']) ?>

        <?= Html::tag('span', Icon::show('user') . $model->printLastUpdatedInformation(), ['class' => 'help-block']) ?>

        <div class="form-group">
            <?= Html::submitButton(Icon::show('download') . Yii::t('general', 'Save'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
