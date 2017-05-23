<?php

namespace app\modules\admin\models;

use Yii;
use yii\data\Pagination;
/**
 * This is the model class for table "Ceilings".
 *
 * @property integer $ID
 * @property integer $category_id
 * @property integer $user_id
 * @property string $Date
 * @property double $Sum
 * @property string $Comment
 * @property integer $status
 * @property string $createdat
 * @property string $UID
 * @property string $img
 */
class Ceilings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ceilings';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getPlot(){

        return $this->hasOne(Plot::className(), ['id_potolok' => 'ID']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id',  'Sum', 'Comment', 'status', 'UID', 'img'], 'required'],
            [['category_id', 'user_id', 'status'], 'integer'],
            [[ 'created_at'], 'safe'],
            [['Sum'], 'number'],
            [['img'], 'string'],
            [['Comment'], 'string', 'max' => 255],
            [['UID'], 'string', 'max' => 36],
            [['UID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID заказа',
            'category_id' => 'id категории',
            'user_id' => 'id пользователя',
            'created_at' => 'дата',
            'Sum' => 'сумма',
            'Comment' => 'комментарии',
            'status' => 'статус',
            'UID' => 'uid товара',
            'img' => 'Img',
        ];
    }
}
