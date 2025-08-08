<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use sahmed237\yii2admintheme\models\AdminMenu;

/* @var $model AdminMenu */
/* @var $index integer */
/* @var $parentId mixed */
/* @var $isChild bool */
/* @var $nestLevel integer */
/* @var $parentPath string */

// Generate unique ID for new items
$itemId = $model->isNewRecord ? 'new-'.uniqid() : $model->id;

// Calculate nest level if not provided
if (!isset($nestLevel)) {
    $nestLevel = $isChild ? 1 : 0;
}

// Generate proper input path
$inputPath = '';
if ($isChild && isset($parentPath)) {
    $inputPath = "{$parentPath}[children][{$index}]";
} else {
    $inputPath = "[{$index}]";
}

// Generate unique prefix for IDs
$idPrefix = 'adminmenu-'.str_replace(['[', ']'], '-', trim($inputPath, '[]'));
?>

<div class="menu-item card mb-2 <?= $isChild ? 'child-item' : '' ?>"
     data-index="<?= $index ?>"
     data-id="<?= $itemId ?>"
     data-parent="<?= $parentId ?>"
     data-nest-level="<?= $nestLevel ?>">

    <div class="card-header d-flex justify-content-between align-items-center bg-light">
        <div class="d-flex align-items-center">
            <i class="ri-drag-move-2-fill drag-handle me-2"></i>
            <h5 class="mb-0">
                <span class="item-position"><?= str_repeat('— ', $nestLevel) ?>Display Order: <?= $index + 1 ?></span>
            </h5>
        </div>

        <div>
            <button type="button" class="btn btn-sm btn-info add-child me-2">
                <i class="fas fa-plus-circle me-1"></i> Add Child
            </button>
            <button type="button" class="btn btn-sm btn-danger remove-menu">
                <i class="fas fa-trash-alt me-1"></i> Remove
            </button>
        </div>
    </div>

    <div class="card-body">
        <!-- Hidden fields for structure -->
        <input type="hidden" name="AdminMenu<?= $inputPath ?>[id]" value="<?= $itemId ?>" id="<?= $idPrefix ?>-id">
        <input type="hidden" name="AdminMenu<?= $inputPath ?>[parent_id]" value="<?= $parentId ?>" id="<?= $idPrefix ?>-parent_id">
        <input type="hidden" name="AdminMenu<?= $inputPath ?>[order]" value="<?= $index ?>" id="<?= $idPrefix ?>-order">

        <div class="row mb-3">
            <div class="col-md-2">
                <div class="form-group">
                    <?= Html::activeLabel($model, 'label', ['class' => 'control-label']) ?>
                    <input type="text" id="<?= $idPrefix ?>-label" class="form-control"
                           name="AdminMenu<?= $inputPath ?>[label]" maxlength="255"
                           placeholder="Menu Label" required value="<?= Html::encode($model->label) ?>">
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <?= Html::activeLabel($model, 'route', ['class' => 'control-label']) ?>
                    <input type="text" id="<?= $idPrefix ?>-route" class="form-control"
                           name="AdminMenu<?= $inputPath ?>[route]" maxlength="255"
                           placeholder="e.g., /site/index" value="<?= Html::encode($model->route) ?>">
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?= Html::activeLabel($model, 'icon', ['class' => 'control-label']) ?>
                    <?= Html::dropDownList(
                        "AdminMenu[{$index}][icon]",
                        $model->icon,
                        [], // Options will be populated by Choices.js
                        [
                            'class' => 'form-control icon-select',
                            'prompt' => 'Select Icon',
                            'data-initial-value' => $model->icon
                        ]
                    ) ?>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-check form-switch mt-3">
                    <input type="hidden" name="AdminMenu<?= $inputPath ?>[visible]" value="0">
                    <input type="checkbox" id="<?= $idPrefix ?>-visible" class="form-check-input" role="switch"
                           name="AdminMenu<?= $inputPath ?>[visible]" value="1"
                        <?= $model->visible ? 'checked' : '' ?>>
                    <?= Html::activeLabel($model, 'visible', ['class' => 'form-check-label', 'for' => $idPrefix . '-visible']) ?>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <?= Html::activeLabel($model, 'rbac_permission', ['class' => 'control-label']) ?>
                    <?php
                    $permissions = [];
                    if (Yii::$app->authManager !== null) {
                        $permissions = ArrayHelper::map(Yii::$app->authManager->getPermissions(), 'name', 'name');
                    }
                    echo Html::activeDropDownList($model, 'rbac_permission', $permissions, [
                        'name' => "AdminMenu{$inputPath}[rbac_permission]",
                        'id' => "{$idPrefix}-rbac_permission",
                        'class' => 'form-control',
                        'prompt' => Yii::$app->authManager ? '-- Select Permission --' : 'RBAC Not Configured',
                        'disabled' => Yii::$app->authManager === null,
                        'value' => $model->rbac_permission
                    ]);
                    ?>
                </div>
            </div>
        </div>

        <?php if (!empty($model->children)): ?>
            <div class="child-container ps-4 mt-2" data-nest-level="<?= $nestLevel + 1 ?>">
                <?php foreach ($model->children as $childIndex => $child): ?>
                    <?= $this->render('_menu_item', [
                        'model' => $child,
                        'index' => $childIndex,
                        'parentId' => $model->id,
                        'isChild' => true,
                        'nestLevel' => $nestLevel + 1,
                        'parentPath' => $inputPath,
                        'iconList' => $iconList
                    ]) ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>