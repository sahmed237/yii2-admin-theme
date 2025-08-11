<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace sahmed237\yii2admintheme\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use sahmed237\yii2admintheme\models\AdminMenu;
use sahmed237\yii2admintheme\helpers\IconHelper;
use sahmed237\yii2admintheme\Module;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class MenuController extends Controller
{
    public function behaviors()
    {
        /** @var Module $module */
        $module = Module::getInstance();

        // Determine access role(s) based on module configuration
        $roles = $module && $module->permissionRule ? [$module->permissionRule] : ['@'];

        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $roles,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $allMenuItems = AdminMenu::find()->orderBy(['parent_id' => SORT_ASC, 'order' => SORT_ASC])->asArray()->all();
        $menuTree = $this->buildTree($allMenuItems);

        return $this->render('index', [
            'menuTree' => $menuTree,
        ]);
    }

    private function buildTree(array $elements, $parentId = null) {
        $branch = [];
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }


    public function actionManage()
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            // Use raw body for JSON
            $request = Yii::$app->getRequest();
            $data = json_decode($request->getRawBody(), true);
            $menuItems = $data['AdminMenu'] ?? [];

            $transaction = Yii::$app->db->beginTransaction();
            try {
                // Truncate the table to remove all existing menu items.
                Yii::$app->db->createCommand()->truncateTable('admin_menu')->execute();


                $this->saveMenuItems($menuItems);

                $transaction->commit();
                return ['success' => true];
            } catch (\Exception $e) {
                $transaction->rollBack();
                return ['success' => false, 'message' => $e->getMessage()];
            }
        }

        // Load existing menu structure
        $rootItems = AdminMenu::find()
            ->where(['parent_id' => null])
            ->orderBy(['order' => SORT_ASC])
            ->all();

        return $this->render('manage', [
            'rootItems' => $rootItems ?? [],
            'iconList' => IconHelper::getIconList(),
        ]);
    }

    private function saveMenuItems($items, $parentId = null)
    {
        foreach ($items as $order => $itemData) {
            $model = new AdminMenu();
            
            // Manually assign attributes
            $model->parent_id = $parentId;
            $model->order = $order;
            $model->label = $itemData['label'];
            $model->route = $itemData['route'];
            $model->icon = $itemData['icon'];
            $model->visible = $itemData['visible'];
            $model->rbac_permission = $itemData['rbac_permission'] ?? null;
            
            if (!$model->save()) {
                // Collect validation errors for a more informative message
                $errors = $model->getFirstErrors();
                throw new \Exception('Failed to save menu item: ' . reset($errors));
            }

            if (!empty($itemData['children'])) {
                $this->saveMenuItems($itemData['children'], $model->id);
            }
        }
    }

    public function actionAddMenuItem($parentId = null, $index = 0)
    {
        $model = new AdminMenu(['parent_id' => $parentId]);
        return $this->renderAjax('_menu_item', [
            'model' => $model,
            'index' => $index,
            'parentId' => $parentId,
            'isChild' => $parentId !== null,
            'iconList' => IconHelper::getIconList(),
        ]);
    }

    protected function findModel($id)
    {
        if (($model = AdminMenu::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested menu item does not exist.');
    }
}