<?php
/**
 * This file is responsible to the default layout of this application.
 * This layout is based on SBAdmin template.
 *
 * @var $this View
 * @var $content string
 * @var $departments Department[]
 *
 * @author Ivan Wilhelm <ivan.whm@me.com>
 */

//Imports
use app\assets\SBAdmin\SBAdminAsset;
use app\models\Department;
use app\models\Page;
use app\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

//Register SBAdmin assets to this layout
SBAdminAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <?= Html::csrfMetaTags() ?>
    <?= Icon::map($this, Icon::FA); ?>
    <?= Icon::map($this, Icon::BSG); ?>
    <?= Icon::map($this, Icon::FI); ?>
    <title><?= Yii::t('general', 'Admin') ?> - <?= $this->title ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Url::to(["site/index"]) ?>"><?= Yii::t('general', 'Admin') ?></a>
        </div>

        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?= Icon::show(Yii::$app->getUser()->getIdentity()->getLanguageCountry(), [], Icon::FI) . ' ' . Icon::show('caret-down') ?>
                </a>
                <ul class="dropdown-menu">
                    <?php
                        $languages = User::getLanguageCountryData();
                        foreach (User::getLanguageData() as $key => $value)
                        {
                            echo Html::beginTag('li');
                            $text = Icon::show($languages[$key], [], Icon::FI) . $value;
                            echo Html::a($text, Url::to(['site/language', 'lang' => $key]));
                            echo Html::endTag('li');
                        }
                    ?>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?= Icon::show('user') . Yii::$app->getUser()->getIdentity()->getName()  . ' ' . Icon::show('caret-down') ?>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= Url::to(["site/password"]) ?>">
                            <?= Icon::show('key') . Yii::t('password', 'Change password') ?>
                        </a>
                    </li>
                    <?php if (Yii::$app->getUser()->getIdentity()->getIsCanAccessSettings()): ?>
                        <li>
                            <a href="<?= Url::to(["site/settings"]) ?>">
                                <?= Icon::show('gear') . Yii::t('settings', 'Settings') ?>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= Url::to(["site/logout"]) ?>">
                            <?= Icon::show('power-off') . Yii::t('general', 'Log Out') ?>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="<?= (Yii::$app->controller->id == "site") ? "active" : "" ?>">
                    <a href="<?= Url::to(["site/index"]) ?>">
                        <?= Icon::show('home') . Yii::t('general', 'Home') ?>
                    </a>
                </li>
                <li class="<?= ((Yii::$app->controller->id == "user") || ((Yii::$app->controller->id == "department") && (Yii::$app->controller->action->id !== "info")) || (Yii::$app->controller->id == "download-category") || (Yii::$app->controller->id == "gallery-category") || (Yii::$app->controller->id == "calendar") || ((Yii::$app->controller->id == "page") && (Yii::$app->controller->action->id !== "info")) ) ? "active" : "" ?>">
                    <a href="javascript:;" data-toggle="collapse" data-target="#records">
                        <?= Icon::show('edit') . Yii::t('general', 'Records') . ' ' . Icon::show('caret-down')?>
                    </a>
                    <ul id="records" class="collapse">
                        <li>
                            <a href="<?= Url::to(["calendar/index"]) ?>">
                                <?= Icon::show('calendar-o') . Yii::t('calendar', 'Calendars') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["download-category/index"]) ?>">
                                <?= Icon::show('file-archive-o') . Yii::t('download_category', 'Download\'s categories') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["gallery-category/index"]) ?>">
                                <?= Icon::show('file-picture-o') . Yii::t('gallery_category', 'Gallery\'s categories') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["department/index"]) ?>">
                                <?= Icon::show('files-o') . Yii::t('department', 'Departments') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["page/index"]) ?>">
                                <?= Icon::show('clipboard') . Yii::t('page', 'Pages') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["user/index"]) ?>">
                                <?= Icon::show('user') . ' ' . Yii::t('user', 'Users') ?>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?= (Yii::$app->controller->id == "download") ? "active" : "" ?>">
                    <a href="<?= Url::to(["download/index"]) ?>">
                        <?= Icon::show('archive') . Yii::t('download', 'Downloads') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "center") ? "active" : "" ?>">
                    <a href="<?= Url::to(["center/index"]) ?>">
                        <?= Icon::show('hospital-o') . Yii::t('center', 'Spiritist centers') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "contact") ? "active" : "" ?>">
                    <a href="<?= Url::to(["contact/index"]) ?>">
                        <?= Icon::show('mail-reply-all') . Yii::t('contact', 'Contacts') ?>
                    </a>
                </li>
                <?php  $departments = Department::getDepartments() ?>
                <?php if (count($departments) > 0) : ?>
                    <li class="<?= ((Yii::$app->controller->id == "department") && (Yii::$app->controller->action->id == "info")) ? "active" : "" ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#department">
                            <?= Icon::show('file-o') . Yii::t('department', 'Departments') . ' ' . Icon::show('caret-down')?>
                        </a>
                        <ul id="department" class="collapse">
                            <?php foreach ($departments as $department) : ?>
                                <li>
                                    <a href="<?= Url::to(["department/info", 'id' => $department->id]) ?>">
                                        <?= Icon::show('file-o') . $department->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="<?= (Yii::$app->controller->id == "event") ? "active" : "" ?>">
                    <a href="<?= Url::to(["event/index"]) ?>">
                        <?= Icon::show('calendar') . Yii::t('event', 'Events') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "gallery") ? "active" : "" ?>">
                    <a href="<?= Url::to(["gallery/index"]) ?>">
                        <?= Icon::show('picture-o') . Yii::t('gallery', 'Galleries') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "news") ? "active" : "" ?>">
                    <a href="<?= Url::to(["news/index"]) ?>">
                        <?= Icon::show('newspaper-o') . Yii::t('news', 'News') ?>
                    </a>
                </li>
                <?php  $pages = Page::getPages() ?>
                <?php if (count($pages) > 0) : ?>
                    <li class="<?= ((Yii::$app->controller->id == "page") && (Yii::$app->controller->action->id == "info")) ? "active" : "" ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#page">
                            <?= Icon::show('clipboard') . Yii::t('page', 'Pages') . ' ' . Icon::show('caret-down') ?>
                        </a>
                        <ul id="page" class="collapse">
                            <?php foreach ($pages as $page) : ?>
                                <li>
                                    <a href="<?= Url::to(["page/info", 'id' => $page->id]) ?>">
                                        <?= Icon::show('clipboard') . $page->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="<?= (Yii::$app->controller->id == "menu") ? "active" : "" ?>">
                    <a href="<?= Url::to(["menu/index"]) ?>">
                        <?= Icon::show('bars') . Yii::t('menu', 'Menus') ?>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        <?= $this->title ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <?= Icon::show('home') ?> <a href="<?= Url::to(["site/index"]) ?>"><?= Yii::t('general', 'Home') ?></a>
                        </li>

                        <?php
                        $breadcrumbs = isset($this->params["breadcrumbs"]) ? $this->params["breadcrumbs"] : [];
                        foreach ($breadcrumbs as $breadcrumb) :
                            $active = (isset($breadcrumb["active"]) && $breadcrumb["active"]) ? "active" : "";
                            $label = isset($breadcrumb["label"]) ? $breadcrumb["label"] : "";
                            $icon = isset($breadcrumb["icon"]) ? $breadcrumb["icon"] : "";
                            $url = isset($breadcrumb["url"]) ? $breadcrumb["url"] : "";
                            ?>
                            <li class="<?= $active ?>">
                                <?= $icon ?>
                                <?php if ($url != "") : ?>
                                <a href="<?= $url ?>">
                                    <?php endif; ?>
                                    <?= $label ?>
                                    <?php if ($url != "") : ?>
                                </a>
                            <?php endif; ?>
                            </li>
                        <?php endforeach; ?>

                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <?= $content ?>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
<?php $this->beginPage() ?>
