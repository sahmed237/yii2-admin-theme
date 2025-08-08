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

class SearchWidget extends Widget
{
    public $searchUrl;

    public function run()
    {
        $this->registerAssets();

        return Html::tag('form', $this->renderInput() . $this->renderDropdown(), [
            'class' => 'app-search d-none d-md-block',
        ]);
    }

    protected function renderInput()
    {
        return Html::tag('div',
            Html::input('text', null, '', [
                'class' => 'form-control',
                'placeholder' => 'Search...',
                'autocomplete' => 'off',
                'id' => 'search-options'
            ]) .
            Html::tag('span', '', ['class' => 'mdi mdi-magnify search-widget-icon']) .
            Html::tag('span', '', [
                'class' => 'mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none',
                'id' => 'search-close-options'
            ]),
            ['class' => 'position-relative']
        );
    }

    protected function renderDropdown()
    {
        return Html::tag('div',
            Html::tag('div', '', [
                'id' => 'search-results-wrapper',
                'data-simplebar' => true,
                'style' => 'max-height: 320px;',
            ]) .
            Html::tag('div',
                Html::a('View All Results <i class="ri-arrow-right-line ms-1"></i>', ['pages-search-results'], [
                    'class' => 'btn btn-primary btn-sm d-none',
                ]),
                ['class' => 'text-center pt-3 pb-1']
            ),
            ['class' => 'dropdown-menu dropdown-menu-lg', 'id' => 'search-dropdown']
        );
    }

    protected function registerAssets()
    {
        $url = $this->searchUrl ?: Url::to([Yii::$app->params['searchRoute'] ?? '#']);

        $js = <<<JS
        let timer;
        const input = $('#search-options');
        const dropdown = $('#search-dropdown');
        const resultWrapper = $('#search-results-wrapper');

        input.on('input', function () {
            const query = $(this).val();
            if (query.length < 2) return dropdown.removeClass('show');

            clearTimeout(timer);
            timer = setTimeout(() => {
               $.get('$url', { term: query }, function (res) {
                dropdown.addClass('show');
                resultWrapper.empty();
                if (!res.results || res.results.length === 0) {
                    resultWrapper.append('<div class="dropdown-item text-muted">No results found!</div>');
                } else {
                    res.results.forEach(item => {
                        resultWrapper.append(`
                            <a href="\${item.url}" class="dropdown-item notify-item">
                                <i class="\${item.icon} align-middle text-primary me-2"></i>
                                <div class="d-inline-block">
                                    <div class="fw-semibold">\${item.title}</div>
                                    <small class="text-muted">\${item.description}</small>
                                </div>
                            </a>
                        `);
                    });
                }
            });

            }, 300);
        });

        $('#search-close-options').on('click', function () {
            input.val('');
            dropdown.removeClass('show');
        });
        JS;

        Yii::$app->view->registerJs($js);
    }
}
