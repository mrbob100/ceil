<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $UID
 * @property string $Name
 * @property integer $IsGroup
 * @property string $ParentUID
 * @property integer $TypeID
 * @property string $img
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'UID', 'Name', 'ParentUID', 'TypeID'], 'required'],
            [['category_id', 'IsGroup', 'TypeID'], 'integer'],
            [['img'], 'string'],
            [['UID', 'ParentUID'], 'string', 'max' => 36],
            [['Name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID товара',
            'category_id' => 'категория',
            'UID' => 'идентификатор товара',
            'Name' => 'наименование',
            'IsGroup' => 'группа',
            'ParentUID' => 'родительская группа',
            'TypeID' => 'тип ID',
        //    'img' => 'Img',
        ];
    }
}
