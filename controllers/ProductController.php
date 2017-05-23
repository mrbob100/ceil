<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 09.05.2016
 * Time: 10:50
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use app\models\Ceilings;
use app\models\Price;
use app\models\Diller;
use Yii;
use app\components\MenuWidget;

class ProductController extends AppController{

    public function actionView($id)
    {
        $akkord = new MenuWidget();
        $akkordeon= $akkord->run();
      //  $id = Yii::$app->request->get('id');
        if($id>9999) {
            $qw = $id - 10000;
            $product = Product::findOne($qw);
            if(empty($product)) throw new \yii\web\HttpException(404, 'Такого товара нет');

            $add=$product->UID;  //здесь нет цены
            $query=Price::findOne(['ItemUID'=>$add]);
            $shema=new Diller();
            $shema->id=$qw;
            $shema->name=$product->Name;
            $shema->price=$query->Price;
            $shema->img=$product->img;
        } else {
            $product = Ceilings::findOne($id);
            if(empty($product)) throw new \yii\web\HttpException(404, 'Такого чертежа нет');
            $shema=new Diller();
            $shema->id=$id;
            $shema->name=$product->UID;
            $shema->price=$product->Sum;
            $shema->img=$product->img;
        }

        $category=Category::findOne($product->category_id);


        //   $query=Price::find()->where(['ItemUID'=>$add])->all();


//        $product = Product::find()->with('category')->where(['id' => $id])->limit(1)->one();
      //  $hits = Product::find()->where(['new' => '1'])->limit(6)->all();
      //  $this->setMeta('POOLSKY | ' . $product->Name, $product->keywords, $product->description);
        return $this->render('view', compact('shema','akkordeon','category'));
    }

   

} 