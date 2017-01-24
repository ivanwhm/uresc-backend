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
use app\models\Menu;
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

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

    <?= GridView::widget([
        'id' => 'menu-grid',
        'dataProvider' => $dataProvider,
        'pjax' => true,
        'columns' => [
            'name',
            [
                'attribute' => 'type',
                'value' => function ($data) {
                    return $data->getType();
                },
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'order',
                'editableOptions' => [
                    'inputType' => Editable::INPUT_SPIN,
                    'options' => ['pluginOptions'=>['min' => 0, 'max' => 99]]
                ],
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'width' => '150px',
                'format' => ['integer'],
                'refreshGrid' => true
            ],
            [
                'class' => EditableColumn::className(),
                'attribute' => 'visible',
                'editableOptions' => [
                    'inputType' => Editable::INPUT_DROPDOWN_LIST,
                    'data' => Menu::getVisibleData(),
                    'displayValueConfig' => Menu::getVisibleData(),
                ],
                'hAlign' => 'left',
                'vAlign' => 'middle',
                'width' => '150px',
                'format' => ['text'],
                'refreshGrid' => true
            ],
        ],
    ]);
    ?>

</div>
