<?php

namespace sahmed237\yii2admintheme\controllers;

use Yii;
use yii\web\Controller;
use sahmed237\yii2admintheme\models\AdminThemeSetting;
use yii\web\UploadedFile;

class SettingController extends Controller
{



    public function actionIndex()
    {
        // Sidebar navigation items
        $this->view->params['sidebar'] = [
            ['label' => 'Appearance', 'url' => '#appearance-settings'],
            ['label' => 'Layout', 'url' => '#layout-settings'],
            ['label' => 'Typography', 'url' => '#typography-settings'],
            ['label' => 'Branding', 'url' => '#branding-settings'],
        ];

        // Load all settings into a key-indexed array
        $settings = AdminThemeSetting::find()->indexBy('key')->all();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post('Settings');
            $transaction = Yii::$app->db->beginTransaction();

            try {
                // Save text and array inputs
                if ($postData) {
                    foreach ($postData as $key => $value) {
                        $setting = AdminThemeSetting::findOne(['key' => $key]) ?? new AdminThemeSetting(['key' => $key]);
                        $setting->value = is_array($value) ? json_encode($value) : $value;
                        if (!$setting->save()) {
                            throw new \Exception("Failed to save '$key': " . implode(', ', $setting->getFirstErrors()));
                        }
                    }
                }

                // Handle image uploads
                $imageKeys = ['logo_light_lg', 'logo_light_sm', 'logo_dark_lg', 'logo_dark_sm'];

                foreach ($imageKeys as $imageKey) {
                    $uploadedFile = UploadedFile::getInstanceByName("Settings[$imageKey]");
                    if ($uploadedFile) {
                        $fileName = uniqid($imageKey . '_') . '.' . $uploadedFile->extension;
                        $uploadDir = Yii::getAlias('@webroot/uploads/theme/');
                        $uploadPath = $uploadDir . $fileName;
                        $webPath = '/uploads/theme/' . $fileName;

                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0775, true);
                        }

                        // Delete old file if it exists
                        $existingSetting = AdminThemeSetting::findOne(['key' => $imageKey]);
                        if ($existingSetting && !empty($existingSetting->value)) {
                            $oldFilePath = Yii::getAlias('@webroot') . $existingSetting->value;
                            if (is_file($oldFilePath)) {
                                @unlink($oldFilePath);
                            }
                        }

                        if ($uploadedFile->saveAs($uploadPath)) {
                            $setting = $existingSetting ?? new AdminThemeSetting(['key' => $imageKey]);
                            $setting->value = $webPath;
                            if (!$setting->save()) {
                                throw new \Exception("Failed to save image setting '$imageKey': " . implode(', ', $setting->getFirstErrors()));
                            }
                        }
                    }
                }

                // Handle favicon upload (stored directly in @webroot)
                $favIconKey = 'fav_icon';
                $uploadedFavicon = UploadedFile::getInstanceByName("Settings[$favIconKey]");
                if ($uploadedFavicon) {
                    // Validate file type and extension
                    if (!in_array(strtolower($uploadedFavicon->extension), ['ico', 'png'])) {
                        throw new \Exception("Favicon must be a .ico or .png file.");
                    }

                    $fileName = 'favicon_' . time() . '.' . $uploadedFavicon->extension;
                    $uploadDir = Yii::getAlias('@webroot');  // Save directly to public root
                    $uploadPath = $uploadDir . '/' . $fileName;
                    $webPath = '/' . $fileName;

                    // Remove old file if it exists
                    $existingFavicon = AdminThemeSetting::findOne(['key' => $favIconKey]);
                    if ($existingFavicon && !empty($existingFavicon->value)) {
                        $oldPath = Yii::getAlias('@webroot') . $existingFavicon->value;
                        if (is_file($oldPath)) {
                            @unlink($oldPath);
                        }
                    }

                    if ($uploadedFavicon->saveAs($uploadPath)) {
                        $setting = $existingFavicon ?? new AdminThemeSetting(['key' => $favIconKey]);
                        $setting->value = $webPath;
                        if (!$setting->save()) {
                            throw new \Exception("Failed to save favicon setting '$favIconKey': " . implode(', ', $setting->getFirstErrors()));
                        }
                    }
                }


                Yii::$app->cache->delete('theme-dynamic-css');
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'Theme settings have been saved.');
                return $this->refresh();

            } catch (\Throwable $e) {
                $transaction->rollBack();
                Yii::error($e->getMessage(), __METHOD__);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('index', [
            'settings' => $settings,
        ]);
    }


} 