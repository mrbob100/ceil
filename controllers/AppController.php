<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 06.09.2016
 * Time: 16:31
 */

namespace app\controllers;
use yii\web\Controller;
use app\components\MenuWidget;
use yii\filters\AccessControl;
class AppController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
    protected function setMeta($title = null, $keywords = null, $description = null)
    {
        $this->view->title = $title;
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }

    protected function setPage($id)
    {

    }
}