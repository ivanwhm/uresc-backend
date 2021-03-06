<?php
/**
 * Displays the create page to News CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model News
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\News;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('news', 'Add news');
$this->params['breadcrumbs'] = [
    [
        "label" => Yii::t('news', 'News'),
        "icon" => Icon::show('newspaper-o'),
        "active" => false,
        "url" => Url::to(["news/index"])
    ],
    [
        "label" => $this->title,
        "icon" => Icon::show('plus'),
        "active" => true
    ]
];

?>
<div class="news-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
