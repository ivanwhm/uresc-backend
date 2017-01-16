<?php
/**
 * Displays the update page to Department CRUD.
 *
 * @var $this View
 * @var $model Department
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Department;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('department', 'Update department');
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
        "active" => true,
        "url" => Url::to(["department/update", 'id' => $model->id])
    ]
];
?>
<div class="department-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
