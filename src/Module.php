<?php
namespace sahmed237\yii2admintheme;

use yii\base\Module as BaseModule;

class Module extends BaseModule
{
    public $controllerNamespace = 'sahmed237\\yii2admintheme\\controllers';

    /**
     * @var string|null The RBAC permission name required to access the menu management and theme settings.
     * Only users with this permission (e.g., 'admin' or 'superAdmin') will be allowed to access related module features.
     * Set to `null` to disable permission checks and allow all authenticated users.
     */
    public $permissionRule;



    public function init()
    {
        parent::init();

        $this->controllerMap = [
            'menu' => 'sahmed237\yii2admintheme\controllers\MenuController',
        ];
    }
} 