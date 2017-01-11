<?php
/**
 * This file is responsible to login layout of this application.
 * This layout is based on SBAdmin template.
 *
 * @var $this View
 * @var $content string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\assets\SBAdmin2\SBAdmin2Asset;
use yii\helpers\Html;
use yii\web\View;

//Register SBAdmin2 assets to this layout
SBAdmin2Asset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->name ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="container">
    <div class="row">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
<?php $this->beginPage() ?>
