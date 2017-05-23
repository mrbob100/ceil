<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sells".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $img
 * @property string $name
 * @property string $potolok
 * @property double $square
 * @property double $perimetr
 * @property integer $angels
 * @property integer $quantity
 * @property double $price
 * @property double $sum
 * @property integer $status
 * @property string $uid
 */
class Sells extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sells';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id', 'name', 'potolok', 'quantity', 'status', 'uid'], 'required'],
            [['user_id', 'category_id', 'angels', 'quantity', 'status'], 'integer'],
            [['img', 'potolok'], 'string'],
            [['square', 'perimetr', 'price', 'sum'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['uid'], 'string', 'max' => 36],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'img' => 'Img',
            'name' => 'Name',
            'potolok' => 'Potolok',
            'square' => 'Square',
            'perimetr' => 'Perimetr',
            'angels' => 'Angels',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'sum' => 'Sum',
            'status' => 'Status',
            'uid' => 'Uid',
        ];
    }
}
