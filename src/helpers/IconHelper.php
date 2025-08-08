<?php
namespace sahmed237\yii2admintheme\helpers;

use Yii;
use yii\helpers\Json;

class IconHelper
{
    /**
     * Get a list of Remix Icons.
     *
     * @return array
     */
    public static function getIconList()
    {
        return Yii::$app->cache->getOrSet('remix_icon_list_v2', function () {
            $icons = self::getRemixIcons();
            
            // Sort alphabetically by label
            usort($icons, function($a, $b) {
                return strcmp($a['label'], $b['label']);
            });
            
            return $icons;
        }, 3600); // Cache for 1 hour
    }

    /**
     * Scans the theme's assets for RemixIcon CSS and parses icon classes.
     *
     * @return array
     */
    private static function getRemixIcons()
    {
        $icons = [];
        $cssPath = Yii::getAlias('@vendor/sahmed237/yii2-admin-theme/src/assets/css');
        $file = $cssPath . '/icons.css';

        if (file_exists($file)) {
            $content = file_get_contents($file);
            // Updated regex to ONLY capture RemixIcon classes (ri-...)
            preg_match_all('/\.((ri)-[a-zA-Z0-9\._-]+):before/', $content, $matches, PREG_SET_ORDER);
            
            if (!empty($matches)) {
                foreach ($matches as $match) {
                    $fullClass = $match[1];
                    $familyName = 'Remix Icon';
                    if (strpos($fullClass, '-fill') !== false) {
                        $familyName .= ' (Fill)';
                    } elseif (strpos($fullClass, '-line') !== false) {
                        $familyName .= ' (Line)';
                    }

                    $icons[] = [
                        'value' => $fullClass,
                        'label' => self::formatLabel($fullClass),
                        'customProperties' => [
                            'icon' => $fullClass,
                            'family' => $familyName
                        ],
                    ];
                }
            }
        }
        
        return $icons;
    }

    /**
     * Formats a raw CSS class into a clean, human-readable label.
     * e.g., "ri-dashboard-2-fill" becomes "Dashboard 2 Fill"
     *
     * @param string $class
     * @return string
     */
    private static function formatLabel($class)
    {
        // Remove "ri-" prefix for a cleaner label
        $class = preg_replace('/^(ri)-/', '', $class);
        return ucwords(str_replace('-', ' ', $class));
    }
} 