<?php
/**
 * Displays the update page to Page CRUD.
 *
 * @var $this View
 * @var $model Page
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Page;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('page', 'Update page');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('page', 'Pages'),
        "icon" => Icon::show('clipboard'),
        "active" => false,
        "url" => Url::to(["page/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('pencil'),
        "active" => true,
        "url" => Url::to(["page/update", 'id' => $model->id])
    ]
];
?>
<div class="page-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
