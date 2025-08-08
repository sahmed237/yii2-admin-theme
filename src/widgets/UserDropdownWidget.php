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

class UserDropdownWidget extends Widget
{
    public function run()
    {
        $user = Yii::$app->user->identity;

        // Comment out and uncomment user debug for testing if user managment is not configured
        if (!$user) {
            return '';
        }
        // User debug
        /*
        $user = Yii::$app->user->identity ?? (object)[
            'name' => 'Guest',
            'created_at' => time()
        ];
        */
        return Html::tag('div',
            Html::button(
                $this->renderButton($user),
                [
                    'type' => 'button',
                    'class' => 'btn',
                    'id' => 'page-header-user-dropdown',
                    'data-bs-toggle' => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false'
                ]
            ) .
            $this->renderDropdown(),
            ['class' => 'dropdown ms-sm-3 header-item topbar-user']
        );
    }

    protected function renderButton($user)
    {
        $userImagePath = Yii::$app->params['userImagePath'] ?? self::getAssetDir().'/images/user-dummy.jpg';


        $avatar = Html::img($userImagePath, [
            'class' => 'rounded-circle header-profile-user',
            'alt' => 'Header Avatar'
        ]);


        return Html::tag('span',
            $avatar .
            Html::tag('span',
                Html::tag('span', Html::encode($user->username), ['class' => 'd-none d-xl-inline-block ms-1 fw-medium user-name-text']) .
                Html::tag('span',
                    Html::tag('small', 'User since ' . date('D M Y', $user->created_at), ['class' => 'user-name-sub-text']),
                    ['class' => 'd-none d-xl-block ms-1 fs-12']
                ),
                ['class' => 'text-start ms-xl-2']
            ),
            ['class' => 'd-flex align-items-center']
        );
    }

    protected function renderDropdown()
    {
        return Html::tag('div',
            $this->renderMenuItems(),
            ['class' => 'dropdown-menu dropdown-menu-end']
        );
    }

    protected function renderMenuItems()
    {
        $menuItems = Yii::$app->params['userMenuItems'] ?? [];
        $html = [];

        foreach ($menuItems as $item) {
            if (isset($item['divider']) && $item['divider']) {
                $html[] = '<div class="dropdown-divider"></div>';
                continue;
            }

            $icon = isset($item['icon']) ? '<i class="' . Html::encode($item['icon']) . ' text-muted fs-16 align-middle me-1"></i> ' : '';
            $label = $icon . '<span class="align-middle">' . Html::encode($item['label']) . '</span>';

            $html[] = Html::a(
                $label,
                $item['url'] ?? '#',
                array_merge(['class' => 'dropdown-item'], $item['options'] ?? [])
            );
        }

        return implode("\n", $html);
    }

    private function getAssetDir()
    {
        return  \Yii::$app->assetManager->getPublishedUrl('@vendor/sahmed237/yii2-admin-theme/src/assets');
    }

}
