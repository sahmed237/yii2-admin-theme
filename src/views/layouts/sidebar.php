<?php

use yii\helpers\Html;
use sahmed237\yii2admintheme\widgets\MenuWidget;

$logoDarkSm = $settings['logo_dark_sm']->value ?? '' ;
$logoDarkLg = $settings['logo_dark_lg']->value ?? '' ;
$logoLightSm = $settings['logo_light_sm']->value ?? '' ;
$logoLightLg = $settings['logo_light_lg']->value ?? '' ;

?>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?= $logoDarkSm  ?>" alt="Logo Dark Sm" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= $logoDarkLg ?>" alt="Logo Dark Lg" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?= $logoLightSm ?>" alt="Loogo Ligh Sm" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= $logoLightLg ?>" alt="Logo Ligh Lg" height="50">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <?= MenuWidget::widget() ?>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>

