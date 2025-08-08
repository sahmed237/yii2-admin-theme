<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\components;


use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use sahmed237\yii2admintheme\models\Notification;

/**
 * NotificationComponent
 *
 * Provides helper methods to create and push new notifications.
 *
 * Example usage:
 * ```php
 * Yii::$app->notification->push([
 *     'user_id' => 1,
 *     'title' => 'New message',
 *     'mesage' => 'You have received a new message from John.',
 *     'url' => '/messages/view/1',
 *     'category' => 'info',
 *     'icon' => 'bx bx-envelope',
 * ]);
 * ```
 */
class NotificationComponent extends Component
{
    /**
     * @var string|null Class name of the notification model (optional override)
     */
    public $modelClass = Notification::class;

    /**
     * Push a new notification to the database.
     *
     * @param array $data Array containing the notification fields:
     *   - `user_id` (int)       The user to notify (required)
     *   - `title` (string)      Title or short message (required)
     *   - `message` (string)    message body (required)
     *   - `url` (string|null)   Optional URL to redirect when clicked
     *   - `icon` (string|null)   Optional Icon for the notification item
     *   - `category` (string)       category (e.g., "info", "warning", "success") (required)
     *
     * @return bool Whether the notification was saved successfully.
     */
    /**
     * Push a new notification to the database.
     *
     * @param array $data Array containing notification fields:
     *  - `user_id` (int)       The user to notify (required)
     *  - `title` (string)      Notification title (required)
     *  - `message` (string)    Notification message (required)
     *  - `url` (string|null)   Optional URL to visit
     *  - `category` (string)   Notification type/category (default: 'info')
     *  - `icon` (string)       Icon class for display (default: 'bx bx-envelope')
     *
     * @return array Returns an array with `success` (bool), and optionally `error` or `errors`
     */
    public function push(array $data): array
    {
        $class = $this->modelClass;

        if (!class_exists($class)) {
            return [
                'success' => false,
                'error' => "Notification model class '{$class}' does not exist."
            ];
        }

        /** @var Notification $notification */
        $notification = new $class();
        $notification->user_id = $data['user_id'] ?? null;
        $notification->title = $data['title'] ?? null;
        $notification->message = $data['message'] ?? null;
        $notification->url = $data['url'] ?? null;
        $notification->category = $data['category'] ?? 'info';
        $notification->icon = $data['icon'] ?? 'bx bx-envelope';
        $notification->is_read = 0;
        $notification->created_at = time();

        // Check required fields
        if (!$notification->user_id || !$notification->title || !$notification->message || !$notification->category) {
            return [
                'success' => false,
                'error' => 'Missing one or more required fields: user_id, title, message, or category.'
            ];
        }

        if ($notification->save()) {
            return ['success' => true];
        }

        return [
            'success' => false,
            'errors' => $notification->getErrors(),
        ];
    }

}
