> **Note:** All you need is to add model that need to be search record in `$searchModels` array. 

> Each model must implement a `globalSearch($term)` static method that returns an array of formatted results. [model sample](madel_sample.md) :
```php
<?php
/**
 * @copyright Copyright © 2025 Pavilion Unified Solutions. All rights reserved.
 * @author S. Ahmed
 * Email: sadiqahmed237@gmail.com
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

class SearchController extends Controller
{
    public function actionGlobalSearch()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $term = Yii::$app->request->get('term');

        if (!$term || strlen($term) < 2) {
            return ['results' => []];
        }

        // List of models to search
        $searchModels = [
            \frontend\models\Order::class,
            \frontend\models\Product::class,
        //    \backend\models\User::class,
        ];

        $results = [];

        foreach ($searchModels as $modelClass) {
            if (method_exists($modelClass, 'globalSearch')) {
                $modelResults = $modelClass::globalSearch($term);
                if (!empty($modelResults)) {
                    $results = array_merge($results, $modelResults);
                }
            }
        }

        return ['results' => $results];
    }
}

```