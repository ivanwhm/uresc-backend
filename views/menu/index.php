<?php
/**
 * Displays the index page to Menu CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $data Menu
 * @var $model Menu
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use dixonstarter\togglecolumn\ToggleColumn;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\View;
use app\models\Menu;
use yii\widgets\Pjax;

$this->title = Yii::t('menu', 'Menus');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => "fa-bars",
        "active" => true,
        "url" => Url::to(["menu/index"])
    ]
];
?>
<div class="news-index">

    <?php Pjax::begin();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            [
                'attribute' => 'type',
                'value' => function ($data) {
                    return $data->getType();
                },
            ],
            [
                'class' => ToggleColumn::className(),
                'attribute' => 'visible',
                'options' => ['style'=>'width:80px;'],
                'linkTemplateOn' => '<a class="toggle-column btn btn-primary btn-xs btn-block" data-pjax="0" href="{url}"><i  class="glyphicon glyphicon-ok"></i> {label}</a>',
                'linkTemplateOff' => '<a class="toggle-column btn btn-danger btn-xs btn-block" data-pjax="0" href="{url}"><i  class="glyphicon glyphicon-remove"></i> {label}</a>'
            ]
        ],
    ]);
    ?>
    <?php Pjax::end();?>

</div>
