<?php
/**
 * Displays the update page to News CRUD.
 *
 * @var $this View
 * @var $model News
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use kartik\icons\Icon;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('news', 'Update news');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('news', 'News'),
        "icon" => Icon::show('newspaper-o'),
        "active" => false,
        "url" => Url::to(["news/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('pencil'),
        "active" => true,
        "url" => Url::to(["news/update", 'id' => $model->id])
    ]
];
?>
<div class="news-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
