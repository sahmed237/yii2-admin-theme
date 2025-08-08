<?php

use yii\helpers\Html;
use sahmed237\yii2admintheme\widgets\MenuWidget;
?>
<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?= $settings['logo_dark_sm']->value ?>" alt="Logo Dark Sm" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= $settings['logo_dark_lg']->value ?>" alt="Logo Dark Lg" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?= $settings['logo_light_sm']->value ?>" alt="Loogo Ligh Sm" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?= $settings['logo_light_lg']->value ?>" alt="Logo Ligh Lg" height="50">
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

