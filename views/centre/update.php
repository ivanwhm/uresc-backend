<?php
/**
 * Displays the update page to Centre CRUD.
 *
 * @var $this View
 * @var $model Centre
 * @var $mask string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Centre;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('centre', 'Update spiritist centre');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('centre', 'Spiritist centres'),
        "icon" => Icon::show('map-marker'),
        "active" => false,
        "url" => Url::to(["centre/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('pencil'),
        "active" => true,
        "url" => Url::to(["centre/update", 'id' => $model->id])
    ]
];
?>
<div class="centre-update">

    <?= $this->render('_form', [
        'model' => $model,
        'mask' => $mask
    ]) ?>

</div>
