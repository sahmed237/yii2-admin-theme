<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

use yii\helpers\Html;
?>

<div class="row">
    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="p-4">
                <h6 class="mb-0 fw-semibold text-uppercase">Layout</h6>
                <p class="text-muted">Choose your layout</p>

                <div class="row gy-3">
                    <div class="col-4">
                        <div class="form-check theme-card-radio">
                            <?= Html::radio('Settings[theme_layout]', getSettingValue($settings, 'theme_layout', 'vertical') === 'vertical', [
                                'value' => 'vertical',
                                'class' => 'form-check-input d-none'
                            ]) ?>

                            <label class=" theme-card-label p-0 avatar-md w-100" for="vertical-layout">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Vertical</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check theme-card-radio">
                            <?= Html::radio('Settings[theme_layout]', getSettingValue($settings, 'theme_layout', 'horizontal') === 'horizontal', [
                                'value' => 'horizontal',
                                'class' => 'form-check-input d-none'
                            ]) ?>

                            <label class="theme-card-label p-0 avatar-md w-100" for="horizontal-layout">
                                <span class="d-flex h-100 flex-column gap-1">
                                    <span class="bg-light d-flex p-1 gap-1 align-items-center">
                                        <span class="d-block p-1 bg-primary-subtle rounded me-1"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle ms-auto"></span>
                                        <span class="d-block p-1 pb-0 px-2 bg-primary-subtle"></span>
                                    </span>
                                    <span class="bg-light d-block p-1"></span>
                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Horizontal</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check theme-card-radio">
                            <?= Html::radio('Settings[theme_layout]', getSettingValue($settings, 'theme_layout', 'twocolumn') === 'twocolumn', [
                                'value' => 'twocolumn',
                                'class' => 'form-check-input d-none'
                            ]) ?>
                            <label class="theme-card-label p-0 avatar-md w-100" for="twocolumn-layout">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1">
                                            <span class="d-block p-1 bg-primary-subtle mb-2"></span>
                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Two Column</h5>
                    </div>
                    <!-- end col -->

                    <div class="col-4">
                        <div class="form-check theme-card-radio">
                            <?= Html::radio('Settings[theme_layout]', getSettingValue($settings, 'theme_layout', 'semibox') === 'semibox', [
                                'value' => 'semibox',
                                'class' => 'form-check-input d-none'
                            ]) ?>
                            <label class="theme-card-label p-0 avatar-md w-100" for="semibox-layout">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0 p-1">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column pt-1 pe-2">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Semi Box</h5>
                    </div>
                    <!-- end col -->
                </div>

                <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Topbar Color</h6>
                <p class="text-muted">Choose Light or Dark Topbar Color.</p>

                <div class="row">
                    <div class="col-4">
                        <div class="form-check theme-card-radio">
                            <?= Html::radio('Settings[topbar_color]', getSettingValue($settings, 'topbar_color', 'light') === 'light', [
                                'value' => 'light',
                                'class' => 'form-check-input d-none'
                            ]) ?>
                            <label class="theme-card-label p-0 avatar-md w-100" for="topbar-light">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Light</h5>
                    </div>
                    <div class="col-4">
                        <div class="form-check theme-card-radio">
                            <?= Html::radio('Settings[topbar_color]', getSettingValue($settings, 'topbar_color', 'dark') === 'dark', [
                                'value' => 'dark',
                                'class' => 'form-check-input d-none'
                            ]) ?>
                            <label class="theme-card-label p-0 avatar-md w-100" for="topbar-dark">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-primary d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </label>
                        </div>
                        <h5 class="fs-13 text-center mt-2">Dark</h5>
                    </div>
                </div>

                <div id="sidebar-color">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Color</h6>
                    <p class="text-muted">Choose a color of Sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check theme-card-radio" data-bs-toggle="collapse" data-bs-target="#collapseSidebarGradient.show">
                                <?= Html::radio('Settings[sidebar_color]', getSettingValue($settings, 'sidebar_color', 'light') === 'light', [
                                    'value' => 'light',
                                    'class' => 'form-check-input d-none'
                                ]) ?>
                                <label class="theme-card-label p-0 avatar-md w-100" for="sidebar-light">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Light</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check theme-card-radio" data-bs-toggle="collapse" data-bs-target="#collapseSidebarGradient.show">
                                <?= Html::radio('Settings[sidebar_color]', getSettingValue($settings, 'sidebar_color', 'dark') === 'dark', [
                                    'value' => 'dark',
                                    'class' => 'form-check-input d-none'
                                ]) ?>
                                <label class="theme-card-label p-0 avatar-md w-100" for="sidebar-dark">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-primary d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Dark</h5>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-link avatar-md w-100 p-0 overflow-hidden border collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSidebarGradient" aria-expanded="false" aria-controls="collapseSidebarGradient">
                                <span class="d-flex gap-1 h-100">
                                    <span class="flex-shrink-0">
                                        <span class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1">
                                            <span class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                            <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                        </span>
                                    </span>
                                    <span class="flex-grow-1">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-block p-1"></span>
                                            <span class="bg-light d-block p-1 mt-auto"></span>
                                        </span>
                                    </span>
                                </span>
                            </button>
                            <h5 class="fs-13 text-center mt-2">Gradient</h5>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="collapse" id="collapseSidebarGradient">
                        <div class="d-flex gap-2 flex-wrap img-switch p-2 px-3 bg-light rounded">

                            <div class="form-check sidebar-setting theme-card-radio">
                                <?= Html::radio('Settings[sidebar_color]', getSettingValue($settings, 'sidebar_color', 'gradient') === 'gradient', [
                                    'value' => 'gradient',
                                    'class' => 'form-check-input d-none',
                                    'id' => 'sidebar-gradient'
                                ]) ?>
                                <label class="theme-card-label  p-0 avatar-xs rounded-circle" for="sidebar-gradient">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting theme-card-radio">
                                <?= Html::radio('Settings[sidebar_color]', getSettingValue($settings, 'sidebar_color', 'gradient-2') === 'gradient-2', [
                                    'value' => 'gradient-2',
                                    'class' => 'form-check-input  d-none',
                                    'id' => 'sidebar-gradient-2'
                                ]) ?>
                                <label class="theme-card-label  p-0 avatar-xs rounded-circle" for="sidebar-gradient-2">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-2"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting theme-card-radio">
                                <?= Html::radio('Settings[sidebar_color]', getSettingValue($settings, 'sidebar_color', 'gradient-3') === 'gradient-3', [
                                    'value' => 'gradient-3',
                                    'class' => 'form-check-input d-none',
                                    'id' => 'sidebar-gradient-3'
                                ]) ?>
                                <label class="theme-card-label  p-0 avatar-xs rounded-circle" for="sidebar-gradient-3">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-3"></span>
                                </label>
                            </div>
                            <div class="form-check sidebar-setting theme-card-radio">
                                <?= Html::radio('Settings[sidebar_color]', getSettingValue($settings, 'sidebar_color', 'gradient-4') === 'gradient-4', [
                                    'value' => 'gradient-4',
                                    'class' => 'form-check-input d-none'
                                ]) ?>
                                <label class="theme-card-label  p-0 avatar-xs rounded-circle " for="sidebar-gradient-4">
                                    <span class="avatar-title rounded-circle bg-vertical-gradient-4"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sidebar-sizeu">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Size</h6>
                    <p class="text-muted">Choose a size of Sidebar.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <?= Html::radio('Settings[sidebar_size]', getSettingValue($settings, 'sidebar_size', 'lg') === 'lg', [
                                    'value' => 'lg',
                                    'class' => 'form-check-input',
                                    'id' => 'sidebar-size-lg'
                                ]) ?>
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-lg">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Default</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <?= Html::radio('Settings[sidebar_size]', getSettingValue($settings, 'sidebar_size', 'md') === 'md', [
                                    'value' => 'md',
                                    'class' => 'form-check-input',
                                    'id' => 'sidebar-size-md'
                                ]) ?>
                                <label class="form-check-label p-0 avatar-md w-100" for="sidebar-size-md">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Compact</h5>
                        </div>
                    </div>
                </div>
                <div id="sidebar-img">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Images</h6>
                    <p class="text-muted">Choose a image of Sidebar.</p>

                    <div class="d-flex gap-2 flex-wrap img-switch">
                        <div class="form-check sidebar-setting card-radio">

                            <?= Html::radio('Settings[sidebar_image]', getSettingValue($settings, 'sidebar_image', 'none') === 'none', [
                                'value' => 'none',
                                'class' => 'form-check-input',
                                'id' => 'sidebarimage-none'
                            ]) ?>
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimage-none">
                                <span class="avatar-md w-auto bg-light d-flex align-items-center justify-content-center">
                                    <i class="ri-close-fill fs-20"></i>
                                </span>
                            </label>
                        </div>

                        <div class="form-check sidebar-setting card-radio">
                            <?= Html::radio('Settings[sidebar_image]', getSettingValue($settings, 'sidebar_image', 'img-1') === 'img-1', [
                                'value' => 'img-1',
                                'class' => 'form-check-input',
                                'id' => 'sidebarimage-01'
                            ]) ?>
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimage-01">
                                <img src="/images/sidebar/img-1.jpg" alt="" class="avatar-md w-auto object-fit-cover">
                            </label>
                        </div>

                        <div class="form-check sidebar-setting card-radio">
                            <?= Html::radio('Settings[sidebar_image]', getSettingValue($settings, 'sidebar_image', 'img-2') === 'img-2', [
                                'value' => 'img-2',
                                'class' => 'form-check-input',
                                'id' => 'sidebarimage-02'
                            ]) ?>
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimage-02">
                                <img src="/images/sidebar/img-2.jpg" alt="" class="avatar-md w-auto object-fit-cover">
                            </label>
                        </div>
                        <div class="form-check sidebar-setting card-radio">
                            <?= Html::radio('Settings[sidebar_image]', getSettingValue($settings, 'sidebar_image', 'img-3') === 'img-3', [
                                'value' => 'img-3',
                                'class' => 'form-check-input',
                                'id' => 'sidebarimage-03'
                            ]) ?>
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimage-03">
                                <img src="/images/sidebar/img-3.jpg" alt="" class="avatar-md w-auto object-fit-cover">
                            </label>
                        </div>
                        <div class="form-check sidebar-setting card-radio">
                            <input class="form-check-input" type="radio" name="data-sidebar-image" id="sidebarimg-04" value="img-4">
                            <?= Html::radio('Settings[sidebar_image]', getSettingValue($settings, 'sidebar_image', 'img-4') === 'img-4', [
                                'value' => 'img-4',
                                'class' => 'form-check-input',
                                'id' => 'sidebarimage-04'
                            ]) ?>
                            <label class="form-check-label p-0 avatar-sm h-auto" for="sidebarimage-04">
                                <img src="/images/sidebar/img-4.jpg" alt="" class="avatar-md w-auto object-fit-cover">
                            </label>
                        </div>
                    </div>
                </div>

                <div id="preloader-menu">
                    <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Preloader</h6>
                    <p class="text-muted">Choose a preloader.</p>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <?= Html::radio('Settings[preloader]', getSettingValue($settings, 'preloader', 'enable') === 'enable', [
                                    'value' => 'enable',
                                    'class' => 'form-check-input',
                                    'id' => 'preloader-custom'
                                ]) ?>
                                <label class="form-check-label p-0 avatar-md w-100" for="preloader-custom">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                    <!-- <div id="preloader"> -->
                                    <div id="status" class="d-flex align-items-center justify-content-center">
                                        <div class="spinner-border text-primary avatar-xxs m-auto" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Enable</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check sidebar-setting card-radio">
                                <?= Html::radio('Settings[preloader]', getSettingValue($settings, 'preloader', 'disable') === 'disable', [
                                    'value' => 'disable',
                                    'class' => 'form-check-input',
                                    'id' => 'preloader-none'
                                ]) ?>
                                <label class="form-check-label p-0 avatar-md w-100" for="preloader-none">
                                    <span class="d-flex gap-1 h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                                <span class="bg-light d-block p-1 mt-auto"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="fs-13 text-center mt-2">Disable</h5>
                        </div>
                    </div>

                </div>
                <!-- end preloader-menu -->

            </div>
        </div>

    </div>

</div>
