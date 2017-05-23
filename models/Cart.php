<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 14.05.2016
 * Time: 10:40
 */

namespace app\models;
use yii\db\ActiveRecord;

class Cart extends ActiveRecord{

    public function addToCart($product, $qty = 1)
    {
        if(isset($_SESSION['cart'][$product->category_id][$product->id])){
            $_SESSION['cart'][$product->category_id][$product->id]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$product->category_id][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img,
                'category'=>$product->category_id,
                'product'=>$product->id,
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
    }

    public function recalc($id,$cat){
        if(!isset($_SESSION['cart'][$cat][$id])) return false;
        $qtyMinus = $_SESSION['cart'][$cat][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$cat][$id]['qty'] * $_SESSION['cart'][$cat][$id]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$cat][$id]);
    }


} 