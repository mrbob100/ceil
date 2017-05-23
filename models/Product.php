<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 31.08.2016
 * Time: 11:03
 */

namespace app\models;
use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product'; // TODO: Change the autogenerated stub
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id' ]);
    }


}