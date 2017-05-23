<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 25.12.2016
 * Time: 17:35
 */

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $sas='@app/web/images/home/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
         //  $sas=$this->imageFile->saveAs('false');  http://localhost/ceil/web/cart/add
         //   $this->imageFile->saveAs('http://localhost/ceil/web/images/home/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $sa=$this->imageFile->saveAs( Yii::getAlias('@app/web/images/home/'). $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}