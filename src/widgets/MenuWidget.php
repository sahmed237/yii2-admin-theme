<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use sahmed237\yii2admintheme\models\AdminMenu;

class MenuWidget extends Widget
{
    public $options = [];
    public $theme = 'bootstrap5';
    public $badgeCallback;

    public function init()
    {
        parent::init();

        // Support badgeCallback via Yii::$app->params['menuBadgeCallback']
        if ($this->badgeCallback === null) {
            $this->badgeCallback = Yii::$app->params['menuBadgeCallback'] ?? null;
        }
    }

    public function run()
    {
        $menus = AdminMenu::getVisibleRootMenus();
        return Html::tag('ul', $this->renderMenuItems($menus), ['class' => 'navbar-nav', 'id' => 'navbar-nav']);
    }

    /**
     * Recursively renders menu items and their children.
     * @param AdminMenu[] $items The menu items to render.
     * @return string The rendered HTML.
     */
    protected function renderMenuItems($items, $isChild = false)
    {
        $html = '';
        foreach ($items as $item) {
            if ($item->rbac_permission && !Yii::$app->user->can($item->rbac_permission)) {
                continue;
            }

            $children = $item->children;
            $hasChildren = !empty($children);

            // Build icon
            $iconHtml = $item->icon ? '<i class="' . Html::encode($item->icon) . '"></i>' : ($isChild ? '<i class="ri-subtract-line"></i>' : '<i class="ri-circle-line"></i>');

            // Badge if applicable
            $badge = $this->getBadgeContent($item);
            $label = '<span>' . Html::encode($item->label) . '</span>' . $badge;

            // Menu item link options
            $linkOptions = ['class' => 'nav-link menu-link'];
            if ($isChild && !$hasChildren) {
                Html::removeCssClass($linkOptions, 'menu-link');
            }
            if (!$hasChildren && !$isChild) {
                Html::addCssClass($linkOptions, 'no-children');
            }

            if ($hasChildren) {
                $collapseId = $item->collapseId;
                $linkOptions['data-bs-toggle'] = 'collapse';
                $linkOptions['role'] = 'button';
                $linkOptions['aria-expanded'] = 'false';
                $linkOptions['aria-controls'] = $collapseId;
                $url = '#' . $collapseId;

                $html .= '<li class="nav-item">';
                $html .= Html::a($iconHtml . $label, $url, $linkOptions);
                $html .= '<div class="menu-dropdown collapse" id="' . $collapseId . '">';
                $html .= '<ul class="nav nav-sm flex-column">';
                $html .= $this->renderMenuItems($children, true);
                $html .= '</ul></div></li>';
            } else {
                $url = $item->route ? Url::to([$item->route]) : '#';
                $html .= '<li class="nav-item">';
                $html .= Html::a($iconHtml . $label, $url, $linkOptions);
                $html .= '</li>';
            }
        }
        return $html;
    }

    protected function getBadgeContent($item)
    {
        if (is_callable($this->badgeCallback)) {
            $badgeData = call_user_func($this->badgeCallback, $item);

            // Support numeric or array like: ['count' => 5, 'class' => 'bg-success']
            if (is_array($badgeData)) {
                $count = $badgeData['count'] ?? 0;
                $class = $badgeData['class'] ?? 'bg-danger';
            } else {
                $count = $badgeData;
                $class = 'bg-danger';
            }

            if ($count > 0) {
                return Html::tag('span', $count, ['class' => 'badge badge-pill ' . $class, 'style' => 'margin-left:5px']);
            }
        }
        return '';
    }
}
