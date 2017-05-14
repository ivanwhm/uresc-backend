<?php
/**
 * Displays the create page to Centre CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Centre
 * @var $mask string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Centre;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('centre', 'Add spiritist centre');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('centre', 'Spiritist centres'),
        "icon" => Icon::show('map-marker'),
        "active" => false,
        "url" => Url::to(["centre/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="centre-create">

    <?= $this->render('_form', [
        'model' => $model,
        'mask' => $mask
    ]) ?>

</div>
