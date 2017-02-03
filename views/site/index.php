<?php
/**
 * This file is responsible to show index default page.
 *
 * @var $this View
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use kartik\icons\Icon;
use yii\helpers\Url;

$this->title = Yii::t('general', 'Home');

?>
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <?= Icon::show('mail-reply-all', ['class' => 'fa-5x']) ?>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $contacts ?></div>
                        <div><?= Yii::t('contact', 'Unanswered<br>contacts') ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= Url::toRoute(['contact/index']) ?>">
                <div class="panel-footer">
                    <span class="pull-left"><?= Yii::t('contact', 'View contacts!') ?></span>
                    <span class="pull-right"><?= Icon::show('arrow-circle-right') ?></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <?= Icon::show('calendar', ['class' => 'fa-5x']) ?>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $events ?></div>
                        <div><?= Yii::t('event', 'Future<br>events') ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= Url::toRoute(['event/index']) ?>">
                <div class="panel-footer">
                    <span class="pull-left"><?= Yii::t('event', 'View events!') ?></span>
                    <span class="pull-right"><?= Icon::show('arrow-circle-right') ?></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <?= Icon::show('hospital-o', ['class' => 'fa-5x']) ?>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $centres ?></div>
                        <div><?= Yii::t('centre', 'Registered<br>spiritist centres') ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= Url::toRoute(['center/index']) ?>">
                <div class="panel-footer">
                    <span class="pull-left"><?= Yii::t('centre', 'View centres!') ?></span>
                    <span class="pull-right"><?= Icon::show('arrow-circle-right') ?></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <?= Icon::show('newspaper-o', ['class' => 'fa-5x']) ?>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $news ?></div>
                        <div><?= Yii::t('news', 'Unpublished<br>news') ?></div>
                    </div>
                </div>
            </div>
            <a href="<?= Url::toRoute(['news/index']) ?>">
                <div class="panel-footer">
                    <span class="pull-left"><?= Yii::t('news', 'View news!') ?></span>
                    <span class="pull-right"><?= Icon::show('arrow-circle-right') ?></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
