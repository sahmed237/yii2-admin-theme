```php
<?php


namespace frontend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $order_number
 * @property string $customer_name
 * @property string $order_date
 * @property string $status
 * @property float $total_amount
 * @property int $created_at
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_number', 'customer_name', 'order_date'], 'required'],
            [['order_date'], 'safe'],
            [['total_amount'], 'number'],
            [['created_at'], 'integer'],
            [['order_number'], 'string', 'max' => 50],
            [['customer_name', 'status'], 'string', 'max' => 255],
            [['order_number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_number' => 'Order Number',
            'customer_name' => 'Customer Name',
            'order_date' => 'Order Date',
            'status' => 'Status',
            'total_amount' => 'Total Amount',
            'created_at' => 'Created At',
        ];
    }

    public static function globalSearch($term)
    {
        $orders = self::find()
            ->where(['ilike', 'order_number', $term])
            ->orWhere(['ilike', 'customer_name', $term])
            ->limit(5)
            ->all();

        $results = [];

        foreach ($orders as $order) {
            $results[] = [
                'icon' => 'ri-file-text-line',
                'title' => 'Order #' . $order->id,
                'description' => $order->status . ' - ' . $order->customer_name,
                'url' => \yii\helpers\Url::to(['/order/view', 'id' => $order->id])
            ];
        }

        return $results;
    }
}

```