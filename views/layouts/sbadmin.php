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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-fw fa-user"></i> <?= Yii::$app->getUser()->getIdentity()->getName() ?> <b
                            class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= Url::to(["site/password"]) ?>"><i class="fa fa-fw fa-key"></i> <?= Yii::t('password', 'Change password') ?></a>
                    </li>
                    <?php if (Yii::$app->getUser()->getIdentity()->getIsCanAccessSettings()): ?>
                        <li>
                            <a href="<?= Url::to(["site/settings"]) ?>"><i class="fa fa-fw fa-gear"></i> <?= Yii::t('settings', 'Settings') ?></a>
                        </li>
                    <?php endif; ?>
                    <li class="divider"></li>
                    <li>
                        <a href="<?= Url::to(["site/logout"]) ?>"><i class="fa fa-fw fa-power-off"></i> <?= Yii::t('general', 'Log Out') ?></a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="<?= (Yii::$app->controller->id == "site") ? "active" : "" ?>">
                    <a href="<?= Url::to(["site/index"]) ?>">
                        <i class="fa fa-fw fa-home"></i> <?= Yii::t('general', 'Home') ?>
                    </a>
                </li>
                <li class="<?= ((Yii::$app->controller->id == "user") || ((Yii::$app->controller->id == "department") && (Yii::$app->controller->action->id !== "info")) || (Yii::$app->controller->id == "download-category") || (Yii::$app->controller->id == "gallery-category") || (Yii::$app->controller->id == "calendar") || ((Yii::$app->controller->id == "page") && (Yii::$app->controller->action->id !== "info")) ) ? "active" : "" ?>">
                    <a href="javascript:;" data-toggle="collapse" data-target="#records">
                        <i class="fa fa-fw fa-pencil-square-o"></i> <?= Yii::t('general', 'Records') ?> <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="records" class="collapse">
                        <li>
                            <a href="<?= Url::to(["calendar/index"]) ?>"><i class="fa fa-fw fa-calendar-o"></i> <?= Yii::t('calendar', 'Calendars') ?></a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["download-category/index"]) ?>"><i class="fa fa-fw fa-file-archive-o"></i> <?= Yii::t('download_category', 'Download\'s categories') ?></a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["gallery-category/index"]) ?>"><i class="fa fa-fw fa-file-picture-o"></i> <?= Yii::t('gallery_category', 'Gallery\'s categories') ?></a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["department/index"]) ?>"><i class="fa fa-fw fa-files-o"></i> <?= Yii::t('department', 'Departments') ?></a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["page/index"]) ?>"><i class="fa fa-fw fa-clipboard"></i> <?= Yii::t('page', 'Pages') ?></a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["user/index"]) ?>"><i class="fa fa-fw fa-user"></i> <?= Yii::t('user', 'Users') ?></a>
                        </li>
                    </ul>
                </li>
                <li class="<?= (Yii::$app->controller->id == "download") ? "active" : "" ?>">
                    <a href="<?= Url::to(["download/index"]) ?>">
                        <i class="fa fa-fw fa-archive"></i> <?= Yii::t('download', 'Downloads') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "center") ? "active" : "" ?>">
                    <a href="<?= Url::to(["center/index"]) ?>">
                        <i class="fa fa-fw fa-hospital-o"></i> <?= Yii::t('center', 'Spiritist centers') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "contact") ? "active" : "" ?>">
                    <a href="<?= Url::to(["contact/index"]) ?>">
                        <i class="fa fa-fw fa-mail-reply-all"></i> <?= Yii::t('contact', 'Contacts') ?>
                    </a>
                </li>
                <?php  $departments = Department::getDepartments() ?>
                <?php if (count($departments) > 0) : ?>
                    <li class="<?= ((Yii::$app->controller->id == "department") && (Yii::$app->controller->action->id == "info")) ? "active" : "" ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#department">
                            <i class="fa fa-fw fa-file-o"></i> <?= Yii::t('department', 'Departments') ?> <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="department" class="collapse">
                            <?php foreach ($departments as $department) : ?>
                                <li>
                                    <a href="<?= Url::to(["department/info", 'id' => $department->id]) ?>">
                                        <i class="fa fa-fw fa-file-o"></i> <?= $department->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="<?= (Yii::$app->controller->id == "event") ? "active" : "" ?>">
                    <a href="<?= Url::to(["event/index"]) ?>">
                        <i class="fa fa-fw fa-calendar"></i> <?= Yii::t('event', 'Events') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "gallery") ? "active" : "" ?>">
                    <a href="<?= Url::to(["gallery/index"]) ?>">
                        <i class="fa fa-fw fa-picture-o"></i> <?= Yii::t('gallery', 'Galleries') ?>
                    </a>
                </li>
                <li class="<?= (Yii::$app->controller->id == "news") ? "active" : "" ?>">
                    <a href="<?= Url::to(["news/index"]) ?>">
                        <i class="fa fa-fw fa-newspaper-o"></i> <?= Yii::t('news', 'News') ?>
                    </a>
                </li>
                <?php  $pages = Page::getPages() ?>
                <?php if (count($pages) > 0) : ?>
                    <li class="<?= ((Yii::$app->controller->id == "page") && (Yii::$app->controller->action->id == "info")) ? "active" : "" ?>">
                        <a href="javascript:;" data-toggle="collapse" data-target="#page">
                            <i class="fa fa-fw fa-clipboard"></i> <?= Yii::t('page', 'Pages') ?> <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="page" class="collapse">
                            <?php foreach ($pages as $page) : ?>
                                <li>
                                    <a href="<?= Url::to(["page/info", 'id' => $page->id]) ?>">
                                        <i class="fa fa-fw fa-clipboard"></i> <?= $page->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="<?= (Yii::$app->controller->id == "menu") ? "active" : "" ?>">
                    <a href="<?= Url::to(["menu/index"]) ?>">
                        <i class="fa fa-fw fa-bars"></i> <?= Yii::t('menu', 'Menus') ?>
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
                            <i class="fa fa-dashboard"></i> <a href="<?= Url::to(["site/index"]) ?>"><?= Yii::t('general', 'Home') ?></a>
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
                                <i class="fa <?= $icon ?>"></i>
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
