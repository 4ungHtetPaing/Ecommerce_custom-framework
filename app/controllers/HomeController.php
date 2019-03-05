<?php

namespace App\Controllers;

use App\Models\Product;
use App\Classes\Request;
use App\Classes\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Classes\Auth;


class HomeController extends MainController
{
    public function index()
    {
        $prods = Product::all()->count();
        list($pros, $pages) = paginate(4, $prods, new Product);
        $products = json_decode(json_encode($pros));

        $featured_products = Product::where('featured', 2)->get();
        view("home", compact('products', 'pages', 'featured_products'));
    }

    public function cart()
    {
        $post = Request::get('post');
        if (\App\Classes\CSRFToken::checkToken($post->token)) {
            $items = $post->cart;
            $carts = [];
            if ($items) {
                foreach ($items as $item) {
                    $cart = Product::where("id", $item)->first();
                    $cart->qty = 1;
                    array_push($carts, $cart);
                }
            }
            echo json_encode($carts);
            exit;
        } else {
            echo "Token Fail";
            exit;
        }
       
    }

    public function saveDataToDatabase($status = "Pending", $extra = "")
    {
        $items = Session::get('cart_items');
        $user_id = Auth::user("user_id");
        $order_no = uniqid();
        $total = 0;
        foreach($items as $item){
            $total += $item->price * $item->qty;
            $od = new OrderDetail();
            $od->user_id = $user_id;
            $od->product_id = $item->id;
            $od->product_price = $item->price;
            $od->quantity = $item->qty;
            $od->total = $item->price * $item->qty;
            $od->status = $status;
            $od->order_no = $order_no;
            $od->save();

        }
        
        $order = new Order();
        $order->user_id = $user_id;
        $order->order_no = $order_no;
        $order->order_extra = $extra;
        $order->save();

        $payment = new Payment();
        $payment->user_id = $user_id;
        $payment->order_no = $order_no;
        $payment->amount = $total;
        $payment->status = $status;
        Session::replace("total_amount", $total);
        if($payment->save()){           
            return true;
        }else{
            return false;
        }
    }
    public function payout()
    {
        $post = Request::get('post');
            if (\App\Classes\CSRFToken::checkToken($post->token)) {
                Session::replace("cart_items", $post->items);
                echo "Success";
                exit;
            } else {
                echo "Token Fail";
                exit;
            }
    }

    public function saveOrder($orders){
        $order = serialize($orders);
        return true;
    }

    public function showCart()
    {
        view("cart");
    }

    public function show($id){
        $product = Product::where("id", $id)->first();
        view("detail", compact("product"));
    }
}
