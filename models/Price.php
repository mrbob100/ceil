<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Price".
 *
 * @property string $UserUID
 * @property string $ItemUID
 * @property string $FromDate
 * @property double $Price
 * @property double $Discount
 * @property string $DocUID
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['UserUID', 'ItemUID', 'FromDate', 'Price', 'Discount', 'DocUID'], 'required'],
            [['FromDate'], 'safe'],
            [['Price', 'Discount'], 'number'],
            [['UserUID', 'ItemUID', 'DocUID'], 'string', 'max' => 36],
            [['ItemUID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'UserUID' => 'User Uid',
            'ItemUID' => 'Item Uid',
            'FromDate' => 'From Date',
            'Price' => 'Price',
            'Discount' => 'Discount',
            'DocUID' => 'Doc Uid',
        ];
    }
}
