<?php

use yii\helpers\ArrayHelper;


// Use null coalescing operator for fallback defaults
$sidebarUi = $settings['sidebar_ui']->value ?? 'default';
$layout = $settings['theme_layout']->value ?? 'semibox';
$topbar = $settings['topbar_color']->value ?? 'light';
$sidebarColor = $settings['sidebar_color']->value ?? 'gradient-3';
$sidebarImage = $settings['sidebar_image']->value ?? 'none';
$sidebarSize = $settings['sidebar_size']->value ?? 'lg';
$preloader = $settings['preloader']->value ?? 'disable';



?>
<!doctype html>
<html lang="en" data-layout="<?= $layout ?>" data-sidebar-visibility="show" data-topbar="<?= $topbar ?>" data-sidebar="<?= $sidebarColor ?>" data-sidebar-size="<?= $sidebarSize ?>" data-sidebar-image="<?= $sidebarImage ?>" data-preloader="<?= $preloader ?>" data-sidebar-ui="<?= $sidebarUi ?>">
