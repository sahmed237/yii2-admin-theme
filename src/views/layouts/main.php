<?php

/** @var yii\web\View $this */
/** @var string $content */

use sahmed237\yii2admintheme\assets\AdminThemeAsset;
use sahmed237\yii2admintheme\models\AdminThemeSetting;
use sahmed237\yii2admintheme\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use sahmed237\yii2admintheme\helpers\ThemeHelper;
use yii\widgets\Menu;


AdminThemeAsset::register($this);
$this->registerCsrfMetaTags();

$settings = AdminThemeSetting::find()
    ->indexBy('key') // Make it an associative array by 'key'
    ->all();

$fontFamily = $settings['font_family']->value ?? '';
$fontSize = $settings['font_size']->value ?? '';
?>

<?php $this->beginPage() ?>
<?php echo $this->render('_main', ['settings' => $settings]); ?>

<head>
    <?php $this->head() ?>
    <?php echo $this->render('_title-meta', array('title'=> $this->title)); ?>
    <?= ThemeHelper::getDynamicCss() ?>
</head>

<body style="font-family: <?= $fontFamily ?> ; font-size:<?= $fontSize ?> ;">
<?php $this->beginBody() ?>
<!-- Begin page -->
<div id="layout-wrapper">

    <?php echo $this->render('_menu', ['settings' => $settings]); ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content overflow-hidden">

        <div class="page-content">
            <div class="container-fluid">

                <?php echo $this->render('_page-title', array('pagetitle'=>'Home', 'title'=>$this->title)); ?>
                <?= Alert::widget() ?>
                <?php if (isset($this->params['sidebar'])): ?>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <?= Menu::widget([
                                    'options' => [
                                        'class' => 'nav nav-pills flex-column',
                                    ],
                                    'items' => $this->params['sidebar'],
                                    'linkTemplate' => '<a class="nav-link" href="{url}">{label}</a>',
                                    'activeCssClass' => 'active',
                                ]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <?= $content ?>
                    </div>
                </div>
            <?php else: ?>
                <?= $content ?>
            <?php endif; ?>


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php echo $this->render('_footer'); ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?php echo $this->render('_customizer'); ?>


<?php $this->endBody() ?>

</body>
<?php $this->endPage() ?>
