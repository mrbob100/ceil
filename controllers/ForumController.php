<?php
namespace app\controllers;
use app\components\MenuWidget;
use Yii;
use app\models\Category;

class ForumController extends AppController
{
    public function actionView()
    {
        $akkord = new MenuWidget();
        $akkordeon= $akkord->run();

        $this->setMeta('poolsky');
        return $this->render('index', compact( 'akkordeon'));
    }
}