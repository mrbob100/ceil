<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "table_price".
 *
 * @property integer $id
 * @property string $_IDRRef
 * @property string $_Version
 * @property integer $_Marked
 * @property string $_Date_Time
 * @property integer $_Number
 * @property integer $_Posted
 * @property string $_Fld220RRef
 * @property string $_Fld258RRef
 * @property integer $_Fld629
 * @property string $_Fld456RRef
 * @property integer $_Fld692
 * @property integer $_Fld770
 */
class TablePrice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_price';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_IDRRef', '_Date_Time', '_Fld220RRef'], 'required'],
            [['_Marked', '_Number', '_Posted', '_Fld629', '_Fld692', '_Fld770'], 'integer'],
            [['_Date_Time'], 'safe'],
            [['_IDRRef', '_Fld220RRef'], 'string', 'max' => 50],
            [['_Version', '_Fld258RRef', '_Fld456RRef'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            '_IDRRef' => 'Idrref',
            '_Version' => 'Version',
            '_Marked' => 'Marked',
            '_Date_Time' => 'Date  Time',
            '_Number' => 'Number',
            '_Posted' => 'Posted',
            '_Fld220RRef' => 'Fld220 Rref',
            '_Fld258RRef' => 'Fld258 Rref',
            '_Fld629' => 'Fld629',
            '_Fld456RRef' => 'Fld456 Rref',
            '_Fld692' => 'Fld692',
            '_Fld770' => 'Fld770',
        ];
    }
}
