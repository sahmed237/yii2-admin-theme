<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */


use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model sahmed237\yii2admintheme\models\AdminMenu */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Menu Management', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-menu-view">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
            <div class="card-tools">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'parent_id',
                        'value' => $model->parent ? $model->parent->label : 'Root',
                    ],
                    'label',
                    'route',
                    'icon',
                    'order',
                    [
                        'attribute' => 'visible',
                        'value' => $model->visible ? 'Yes' : 'No',
                    ],
                    'rbac_permission',
                    [
                        'attribute' => 'created_at',
                        'format' => ['datetime', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => ['datetime', 'php:Y-m-d H:i:s'],
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>