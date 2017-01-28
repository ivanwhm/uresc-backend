<?php
/**
 * Displays the create page to Center CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Center
 * @var $mask string
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Center;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('center', 'Add spiritist center');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('center', 'Spiritist centers'),
        "icon" => Icon::show('hospital-o'),
        "active" => false,
        "url" => Url::to(["center/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="center-create">

    <?= $this->render('_form', [
        'model' => $model,
        'mask' => $mask
    ]) ?>

</div>
