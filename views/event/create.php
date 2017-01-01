<?php
/**
 * Displays the create page to Event CRUD.
 *
 * @var $this View
 * @var $dataProvider ActiveDataProvider
 * @var $model Event
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\models\Event;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Criar evento';
$this->params['breadcrumbs'] = [
    [
        "label" => "Eventos",
        "icon" => "fa-calendar",
        "active" => false,
        "url" => Url::to(["event/index"])
    ],
    [
        "label" => $this->title,
        "icon" => "fa-calendar",
        "active" => true
    ]
];

?>
<div class="event-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
