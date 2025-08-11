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
use sahmed237\yii2admintheme\assets\AdminThemeAsset;
use sahmed237\yii2admintheme\models\Notification;
use yii\helpers\Url;

class NotificationDropdownWidget extends Widget
{
    public $limit = 5;

    public $markAsReadUrl;
    public $fetchLatestUrl;

    /**
     * @var string The internal route used to mark a notification as read.
     * This route will be used to generate the URL when a user clicks on a notification.
     * Can be overridden in the module configuration to suit custom controller paths.
     */
    public $notificationMarkReadRoute = 'notification/mark-read';

    /**
     * @var string The internal route used to fetch the latest notifications via AJAX.
     * This is typically used for polling new notifications in real time.
     * Can be customized by overriding it in the module configuration.
     */
    public $notificationFetchLatestRoute = 'notification/fetch-latest';

    public function run()
    {

        $userId = Yii::$app->user->id;
        if (!$userId) {
            return '';
        }

        $notifications = Notification::find()
            ->where(['user_id' => $userId, 'is_read' => 0])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit($this->limit)
            ->all();
        $this->registerAssets($notifications);

        return Html::tag('div',
            Html::button(
                $this->renderBellIcon($notifications),
                [
                    'type' => 'button',
                    'class' => 'btn btn-icon btn-topbar btn-ghost-secondary rounded-circle',
                    'data-bs-toggle' => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false'
                ]
            ) . $this->renderDropdown($notifications),
            ['class' => 'dropdown ms-sm-3']
        );
    }

    protected function renderBellIcon($notifications)
    {
        $unreadCount = count($notifications);
        return '<i id="notification-bell-icon" class="bx bx-bell fs-22 "></i>' .
            ($unreadCount ? Html::tag('span', $unreadCount, ['class' => 'badge bg-danger rounded-circle position-absolute topbar-badge']) : '');
    }

    protected function renderDropdown($notifications)
    {
        $items = Html::tag('h6', 'Notifications', ['class' => 'dropdown-header']);

        foreach ($notifications as $notification) {
            $items .= Html::a(
                '<div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <div class="avatar-xs bg-primary rounded-circle text-white d-flex align-items-center justify-content-center">
                            <i class="' . Html::encode($notification->icon) . '"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <h6 class="mt-0 mb-1">' . Html::encode($notification->title) . '</h6>
                        <div class="fs-12 text-muted">
                            ' . Html::encode($notification->message) . '<br>
                            <small class="text-muted">' . Yii::$app->formatter->asRelativeTime($notification->created_at) . '</small>
                        </div>
                    </div>
                </div>',
                'javascript:void(0)', // prevent native navigation
                [
                    'class' => 'dropdown-item notification-item',
                    'data-id' => $notification->id,
                    'data-url' => $notification->url ?? '#',
                ]
            );
        }

        if (empty($notifications)) {
            $items .= Html::tag('div', 'No new notifications', ['class' => 'dropdown-item text-muted']);
        }

        return Html::tag('div', $items, ['class' => 'dropdown-menu dropdown-menu-end p-0', 'style' => 'min-width: 300px;']);
    }

    protected function registerAssets($notifications)
    {
        $readUrl = $this->markAsReadUrl ?: Url::to(['/' . Yii::$app->params['adminThemeModuleName'] . '/' . $this->notificationMarkReadRoute  ?? 'yii2admintheme/notificaton/mark-read']);

        $latestUrl = $this->fetchLatestUrl ?: Url::to(['/' . Yii::$app->params['adminThemeModuleName'] . '/' . $this->notificationFetchLatestRoute ?? '/yii2admintheme/notification/fetch-latest']);

        $view = $this->getView();
        AdminThemeAsset::register($view);

        $defaultSoundPath = Yii::$app->assetManager->getPublishedUrl('@vendor/sahmed237/yii2-admin-theme/src/assets') . '/sound/notification-1.mp3';

        $notificationSound = Yii::$app->params['adminThemeNotificationSound'] ?? $defaultSoundPath;
        $notificationPoolingInterval = Yii::$app->params['notificationPoolingInterval'] ?? 30000;


        $initialcount = count($notifications);
        $js = <<<JS
            let notificationSound = new Audio("{$notificationSound}");
            let lastNotificationIds = [];
            
            // Check if sound was previously enabled
            let soundEnabled = localStorage.getItem('soundEnabled') === 'true';
            
            // If not yet enabled, wait for the first user interaction to unlock sound
            if (!soundEnabled) {
                document.body.addEventListener('click', function enableSoundOnce() {
                    notificationSound.play().then(() => {
                        soundEnabled = true;
                        localStorage.setItem('soundEnabled', 'true'); // Persist the preference
                    }).catch(() => {});
                    document.body.removeEventListener('click', enableSoundOnce);
                });
            }
        
            // Visual bell icon blink
            function startBellBlink() {
                setTimeout(() => {
                    const bell = document.getElementById('notification-bell-icon');
                    if (bell) {
                        bell.classList.add('blinking');
                    }
                }, 3000);
            }
        
            function stopBellBlink() {
                const bellIcon = document.querySelector('#notification-bell-icon');
                if (bellIcon) {
                    bellIcon.classList.remove('blinking');
                }
            }
        
            // Mark as read and redirect on click
            document.body.addEventListener('click', function (e) {
                const item = e.target.closest('.notification-item');
                if (item) {
                    // Debug
                    // alert('notification item clicked')
                    const id = item.dataset.id;
                    const url = item.dataset.url;
        
                    fetch('{$readUrl}?id=' + id, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-Token': yii.getCsrfToken(),
                        }
                    }).then(() => {
                        stopBellBlink(); // Optional: stop blink when any notification is opened
                        if (url && url !== 'javascript:void(0)') {
                            window.location.href = url;
                        }
                    });
                }
            });
           

            // Poll every 10s for latest notifications
            setInterval(() => {
                fetch('{$latestUrl}')
                    .then(response => response.text())
                    .then(html => {
                        const container = document.querySelector('#notification-widget');
                        if (container) {
                            const tempDiv = document.createElement('div');
                            tempDiv.innerHTML = html;
                            const newItems = tempDiv.querySelectorAll('.notification-item');
                            const newIds = Array.from(newItems).map(item => item.dataset.id);
        
                            const isNewNotification = newIds.some(id => !lastNotificationIds.includes(id));
                            if (isNewNotification && newItems.length > '{$initialcount }') {
                                startBellBlink();
                                if (soundEnabled) {
                                    notificationSound.play().catch(() => {});
                                }
                            }
        
                            container.innerHTML = html;
                            lastNotificationIds = newIds;
                        }
                    });
            }, `{$notificationPoolingInterval}`);
        JS;

        $view->registerJs($js);

    }


}
