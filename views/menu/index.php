<?php
/**
 * Displays the index page to Menu CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Menu;
use kartik\editable\Editable;
use kartik\grid\EditableColumn;
use kartik\grid\GridView;
use kartik\icons\Icon;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = Yii::t('menu', 'Menus');
$this->params['breadcrumbs'] = [
    [
        "label" => $this->title,
        "icon" => Icon::show('bars'),
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
            [
                'attribute' => 'icon',
                'format' => 'html',
                'hAlign' => GridView::ALIGN_CENTER,
                'width' => '60px',
                'value' => function(Menu $data) {
                    return (($data->icon == '' ? Icon::show('bars') : Icon::show($data->icon, [], $data->icon_library)));
                }
            ],
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function (Menu $data) {
                    return ($data->type == Menu::TYPE_PAGE) ? Html::a($data->getPage()->name, $data->getPage()->getLink()) : $data->name;
                },
            ],
            [
                'attribute' => 'type',
                'value' => function (Menu $data) {
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
