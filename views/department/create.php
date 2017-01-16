<?php
/**
 * Displays the create page to Department CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Department
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('department', 'Add department');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('department', 'Departments'),
        "icon" => "fa-files-o",
        "active" => false,
        "url" => Url::to(["department/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-files-o",
        "active" => true
    ]
];

?>
<div class="department-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
