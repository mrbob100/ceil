<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 14.05.2016
 * Time: 10:37
 */

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderItems;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

/*Array
(
    [1] => Array
    (
        [qty] => QTY
        [name] => NAME
        [price] => PRICE
        [img] => IMG
    )
    [10] => Array
    (
        [qty] => QTY
        [name] => NAME
        [price] => PRICE
        [img] => IMG
    )
)
    [qty] => QTY,
    [sum] => SUM
);*/

class CartController extends AppController{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post','get'],
                ],
            ],
        ];
    }

    public function actionAdd(){
        $id = Yii::$app->request->get('id');
        $qty =(int) Yii::$app->request->get('qty');
        $qty=!$qty ? 1 : $qty;
        
  /*      $ass= null;
        $price=0;
        $name=null;
        $img=null;
        // блок поиска чертежа потолка
        if($_SESSION['diller'])
          {
            $arch=$_SESSION['diller'];  //  передача выбранных элементов в таблице чертежей plot

              foreach( $arch as $it )
              {
                  $ass=count($it['potolok']); //количество записей в потолке
                  $ras=$it['potolok'];
                  $name=$it['chatname'];
                  $img=$it['img'];
                     for($i=0; $i<$ass; $i++)
                      {
                          $setId= $ras[$i]['ID'];
                          if( $setId==$id)
                          {
                              $uid=$ras[$i]['ItemUID'];
                              $price=$ras[$i]['Price'];
                              break;
                          }

                      }


                 // найден чертеж
                  // поиск по uid потолка


              }
            //  $query = Ceilings::findOne('uid');
             // $query = Product::find()->where(['category_id' => $id]);
            //  $product = Ceilings::find()->where(['UID' => $uid ])->all();
              $diller= new Diller();
              $diller->price=$price;
              $diller->name=$name;
              $diller->id=$id;
              $diller->img=$img;
              $product=$diller;
              $session->remove('material');

          } else {
  */
      /*  $product1 = Product::findOne($id);
            $uid= $product1['UID'] ;
    $prmix=$product = Price::find()->where(['ItemUID' => $uid ])->all();
            $diller= new Diller();
            $diller->price= $prmix['Price'];
            $diller->name= $prmix['Name'];
            $diller->id=$id;
            $diller->img=$img;
            $product=$diller; */
            $session =Yii::$app->session;
            $session->open();
            if($_SESSION['diller'])
            {
                $arch=$_SESSION['diller'];
                foreach( $arch as $it )
                {
                   if($it['id']==$id) 
                   {
                       $product=$it; break;
                   }
                }

            }

        if(empty($product)) return false;
      //  debug($product);
        $session =Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        if( !Yii::$app->request->isAjax ){
            return $this->redirect(Yii::$app->request->referrer);
        }
        // debug($session ['cart']);
        $this->layout = false; // не подключать шаблон, а вывести только форму
       // debug($product);
       // debug($session);
        return $this->render('cart-modal', compact('session'));
    }

    public function actionClear()
    {
        $session =Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionDelItem()
    {
        $id = Yii::$app->request->get('id');
        $cat=Yii::$app->request->get('cat');
        $session =Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id,$cat);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionShow()
    {
        $session =Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    public function actionView()
    {
        $session =Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');

        $order = new Order();
        if( $order->load(Yii::$app->request->post()) ){
      //      $order->created_at = time();
       //     $order->updated_at = time();
            //debug(Yii::$app->request->post());
           // $order->qty = $session['cart.qty'];
            $user_set=Yii::$app->user->identity;
           // $order->user_uid=$user_set['UID'];

            $order->sum = $session['cart.sum'];
            $order->qty = $session['cart.qty'];
            if($order->save()){
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер вскоре свяжется с Вами.');
       //         Yii::$app->mailer->compose('order.twig', ['session' => $session])
       //             ->setFrom(['username@mail.ru' => 'yii2.loc'])
       //             ->setTo($order->email)
        //            ->setSubject('Заказ')
        //            ->send();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
            $session->remove('diller');
                return $this->refresh();
            }else{

                   print_r($order->getErrors());

              Yii::$app->session->setFlash('error', 'Ошибка оформления заказа');
            }
        }

        return $this->render('view', compact('session', 'order'));
    }

    protected function saveOrderItems($items, $order_id){
        foreach($items as $id => $item1) {
            foreach($item1 as $id1 => $item){
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->priznak = 0;
            $se = count($item);

            // $order_items->product_id = $items['id'];
            // $order_items->name = $item['name'];
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            if (!$order_items->save(false)) {
                echo "save false";
                print_r($order_items->getErrors());
            } else
                $order_items->save();
        }
        }
    }

}


















