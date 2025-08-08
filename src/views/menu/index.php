<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Menus';
$this->params['breadcrumbs'][] = $this->title;

// Helper function to recursively render the menu
function renderMenu($items, $level = 0) {
    if (empty($items)) {
        return '';
    }

    $listClass = ($level === 0) ? 'list-group' : 'list-group mt-2';
    $html = Html::beginTag('ul', ['class' => $listClass, 'style' => 'margin-left:' . ($level * 20) . 'px;']);

    foreach ($items as $item) {
        $html .= Html::beginTag('li', ['class' => 'list-group-item d-flex justify-content-between align-items-center']);
        
        // Menu item details
        $icon = !empty($item['icon']) ? Html::tag('i', '', ['class' => $item['icon'] . ' me-2']) : '';
        $visibility = $item['visible'] ? '' : Html::tag('span', ' (Hidden)', ['class' => 'text-muted']);
        $html .= Html::tag('div', $icon . Html::encode($item['label']) . $visibility . ' ' . Html::tag('small', Html::encode($item['route']), ['class' => 'text-muted']));
        

        
        $html .= Html::endTag('li');

        // Render children
        if (!empty($item['children'])) {
            $html .= renderMenu($item['children'], $level + 1);
        }
    }

    $html .= Html::endTag('ul');
    return $html;
}
?>

<div class="admin-menu-index">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
            <div>
                <?= Html::a('<i class="fas fa-edit me-2"></i>Manage Menu', ['manage'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="card-body">
            <?php if (empty($menuTree)): ?>
                <p>No menu items found. <?= Html::a('Create one now', ['manage']) ?>.</p>
            <?php else: ?>
                <?= renderMenu($menuTree) ?>
            <?php endif; ?>
        </div>
    </div>
</div>