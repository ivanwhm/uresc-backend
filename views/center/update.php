<?php
/**
 * Displays the update page to Center CRUD.
 *
 * @var $this View
 * @var $model Center
 * @var $mask string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Center;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('center', 'Update spiritist center');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('center', 'Spiritist centers'),
        "icon" => "fa-hospital-o",
        "active" => false,
        "url" => Url::to(["center/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-hospital-o",
        "active" => true,
        "url" => Url::to(["center/update", 'id' => $model->id])
    ]
];
?>
<div class="center-update">

    <?= $this->render('_form', [
        'model' => $model,
        'mask' => $mask
    ]) ?>

</div>
