<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Json;

/**
 * @var \yii\web\View $this
 * @var \sahmed237\yii2admintheme\models\AdminThemeSetting[] $settings
 */

$this->title = 'Theme Settings';
$this->params['breadcrumbs'][] = $this->title;

// Register Coloris assets from CDN
$this->registerCssFile('https://cdn.jsdelivr.net/npm/@melloware/coloris@latest/dist/coloris.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/@melloware/coloris@latest/dist/coloris.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

// Initialize the color picker
$this->registerJs("
    Coloris({
        el: '.color-picker',
        swatches: [
            '#264653',
            '#2a9d8f',
            '#e9c46a',
            '#f4a261',
            '#e76f51',
            '#d62828',
            '#023e8a',
            '#0077b6',
            '#00b4d8',
            '#687cfe',
            '#ff7f5d'
        ]
    });
");

// Font Family options
$fontFamilies = [
    'Roboto' => 'Roboto',
    'Open Sans' => 'Open Sans',
    'Lato' => 'Lato',
    'Montserrat' => 'Montserrat',
    'Source Sans Pro' => 'Source Sans Pro',
    'Poppins' => 'Poppins',
    'Arial' => 'Arial',
    'Tahoma' => 'Tahoma',
];

// Generate font size options from 0.5rem to 1.5rem
$fontSizes = [];
for ($i = 0.5; $i <= 1.5; $i += 0.1) {
    $rem = round($i, 1);
    $fontSizes["{$rem}rem"] = "{$rem} rem";
}


// Enable smooth scrolling for anchor links
$this->registerCss("
    html {
        scroll-behavior: smooth;
    }
");



// Helper function to get a setting value or a default
function getSettingValue($settings, $key, $default = '') {
    return isset($settings[$key]) ? $settings[$key]->value : $default;
}

?>
<div class="theme-settings-index">



    <div id="appearance-settings" class="card">
        <div class="card-body">
            <h5 class="card-title">Appearance</h5>
            <p class="card-subtitle mb-4">Customize the look and feel of your theme.</p>
            
            <?php $form = ActiveForm::begin(); ?>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="primary-color" class="form-label d-block">Primary Color</label>
                    <?= Html::textInput('Settings[primary_color]', getSettingValue($settings, 'primary_color', '#687cfe'), [
                        'class' => 'form-control color-picker',
                        'id' => 'primary-color',
                    ]) ?>
                    <div class="form-text">Main highlight color for buttons, links, and active states.</div>
                </div>
                <div class="col-md-6 flex">
                    <label for="primary-color-hover" class="form-label d-block">Primary Hover</label>
                    <?= Html::textInput('Settings[primary_color_hover]', getSettingValue($settings, 'primary_color_hover', '#5063d9'), [
                        'class' => 'form-control color-picker',
                        'id' => 'primary-color-hover',
                    ]) ?>
                    <div class="form-text">Color used when hovering over primary buttons or links.</div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="secondary-color" class="form-label d-block">Secondary Color</label>
                    <?= Html::textInput('Settings[secondary_color]', getSettingValue($settings, 'secondary_color', '#3cd188'), [
                        'class' => 'form-control color-picker',
                        'id' => 'secondary-color'
                    ]) ?>
                    <div class="form-text">Success messages and secondary actions.</div>
                </div>
                <div class="col-md-6">
                    <label for="secondary-color" class="form-label d-block">Secondary Hover</label>
                    <?= Html::textInput('Settings[secondary_color_hover]', getSettingValue($settings, 'secondary_color_hover', '#3cd188'), [
                        'class' => 'form-control color-picker',
                        'id' => 'secondary-color-hover'
                    ]) ?>
                    <div class="form-text">Success messages and secondary Hover.</div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="warning-color" class="form-label d-block">Warning Color</label>
                    <?= Html::textInput('Settings[warning_color]', getSettingValue($settings, 'warning_color', '#efae4e'), [
                        'class' => 'form-control color-picker',
                        'id' => 'warning-color'
                    ]) ?>
                    <div class="form-text">Used for alerts and notifications that require attention.</div>
                </div>
                <div class="col-md-6">
                    <label for="warning-color" class="form-label d-block">Warning Hover</label>
                    <?= Html::textInput('Settings[warning_color_hover]', getSettingValue($settings, 'warning_color_hover', '#efae4e'), [
                        'class' => 'form-control color-picker',
                        'id' => 'warning-color-hover'
                    ]) ?>
                    <div class="form-text">Used for alerts and notifications that require attention.</div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="info-color" class="form-label d-block">Info Color</label>
                    <?= Html::textInput('Settings[info_color]', getSettingValue($settings, 'info_color', '#0ac7fb'), [
                        'class' => 'form-control color-picker',
                        'id' => 'info-color'
                    ]) ?>
                    <div class="form-text">Used for neutral, informational messages and UI elements.</div>
                </div>
                <div class="col-md-6">
                    <label for="info-color" class="form-label d-block">Info Hover</label>
                    <?= Html::textInput('Settings[info_color_hover]', getSettingValue($settings, 'info_color_hover', '#0ac7fb'), [
                        'class' => 'form-control color-picker',
                        'id' => 'info-color-hover'
                    ]) ?>
                    <div class="form-text">Used for neutral, informational messages and UI elements.</div>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="danger-color" class="form-label d-block">Danger Color</label>
                    <?= Html::textInput('Settings[danger_color]', getSettingValue($settings, 'danger_color', '#f7666e'), [
                        'class' => 'form-control color-picker',
                        'id' => 'danger-color'
                    ]) ?>
                    <div class="form-text">Used for errors, destructive actions, and critical alerts.</div>
                </div>
                <div class="col-md-6">
                    <label for="danger-color" class="form-label d-block">Danger Color</label>
                    <?= Html::textInput('Settings[danger_color_hover]', getSettingValue($settings, 'danger_color_hover', '#f7666e'), [
                        'class' => 'form-control color-picker',
                        'id' => 'danger-color-hover'
                    ]) ?>
                    <div class="form-text">Used for errors, destructive actions, and critical alerts.</div>
                </div>
            </div>
            

            <div class="form-group">
                <?= Html::submitButton('Save Appearance', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div id="layout-settings" class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Layout & Style</h5>
            <p class="card-subtitle mb-4">Control the sidebar and topbar appearance.</p>

            <?php $form = ActiveForm::begin(); ?>

            <div class="mb-3">
                <label for="sidebar-ui" class="form-label">Sidebar UI Style</label>
                <?= Html::dropDownList('Settings[sidebar_ui]', getSettingValue($settings, 'sidebar_ui', 'default'), [
                    'default' => 'Default',
                    'modern' => 'Modern (Pill Style)',
                ], ['class' => 'form-select', 'id' => 'sidebar-ui']) ?>
                <div class="form-text">Choose the visual style for the main sidebar.</div>
            </div>

            <div class="mb-3">
                <label for="topbar-ui" class="form-label">Topbar UI Style</label>
                <?= Html::dropDownList('Settings[topbar_ui]', getSettingValue($settings, 'topbar_ui', 'default'), [
                    'default' => 'Default',
                    'modern' => 'Modern (Pill Style)',
                ], ['class' => 'form-select', 'id' => 'topbar-ui']) ?>
                <div class="form-text">Choose the visual style for the Top sidebar.</div>
            </div>

                <?= $this->render('_layout_customizer', ['settings' => $settings]) ?>

            <div class="form-group">
                <?= Html::submitButton('Save Layout Style', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
    <div id="typography-settings" class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Typography</h5>
            <p class="card-subtitle mb-4">Font and Font size.</p>

            <?php $form = ActiveForm::begin(); ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::label('Font Family', 'Settings[font_family]', ['class' => 'form-label']) ?>
                        <?= Html::dropDownList(
                            'Settings[font_family]',
                            $settings['font_family'] ?? null,
                            $fontFamilies,
                            [
                                'class' => 'form-control font-family-dropdown',
                                'id' => 'settings-font-family'
                            ]
                        ) ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?= Html::label('Font Size (rem)', 'Settings[font_size]', ['class' => 'form-label']) ?>
                        <?= Html::dropDownList(
                            'Settings[font_size]',
                            $settings['font_size'] ?? null,
                            $fontSizes,
                            ['class' => 'form-control', 'id' => 'settings-font-size']
                        ) ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Save Typography', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
    <div id="branding-settings" class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Branding</h5>
            <p class="card-subtitle mb-4">Logo and fav icon.</p>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Logo Light (Large)</label>
                        <div class="row mb-2">
                            <?php if (!empty($settings['logo_light_lg']->value)): ?>
                                <div class="col-md-6">
                                    <img src="<?= $settings['logo_light_lg']->value ?>" alt="Logo Light Large" class="img-thumbnail" style="height: 100px; width: 100px">
                                </div>
                            <?php endif; ?>
                            <div id="logo_light_lg_preview" class="col-md-6"></div>
                        </div>
                        <?= Html::fileInput('Settings[logo_light_lg]', null, [
                            'class' => 'form-control file-input-preview',
                            'accept' => 'image/png, image/jpeg, image/jpg',
                            'data-preview-target' => 'logo_light_lg_preview',
                            'data-max-size' => 1048576,
                        ]) ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Logo Light (Small)</label>
                        <div class="row mb-2">
                            <?php if (!empty($settings['logo_light_sm']->value)): ?>
                                <div class="col-md-6">
                                    <img src="<?= $settings['logo_light_sm']->value ?>" alt="Logo Light Small" class="img-thumbnail" style="height: 100px; width: 100px">
                                </div>
                            <?php endif; ?>
                            <div id="logo_light_sm_preview" class="col-md-6"></div>
                        </div>
                        <?= Html::fileInput('Settings[logo_light_sm]', null, [
                            'class' => 'form-control file-input-preview',
                            'accept' => 'image/png, image/jpeg, image/jpg',
                            'data-preview-target' => 'logo_light_sm_preview',
                            'data-max-size' => 1048576,
                        ]) ?>

                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Logo Dark (Large)</label>
                        <div class="row mb-2">
                            <?php if (!empty($settings['logo_dark_lg']->value)): ?>
                                <div class="col-md-6">
                                    <img src="<?= $settings['logo_dark_lg']->value ?>" alt="Logo Dark Large" class="img-thumbnail" style="height: 100px; width: 100px">
                                </div>
                            <?php endif; ?>
                            <div id="logo_dark_lg_preview" class="col-md-6"></div>
                        </div>
                        <?= Html::fileInput('Settings[logo_dark_lg]', null, [
                            'class' => 'form-control file-input-preview',
                            'accept' => 'image/png, image/jpeg, image/jpg',
                            'data-preview-target' => 'logo_dark_lg_preview',
                            'data-max-size' => 1048576,
                        ]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Logo Dark (Small)</label>
                        <div class="row mb-2">
                            <?php if (!empty($settings['logo_dark_sm']->value)): ?>
                                <div class="col-md-6">
                                    <img src="<?= $settings['logo_dark_sm']->value ?>" alt="Logo Dark Small" class="img-thumbnail" style="height: 100px; width: 100px">
                                </div>
                            <?php endif; ?>
                            <div id="logo_dark_sm_preview" class="col-md-6"></div>
                        </div>
                        <?= Html::fileInput('Settings[logo_dark_sm]', null, [
                            'class' => 'form-control file-input-preview',
                            'accept' => 'image/png, image/jpeg, image/jpg',
                            'data-preview-target' => 'logo_dark_sm_preview',
                            'data-max-size' => 1048576,
                        ]) ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Fav Icon</label>
                        <div class="row mb-2">
                            <?php if (!empty($settings['fav_icon']->value)): ?>
                                <div class="col-md-6">
                                    <img src="<?= $settings['fav_icon']->value ?>" alt="Fav Icon" class="img-thumbnail" style="height: 100px; width: 100px">
                                </div>
                            <?php endif; ?>
                            <div id="fav_icon_preview" class="col-md-6"></div>
                        </div>
                        <?= Html::fileInput('Settings[fav_icon]', null, [
                            'class' => 'form-control file-input-preview',
                            'accept' => 'image/ico',
                            'data-preview-target' => 'fav_icon_preview',
                            'data-max-size' => 1048576,
                        ]) ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Save Branding', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>

</div>

<?php
$this->registerJs(<<<JS
document.querySelectorAll('.file-input-preview').forEach(input => {
    input.addEventListener('change', function () {
        const previewId = this.dataset.previewTarget;
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = '';

        const file = this.files[0];
        const maxSize = parseInt(this.dataset.maxSize || '0');

        if (!file) return;

        if (maxSize && file.size > maxSize) {
            alert('File too large. Max allowed size is 1MB.');
            this.value = '';
            return;
        }

        const allowedTypes = ['image/png', 'image/jpeg'];
        if (!allowedTypes.includes(file.type)) {
            alert('Only PNG and JPEG images are allowed.');
            this.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.alt = 'Preview';
            img.className = 'img-thumbnail';
            img.style.height = '100px';
            img.style.width = '100px';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});

JS
);

// Register styling for previewing font family in dropdown
$this->registerCss("
    select.font-family-dropdown option {
        font-family: inherit;
    }

    select.font-family-dropdown option[value='Roboto'] { font-family: 'Roboto', sans-serif; }
    select.font-family-dropdown option[value='Open Sans'] { font-family: 'Open Sans', sans-serif; }
    select.font-family-dropdown option[value='Lato'] { font-family: 'Lato', sans-serif; }
    select.font-family-dropdown option[value='Montserrat'] { font-family: 'Montserrat', sans-serif; }
    select.font-family-dropdown option[value='Source Sans Pro'] { font-family: 'Source Sans Pro', sans-serif; }
    select.font-family-dropdown option[value='Poppins'] { font-family: 'Poppins', sans-serif; }
    select.font-family-dropdown option[value='Arial'] { font-family: Arial, sans-serif; }
    select.font-family-dropdown option[value='Tahoma'] { font-family: Tahoma, sans-serif; }
");
