<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "set_price".
 *
 * @property integer $id
 * @property string $_IDRRef
 * @property integer $_KeyField
 * @property string $_Fld215RRef
 * @property double $_Fld216
 * @property double $_Fld217
 */
class SetPrice extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'set_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_IDRRef', '_Fld215RRef', '_Fld216', '_Fld217'], 'required'],
            [['_KeyField'], 'integer'],
            [['_Fld216', '_Fld217'], 'number'],
            [['_IDRRef', '_Fld215RRef'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
  /*  public function attributeLabels()
    {
        return [
            'id' => 'ID',
            '_IDRRef' => 'Idrref',
            '_KeyField' => 'Key Field',
            '_Fld215RRef' => 'Fld215 Rref',
            '_Fld216' => 'Fld216',
            '_Fld217' => 'Fld217',
        ];
    } */
}
