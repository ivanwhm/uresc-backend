<?php
/**
 * Displays the login page.
 *
 * @var $this View
 * @var $form ActiveForm
 * @var $model LoginForm;
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\LoginForm;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div class="col-md-4 col-md-offset-4">

    <div class="login-panel logo-panel">
        <?php
            if ($hasLogo && $logo != '')
            {
                echo Html::img($logo, ['alt' => 'logo']);
            }
        ?>
    </div>

    <div class="panel panel-default">

        <div class="panel-heading">
            <h3 class="panel-title"><?= Yii::t('login', 'Log In to Admin') ?></h3>
        </div>

        <div class="panel-body">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form'
            ]) ?>

            <fieldset>
                <?= $form->field($model, 'email')->textInput([
                    'autofocus' => true,
                    'class' => 'form-control',
                ]) ?>

                <?= $form->field($model, 'password')->passwordInput([
                    'class' => 'form-control'
                ]) ?>

                <?= Html::submitButton(Yii::t('login', 'Log In'), [
                    'class' => 'btn btn-lg btn-success btn-block',
                    'name' => 'login-button'
                ]) ?>

            </fieldset>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>