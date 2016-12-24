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
use app\components\General;
use app\models\Department;
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
    <title>4ª URE - Administração</title>
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
            <a class="navbar-brand" href="<?= Url::to(["site/index"]) ?>">4ª URE - Administração</a>
        </div>

        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <!--            <li class="dropdown">-->
            <!--                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>-->
            <!--                <ul class="dropdown-menu alert-dropdown">-->
            <!--                    <li>-->
            <!--                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>-->
            <!--                    </li>-->
            <!--                    <li class="divider"></li>-->
            <!--                    <li>-->
            <!--                        <a href="#">View All</a>-->
            <!--                    </li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-fw fa-user"></i> <?= Yii::$app->getUser()->getIdentity()->getName() ?> <b
                            class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?= Url::to(["site/password"]) ?>"><i class="fa fa-fw fa-key"></i> Alterar senha</a>
                    </li>
                    <!--                    <li>-->
                    <!--                        <a href="#"><i class="fa fa-fw fa-gear"></i> Configurações</a>-->
                    <!--                    </li>-->
                    <li class="divider"></li>
                    <li>
                        <a href="<?= Url::to(["site/logout"]) ?>"><i class="fa fa-fw fa-power-off"></i> Sair</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="<?= (Yii::$app->controller->id == "site") ? "active" : "" ?>">
                    <a href="<?= Url::to(["site/index"]) ?>">
                        <i class="fa fa-fw fa-home"></i> Principal
                    </a>
                </li>
                <li class="<?= ((Yii::$app->controller->id == "user") || ((Yii::$app->controller->id == "department") && (Yii::$app->controller->action->id !== "info"))) ? "active" : "" ?>">
                    <a href="javascript:;" data-toggle="collapse" data-target="#records">
                        <i class="fa fa-fw fa-pencil-square-o"></i> Cadastros <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="records" class="collapse">
                        <li>
                            <a href="<?= Url::to(["download-category/index"]) ?>"><i class="fa fa-fw fa-archive"></i> Categorias de download</a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["department/index"]) ?>"><i class="fa fa-fw fa-newspaper-o"></i> Departamentos</a>
                        </li>
                        <li>
                            <a href="<?= Url::to(["user/index"]) ?>"><i class="fa fa-fw fa-user"></i> Usuários</a>
                        </li>
                    </ul>
                </li>
                <?php  $departments = General::getDepartments() ?>
                <?php if (count($departments) > 0) : ?>
                <li class="<?= ((Yii::$app->controller->id == "department") && (Yii::$app->controller->action->id == "info")) ? "active" : "" ?>">
                    <a href="javascript:;" data-toggle="collapse" data-target="#department">
                        <i class="fa fa-fw fa-newspaper-o"></i> Departamentos <i class="fa fa-fw fa-caret-down"></i>
                    </a>
                    <ul id="department" class="collapse">
                        <?php foreach ($departments as $department) : ?>
                            <li>
                                <a href="<?= Url::to(["department/info", 'id' => $department->id]) ?>">
                                    <i class="fa fa-fw fa-newspaper-o"></i> <?= $department->name ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <?php endif; ?>

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
                            <i class="fa fa-dashboard"></i> <a href="<?= Url::to(["site/index"]) ?>">Principal</a>
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
