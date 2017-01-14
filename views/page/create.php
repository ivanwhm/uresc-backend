<?php
/**
 * Displays the create page to Page CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Page
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('page', 'Add page');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('page', 'Pages'),
        "icon" => "fa-clipboard",
        "active" => false,
        "url" => Url::to(["page/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-clipboard",
        "active" => true
    ]
];

?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
