<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "Ceilings".
 *
 * @property integer $ID
 * @property integer $category_id
 * @property integer $user_id
 * @property string $created_at
 * @property double $Sum
 * @property string $Comment
 * @property integer $status
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

    public function  getUser(){

        return $this->hasOne(User::className(), ['id' => 'user_id' ]);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id' ]);
    }

    public function getPlot(){
        return $this->hasOne(Plot::className(), ['id_potolok' => 'id']);
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
            [['category_id', 'user_id', 'Sum', 'Comment', 'status', 'UID', 'img'], 'required'],
            [['category_id', 'user_id', 'status'], 'integer'],
          //  [['created_at'], 'safe'],
            [['Sum'], 'number'],
            [['img'], 'string'],
            [['Comment'], 'string', 'max' => 255],
            [['UID'], 'string', 'max' => 36],
            [['UID'], 'unique'],
        ];
    }



}
