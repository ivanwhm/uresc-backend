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
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Alterar página';
$this->params['breadcrumbs'] = [
    [
        "label" => "Páginas",
        "icon" => "fa-clipboard",
        "active" => false,
        "url" => Url::to(["page/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-clipboard",
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
