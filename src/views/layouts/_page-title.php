<?php

use yii\bootstrap5\Breadcrumbs;

?>
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?= ($title) ? $title : '' ?></h4>
            <?=
            Breadcrumbs::widget(
                [
                    'homeLink' => [
                        'label' => Yii::t('yii', 'Home'),
                        'url' => Yii::$app->homeUrl,
                        'encode' => false// Requested feature
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]
            ) ?>

        </div>
    </div>
</div>
<!-- end page title -->