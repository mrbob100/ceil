<?php
/**
 * Created by PhpStorm.
 * User: Vladymir
 * Date: 06.09.2016
 * Time: 16:30
 */

namespace app\controllers;

use app\models\Category;

use app\models\Product;
use app\models\Plot;
use app\models\Price;
use app\models\Roles;
use app\models\Sells;
use app\models\CeilingItems;
use app\models\Diller;
use Yii;
use app\components\MenuWidget;
use yii\data\Pagination;
use yii\helpers\Url;
use  app\modules\admin\controllers;
class CategoryController extends AppController
{
    public function actionIndex()
    {
        $akkord = new MenuWidget();
        $akkordeon= $akkord->run();

        $this->setMeta('poolsky');

        return $this->render('index', compact( 'akkordeon'));
    }

    public function actionView($id=0)
    {
    //    return Yii::$app->response->redirect(['category/profile', 'id' => $id]);
        // Yii::$app->response->redirect(['site/index', 'id' => $id]);
        $url='site/index';
       // Yii::$app->getResponse()->redirect(Url::to($url), 302);
      //  Yii::$app->response->redirect(Url::to('site/notactivated'));
        $akkord = new MenuWidget();
        $akkordeon= $akkord->run();
        $category = Category::findOne($id);
        if(empty($category))  throw new \yii\web\HttpException(404, 'Такой категории нет');
   //     $id = Yii::$app->request->get('id');
//        $products = Product::find()->where(['category_id' => $id])->all();
        $user_set=Yii::$app->user->identity;

        if ($category['name']=='визитка')
        {

            return Yii::$app->response->redirect(['category/vizitka', 'id' => $id]);

        } else

        if ($category['name']=='эврофлаэр')
        {

            return Yii::$app->response->redirect(['category/flyer', 'id' => $id]);

        } else

        if ($category['name']=='объявления')
        {

            return Yii::$app->response->redirect(['category/notice', 'id' => $id]);

        } else

        if ($category['name']=='кп')
        {

            return Yii::$app->response->redirect(['category/kp', 'id' => $id]);

        } else

            if ($category['name']=='индивидуальная печать')
            {

                return Yii::$app->response->redirect(['category/stamp', 'id' => $id]);

            } else


        if ($category['name']=='внутренний форум')
        {

            return Yii::$app->response->redirect(['category/forum', 'id' => $id]);

        } else

            if ($category['name']=='загрузка чертежа')  // блок загрузки чертежа
        {
            $role = Roles::findOne($user_set['RoleID']);
            if( $role["Name"] !='Админ')  // если не права админа
            {
                //  $query=Plot::find()->where(['id_user'=>$user_set['id'] ]);
                //$query=Plot::findAll(['id_user'=>$user_set['id']]);
                // $query= Plot::find()->where(['id_user' =>$user_set['id']]);
                // $query= Plot::find()->where(['like','id_user',$user_set["id"]]);
               // $query= Plot::find()->where(['diller' =>$user_set['username']]);
                $query= Sells::find()->where(['user_id' =>$user_set['id']]);
              //  $query=Plot::find()->where(['id_dealer'=>$user_set['id'] ]);
                $diller= $user_set['username'];
            }
            else {
                $query =Sells::find();  // права админа
               // $query =Plot::find();
                $diller='Админ';
            }


            $pages = new Pagination(['totalCount' =>$query->count()  , 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $product = $query->offset($pages->offset)->limit($pages->limit)->all(); // "это класс Ceilings


            $arch=array();
            $j=0;
            foreach( $product as $it)
            {


                $shema=new Diller();
                $shema->category_id=$category['id'];
                $shema->id= $it['id'];
                $shema->quantity=$it['quantity'];
                $shema->price=$it['sum'];
                $shema->square=$it['square'];
                $shema->sum=$it['sum'];
                $shema->name=$it['name'];
                $shema->img=$it['img'];
                $arch[$j]=$shema;
                $j++;
            }
            $session =Yii::$app->session;
            $session->open();
            $_SESSION['diller'] =$arch;
            $session->close();
            return $this->render('zakaz', compact('diller','arch', 'pages', 'akkordeon', 'category'));
        }

        else
            if ($category['name']=='расходные материалы')
            {

        $query = Product::find()->where(['category_id' => $id]);
            $pages = new Pagination(['totalCount' =>$query->count()  , 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
            $products = $query->offset($pages->offset)->limit($pages->limit)->all(); // продукты из product
                // конец блока загрузки всего, кроме чертежа. выбраны все продукты, относящиеся к категории
            $i=0; $arch=array();
            foreach( $products as $it)
            {
                $add=$it['UID'];
                $shema=new Diller();
             //   $query=Price::find()->where(['ItemUID'=>$add])->all();
                $query=Price::findOne(['ItemUID'=>$add]);
            //    if(empty($query))  throw new \yii\web\HttpException(404, 'Такого материала в таблице Price нет');
                $shema->price=$query->Price;
                $shema->category_id=$category['id'];
                $sas=$query->Price;
                $shema->ItemUID=$add;
                $shema->name=$it['Name'];
                $add=$it['id'];
              //  $add+=10000;
                $shema->id=$add;

                $shema->img=$it['img'];
                $arch[$i]=$shema;
                $i++;
            }
                if (($category['name']=='загрузка чертежа')or($category['name']=='расходные материалы'))
                {
        $this->setMeta('poolsky | ' . $category->name, $category->keywords, $category->description);

          //  $material=Price::find()->where(['CeilingID' =>$it['idplot']])->all();

            $session =Yii::$app->session;
            $session->open();
            // $_SESSION['diller'] = array($arch,$category); //
            $_SESSION['diller'] =$arch;

            //$session->set('arch',$arch);
            //$session->set('category',$category);
            $session->close();

            return $this->render('view', compact('arch', 'pages', 'akkordeon', 'category'));
                }
        }

       
    }


    public function actionForum()
    {
        $akkord = new MenuWidget();
        $akkordeon= $akkord->run();
    }


    public function actionSearch()
    {
        $akkord = new MenuWidget();
        $akkordeon= $akkord->run();
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('poolsky | Поиск: ' . $q);
        if(!$q)
            return $this->render('search');
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('akkordeon','products', 'pages', 'q'));
    }


}