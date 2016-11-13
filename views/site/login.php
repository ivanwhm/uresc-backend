<?php
/**
 * Displays the login page.
 *
 * @var $this View
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
        <img src="/images/logo.png" alt="Logo 4ª URE">
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">4ª URE - Entrada</h3>
        </div>
        <div class="panel-body">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form'
            ]) ?>

            <fieldset>
                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder' => $model->getAttributeLabel('username'),
                    'class' => 'form-control',
                ])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => $model->getAttributeLabel('password'),
                    'class' => 'form-control'
                ])->label(false) ?>

                <div class="checkbox">
                    <label>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </label>
                </div>

                <?= Html::submitButton('Entrar', [
                    'class' => 'btn btn-lg btn-success btn-block',
                    'name' => 'login-button'
                ]) ?>

            </fieldset>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>