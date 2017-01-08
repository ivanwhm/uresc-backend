<?php
/**
 * Displays the create page to Center CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Center
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Center;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Adicionar centro espírita';
$this->params['breadcrumbs'] = [
    [
        "label" => "Centros espíritas",
        "icon" => "fa-hospital-o",
        "active" => false,
        "url" => Url::to(["center/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-hospital-o",
        "active" => true
    ]
];

?>
<div class="center-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
