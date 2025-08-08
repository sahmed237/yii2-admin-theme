<?php

namespace sahmed237\yii2admintheme\helpers;

use Yii;
use sahmed237\yii2admintheme\models\AdminThemeSetting;

class ThemeHelper
{
    /**
     * Fetches theme settings and generates a dynamic CSS block to override default theme variables.
     * Caches the result for performance.
     *
     * @return string The generated CSS.
     */
    public static function getDynamicCss()
    {
        $cache = Yii::$app->cache;
        $cacheKey = 'theme-dynamic-css';
        $css = $cache->get($cacheKey);

        if ($css === false) {
            $settings = AdminThemeSetting::find()->indexBy('key')->all();
            
            $primaryColor = $settings['primary_color']->value ?? null;
            $primaryHover = $settings['primary_color_hover']->value ?? null;

            $secondaryColor = $settings['secondary_color']->value ?? null;
            $secondaryHover = $settings['secondary_color_hover']->value ?? null;

            $warningColor = $settings['warning_color']->value ?? null;
            $warningHover = $settings['warning_color_hover']->value ?? null;

            $infoColor = $settings['info_color']->value ?? null;
            $infoHover = $settings['info_color_hover']->value ?? null;

            $dangerColor = $settings['danger_color']->value ?? null;
            $dangerHover = $settings['danger_color_hover']->value ?? null;

                        $css = '<style>';
            $css .= ':root {';

            // Base colors
            self::addColorCss($css, 'primary', $primaryColor);
            self::addColorCss($css, 'success', $secondaryColor);
            self::addColorCss($css, 'warning', $warningColor);
            self::addColorCss($css, 'info', $infoColor);
            self::addColorCss($css, 'danger', $dangerColor);

            // Hover colors
            if ($primaryHover) {
                $css .= '--vz-primary-text-emphasis: ' . $primaryHover . ';';
                $rgb = self::hexToRgb($primaryHover);
                if ($rgb) {
                    $css .= '--vz-primary-text-emphasis-rgb: ' . $rgb . ';';
                }
            }

            if ($secondaryColor) {
                $css .= '--vz-secondary-text-emphasis: ' . $secondaryColor . ';';
                $rgb = self::hexToRgb($secondaryColor);
                if ($rgb) {
                    $css .= '--vz-secondary-text-emphasis-rgb: ' . $rgb . ';';
                }
            }

            if ($warningColor) {
                $css .= '--vz-warning-text-emphasis: ' . $warningColor . ';';
                $rgb = self::hexToRgb($warningColor);
                if ($rgb) {
                    $css .= '--vz-warning-text-emphasis-rgb: ' . $rgb . ';';
                }
            }

            if ($infoColor) {
                $css .= '--vz-info-text-emphasis: ' . $infoColor . ';';
                $rgb = self::hexToRgb($infoColor);
                if ($rgb) {
                    $css .= '--vz-info-text-emphasis-rgb: ' . $rgb . ';';
                }
            }

            if ($dangerColor) {
                $css .= '--vz-danger-text-emphasis: ' . $dangerColor . ';';
                $rgb = self::hexToRgb($dangerColor);
                if ($rgb) {
                    $css .= '--vz-danger-text-emphasis-rgb: ' . $rgb . ';';
                }
            }
            
            $css .= '}';
            $css .= '</style>';
            
            // Cache the CSS for 1 hour. It should be invalidated when settings are saved.
            $cache->set($cacheKey, $css, 3600);
        }

        return $css;
    }

    /**
     * Adds a color variable and its RGB equivalent to the CSS string.
     * @param string &$css The CSS string to append to.
     * @param string $name The name of the color variable (e.g., 'primary').
     * @param string|null $hex The hex color value.
     */
    protected static function addColorCss(&$css, $name, $hex)
    {
        if ($hex) {
            $rgb = self::hexToRgb($hex);
            $css .= '--vz-' . $name . ': ' . $hex . ';';
            if ($rgb) {
                $css .= '--vz-' . $name . '-rgb: ' . $rgb . ';';
            }
        }
    }

    /**
     * Converts a hex color code to an "r, g, b" string.
     * @param string $hex The hex color string (e.g., "#RRGGBB").
     * @return string|null The "r, g, b" string or null if invalid.
     */
    protected static function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } elseif (strlen($hex) == 6) {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        } else {
            return null;
        }
        return "$r, $g, $b";
    }
} 