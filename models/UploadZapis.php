<?php
namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
class UploadZapis extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'checkExtensionByMimeType' => false, 'extensions' => 'csv'],

        ];
    }

    public function upload()
    {
        if ($this->validate()) {

           $sas='@app/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $sa=$this->imageFile->saveAs( Yii::getAlias('@app/uploads/'). $this->imageFile->baseName . '.' . $this->imageFile->extension);
           // $this->imageFile->saveAs('@app/web/images/home/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);

            return true;
        } else {
            return false;
        }
    }
}