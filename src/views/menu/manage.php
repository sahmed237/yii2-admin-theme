<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use sahmed237\yii2admintheme\models\AdminMenu;
use sahmed237\yii2admintheme\assets\AdminThemeAsset;

AdminThemeAsset::register($this);

/* @var $this yii\web\View */
/* @var $rootItems AdminMenu[] */
/* @var $iconList array */

$this->title = 'Manage Menu';
$this->params['breadcrumbs'][] = ['label' => 'Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsVar('iconList', $iconList);

// Get permissions for RBAC if available
$permissions = [];
if (Yii::$app->authManager !== null) {
    $permissions = yii\helpers\ArrayHelper::map(Yii::$app->authManager->getPermissions(), 'name', 'name');
}
?>
    <style>
        .child-container {
            border-left: 2px solid #eee;
            margin-left: 1rem;
        }
        .child-container .child-container {
            margin-left: 2rem;
        }
    </style>
    <div class="admin-menu-manage">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h3 class="card-title mb-0 me-2"><?= Html::encode($this->title) ?></h3>
                    <small class="text-muted">
                        <i class="ri-information-line"></i>
                        Use the <i class="ri-drag-move-2-fill"></i> handle to reorder menu items.
                    </small>
                </div>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'menu-form']); ?>

            <div class="card-body">
                <div id="menu-container" class="sortable-container">
                    <?php foreach ($rootItems as $index => $item): ?>
                        <?= $this->render('_menu_item', [
                            'model' => $item,
                            'index' => $index,
                            'parentId' => null,
                            'isChild' => false,
                            'permissions' => $permissions,
                            'iconList' => $iconList,
                        ]) ?>
                    <?php endforeach; ?>
                </div>

                <div class="form-group mt-3">
                    <button type="button" id="add-root-item" class="btn btn-success">
                        <i class="fas fa-plus-circle me-2"></i> Add Top-Level Menu
                    </button>

                    <button type="button" id="save-structure-btn" class="btn btn-primary float-end">
                        <i class="fas fa-save me-2"></i> Save Menu
                    </button>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuContainer = document.getElementById('menu-container');
            const addRootButton = document.getElementById('add-root-item');
            const menuAddUrl = '<?= Url::to(['add-menu-item']) ?>';
            
            function addMenuItem(parentId, index) {
                const url = menuAddUrl + '?index=' + index + (parentId ? '&parentId=' + encodeURIComponent(parentId) : '');
                fetch(url)
                    .then(response => response.text())
                    .then(html => {
                        const template = document.createElement('template');
                        template.innerHTML = html.trim();
                        const newItem = template.content.firstChild;

                        if (!parentId) {
                            menuContainer.appendChild(newItem);
                        } else {
                            const parentElement = document.querySelector(`.menu-item[data-id="${parentId}"]`);
                            let childContainer = parentElement.querySelector('.child-container');
                            if (!childContainer) {
                                childContainer = document.createElement('div');
                                childContainer.className = 'child-container ps-4 mt-2';
                                parentElement.appendChild(childContainer);
                            }
                            childContainer.appendChild(newItem);
                        }

                        initSortableContainers();
                        updateMenuIndexes();
                        
                        // Initialize the icon selector on the new item
                        initializeIconSelectors();
                    })
                    .catch(error => {
                        console.error('Error adding menu item:', error);
                        alert('Failed to add menu item. Please try again.');
                    });
            }

            document.addEventListener('click', function(e) {
                if (e.target.closest('.add-child')) {
                    const parentItem = e.target.closest('.menu-item');
                    const parentId = parentItem.dataset.id;
                    const childContainer = parentItem.querySelector('.child-container');
                    const index = childContainer ? childContainer.children.length : 0;
                    addMenuItem(parentId, index);
                }
                
                if (e.target.closest('.remove-menu')) {
                    if (confirm('Are you sure you want to remove this menu item and all its children?')) {
                        e.target.closest('.menu-item').remove();
                        updateMenuIndexes();
                    }
                }
            });

            addRootButton.addEventListener('click', function() {
                const index = document.querySelectorAll('#menu-container > .menu-item').length;
                addMenuItem(null, index);
            });
            
            function initSortableContainers() {
                const containers = document.querySelectorAll('.sortable-container, .child-container');
                containers.forEach(container => {
                    new Sortable(container, {
                        group: 'nested-menu', // The key change to allow dragging between lists
                        handle: '.drag-handle',
                        animation: 150,
                        fallbackOnBody: true,
                        swapThreshold: 0.65,
                        ghostClass: 'sortable-ghost',
                        onEnd: updateMenuIndexes
                    });
                });
            }

            function updateMenuIndexes() {
                function processContainer(container, parentPath = '', parentItem = null) {
                    const items = Array.from(container.children).filter(el => el.matches('.menu-item'));
                    items.forEach((item, position) => {
                        const currentPath = parentPath ? `${parentPath}[children][${position}]` : `[${position}]`;
                        item.dataset.parent = parentItem ? parentItem.dataset.id : '';
                        item.querySelectorAll('input, select').forEach(input => {
                            const name = input.name;
                            const attributeMatch = name.match(/\[([^\[\]]+)\]$/);
                            if (attributeMatch) {
                                const attributeName = attributeMatch[0];
                                input.name = `AdminMenu${currentPath}${attributeName}`;
                                if (input.id) {
                                    const fieldName = attributeName.replace(/[\[\]]/g, '');
                                    const idPath = `adminmenu${currentPath.replace(/\]\[/g, '-').replace(/\[|\]/g, '')}`;
                                    input.id = `${idPath}-${fieldName}`.toLowerCase();
                                }
                            }
                        });
                        const orderInput = item.querySelector(`input[name="AdminMenu${currentPath}[order]"]`);
                        if (orderInput) orderInput.value = position;
                        const positionElement = item.querySelector('.item-position');
                        if (positionElement) {
                            const nestLevel = parentItem ? (parseInt(parentItem.dataset.nestLevel || 0) + 1) : 0;
                            item.dataset.nestLevel = nestLevel;
                            positionElement.textContent = `${'— '.repeat(nestLevel)}Display Order: ${position + 1}`;
                        }
                        const childContainer = item.querySelector('.child-container');
                        if (childContainer) {
                            processContainer(childContainer, currentPath, item);
                        }
                    });
                }
                processContainer(menuContainer);
            }

            function serializeMenu(container) {
                const items = Array.from(container.children).filter(el => el.matches('.menu-item'));
                return items.map(item => {
                    const data = {
                        label: item.querySelector('[name*="[label]"]').value,
                        route: item.querySelector('[name*="[route]"]').value,
                        icon: item.querySelector('[name*="[icon]"]').value,
                        visible: item.querySelector('[name*="[visible]"][type="checkbox"]').checked ? 1 : 0,
                        rbac_permission: item.querySelector('[name*="[rbac_permission]"]').value,
                        children: []
                    };
                    const childContainer = item.querySelector('.child-container');
                    if (childContainer) {
                        data.children = serializeMenu(childContainer);
                    }
                    return data;
                });
            }
            
            document.getElementById('save-structure-btn').addEventListener('click', function(e) {
            let valid = true;
                document.querySelectorAll('[name*="[label]"]').forEach(input => {
                    input.classList.remove('is-invalid');
                if (!input.value.trim()) {
                    valid = false;
                    input.classList.add('is-invalid');
                }
            });
                if (!valid) {
                    alert('Please fill all required menu label fields.');
                    return;
                }
                const menuData = serializeMenu(menuContainer);
                const form = document.getElementById('menu-form');
                const url = form.action;
                const csrfParam = yii.getCsrfParam();
                const csrfToken = form.querySelector(`[name="${csrfParam}"]`).value;
                const saveButton = e.target;
                const originalButtonText = saveButton.innerHTML;
                saveButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
                saveButton.disabled = true;

                fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrfToken },
                    body: JSON.stringify({ AdminMenu: menuData })
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        alert('Menu saved successfully!');
                        window.location.href = '<?= yii\helpers\Url::to(['index']) ?>';
                    } else {
                        alert('Error saving menu: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please check the console for details.');
                })
                .finally(() => {
                    saveButton.innerHTML = originalButtonText;
                    saveButton.disabled = false;
                });
            });
            
            function initializeIconSelectors() {
                document.querySelectorAll('.icon-select:not(.choices-initialized)').forEach(select => {
                    const initialValue = select.getAttribute('data-initial-value');
                    const choices = new Choices(select, {
                        searchEnabled: true,
                        itemSelectText: '',
                        allowHTML: true,
                        choices: iconList,
                        classNames: {
                            containerOuter: 'choices',
                            containerInner: 'choices__inner',
                            input: 'choices__input',
                            inputCloned: 'choices__input--cloned',
                            list: 'choices__list',
                            listItems: 'choices__list--multiple',
                            listSingle: 'choices__list--single',
                            listDropdown: 'choices__list--dropdown',
                            item: 'choices__item',
                            itemSelectable: 'choices__item--selectable',
                            itemDisabled: 'choices__item--disabled',
                            itemChoice: 'choices__item--choice',
                            placeholder: 'choices__placeholder',
                            group: 'choices__group',
                            groupHeading: 'choices__heading',
                            button: 'choices__button',
                            activeState: 'is-active',
                            focusState: 'is-focused',
                            openState: 'is-open',
                            disabledState: 'is-disabled',
                            highlightedState: 'is-highlighted',
                            selectedState: 'is-selected',
                            flippedState: 'is-flipped',
                            loadingState: 'is-loading',
                            noResults: 'has-no-results',
                            noChoices: 'has-no-choices'
                        },
                        callbackOnCreateTemplates: function (template) {
                            return {
                                item: (classNames, data) => {
                                    return template(`
                                        <div class="${classNames.item} ${data.highlighted ? classNames.highlightedState : ''} ${data.selected ? classNames.selectedState : ''} ${data.disabled ? classNames.disabledState : ''}" data-item data-id="${data.id}" data-value="${data.value}" ${data.active ? 'aria-selected="true"' : ''} ${data.disabled ? 'aria-disabled="true"' : ''}>
                                            <i class="${data.value} me-2"></i> ${data.label}
                                        </div>
                                    `);
                                },
                                choice: (classNames, data) => {
                                    return template(`
                                        <div class="${classNames.item} ${classNames.itemChoice} ${data.disabled ? classNames.itemDisabled : classNames.itemSelectable}" data-select-text="${this.config.itemSelectText}" data-choice ${data.disabled ? 'data-choice-disabled aria-disabled="true"' : 'data-choice-selectable'} data-id="${data.id}" data-value="${data.value}" ${data.groupId > 0 ? 'role="treeitem"' : 'role="option"'}>
                                            <div class="d-flex align-items-center p-3">
                                                <i class="${data.value} me-3 fs-3"></i>
                                                <div>
                                                    ${data.label}
                                                    <small class="d-block text-muted">${data.customProperties.family}</small>
                                                </div>
                                            </div>
                                        </div>
                                    `);
                                }
                            };
                        }
                    });
                    if (initialValue) {
                        choices.setChoiceByValue(initialValue);
                    }
                    select.classList.add('choices-initialized');
                });
            }

            // Initial calls
            initSortableContainers();
            initializeIconSelectors();
        });
    </script>