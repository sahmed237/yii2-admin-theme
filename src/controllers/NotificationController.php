<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\controllers;


use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use sahmed237\yii2admintheme\models\Notification;

class NotificationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'mark-read' => ['POST'],
                ],
            ],
        ];
    }

    public function actionMarkRead($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $notification = Notification::findOne(['id' => $id, 'user_id' => Yii::$app->user->id]);
        if ($notification) {
            $notification->is_read = true;
            $notification->save(false);
        }
        return ['success' => true];
    }

    public function actionFetchLatest()
    {
        return \sahmed237\yii2admintheme\widgets\NotificationDropdownWidget::widget();
    }
}
