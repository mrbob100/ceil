<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "plot".
 *
 * @property integer $id
 * @property string $img
 * @property string $name
 * @property string $potolok
 * @property integer $id_dealer
 * @property integer $id_potolok
 * @property string $data
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

    public function getSells(){
        return $this->hasOne(Sells::className(), ['id' => 'id_potolok']);
    }


    public function behaviors(){
        return [
            [

                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['img', 'name', 'potolok', 'id_dealer', 'id_potolok'], 'required'],
            [['potolok'], 'string'],
            [['id_dealer', 'id_potolok'], 'integer'],
           // [['created_at'], 'safe'],
            [['img', 'name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */

}
