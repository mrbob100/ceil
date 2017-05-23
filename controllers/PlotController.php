<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\components\MenuWidget;

class PlotController extends AppController
{
    public function actionIndex()
    {
      // $akkord = new MenuWidget();
      //  $akkordeon = $akkord->run();
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                $ass='Загрузка файла прошла успешно !';
                return  $this->render('view', compact('ass'));;
            }
        }

        return $this->render('index', compact('model'));


    }
    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

}
