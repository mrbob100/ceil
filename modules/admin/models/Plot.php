<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "plot".
 *
 * @property integer $id
 * @property string $img
 * @property string $name
 * @property string $potolok
 * @property integer $id_dealer
 * @property integer $id_potolok
 * @property string $created_at
 */
class Plot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plot';
    }
    public function getCeilings(){
        return $this->hasOne(Ceilings::className(), ['ID' => 'id_potolok']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img', 'name', 'potolok', 'id_dealer', 'id_potolok', 'created_at'], 'required'],
            [['potolok'], 'string'],
            [['id_dealer', 'id_potolok'], 'integer'],
            [['created_at'], 'safe'],
            [['img', 'name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'Img',
            'name' => 'Name',
            'potolok' => 'Potolok',
            'id_dealer' => 'Id Dealer',
            'id_potolok' => 'Id Potolok',
            'created_at' => 'Created At',
        ];
    }
}
