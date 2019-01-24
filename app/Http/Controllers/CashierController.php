<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Order;
use App\Category;
use App\Product;
use App\Sale;

use DB;

class CashierController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Manila");
    }

    public function startTransaction(Request $request) {
        $setTrans = new Transaction;
        $setTrans->price = 0;
        $setTrans->order_by = "Customer";
        $setTrans->save();
    }

    public function getTransaction() {
        $getTrans = Transaction::orderBy('ID','DESC')->take(1)->get();
        foreach ($getTrans as $trans) {
            $t = $trans->id;
        }
        return "<script>$('#transaction_id').html('$t');</script>";
    }

    public function addOrder(Request $request) {
        if($request->ajax()) {
            $checkFromCashier = Order::where('transaction_id','=',$request->trans_id)->where('product_key','=',$request->key)->first();
            $getProduct = Product::where('product_key','=',$request->key)->first();
                $order_name = $getProduct->product_name;
                $order_price = $getProduct->price;
                $getKeyCode = $getProduct->product_key;
            if($checkFromCashier){
                $checkFromCashier->quantity += 1;
                $checkFromCashier->price += $order_price;
                $checkFromCashier->save();
            }else{
                $setOrder = new Order;
                $setOrder->quantity = 1;
                $setOrder->order_name = $order_name;
                $setOrder->transaction_id = $request->trans_id;
                $setOrder->product_key = $getKeyCode;
                $setOrder->price = $order_price;
                $setOrder->save();
            }
        }
        
    }

    public function getOrders(Request $request) {
        if($request->ajax()){
            $count = $request->tid;
            $getOrders = Order::where('transaction_id','=',$count)->get();
            $sumOrders = doubleval(0);
            foreach($getOrders as $price) {
                $sumOrders += $price->price;
            }
            if($getOrders){
                return view('layouts.pages.get_orders', compact('getOrders','sumOrders'));
            }
        }
    }

    public function productSearchView(Request $request) {
        if($request->qry == ''){
            die();
        }else{
            $search_result = Product::where('product_name','LIKE','%'.$request->qry.'%')->get();
            $getCategoryName = Category::all();
            return view('layouts.pages.product_search', compact('search_result','getCategoryName'));
        }
    }

    public function deleteOrder(Request $request) {
        $delete_order = Order::where('id','=',$request->pid)->first();
        $delete_order->delete();
        $count = $request->tid;
        $getOrders = Order::where('transaction_id','=',$count)->get();
        $sumOrders = doubleval(0);
        foreach($getOrders as $price) {
            $sumOrders += $price->price;
        }
        if($getOrders){
            return view('layouts.pages.get_orders', compact('getOrders','sumOrders'));
        }
    }

    public function getCategory() {
        $getProduct = Product::paginate(10);
        $getCategoryName = Category::all();
        $getOrder = Order::all();
        $getTransaction = Transaction::all();
        $ascid = -1;
        $jsascid = -1;
        $ck = 47;
        $count = -1;
        return view('/homepage', compact('getProduct','getCategoryName','getOrder','getTransaction','ascid','jsascid','ck','count'));
    }

    public function checkOutConfirm(Request $request) {
        $confirmOrder = Order::where('transaction_id','=',$request->tid)->get();
                
        return view('layouts.pages.confirm_order',compact('confirmOrder'));
    }

    public function makeOrder(Request $request) {
        
        $makeSales = Order::where('transaction_id','=',$request->tid)->get();
        foreach($makeSales as $sales) {
            $makeOrder = new Sale;
            $makeOrder->transaction_id = $request->tid;
            $makeOrder->quantity = $sales->quantity;
            $makeOrder->order_name = $sales->order_name;
            $makeOrder->price = $sales->price;
            $makeOrder->order_by = "Customer";
            $makeOrder->save();
        }

        $setSales = Transaction::where('id','=',$request->tid)->first();
        $sumOrders = 0;
        foreach($makeSales as $price) {
            $sumOrders += $price->price;
        }
        $setSales->order_by = "Customer";
        $setSales->price = $sumOrders;
        $setSales->save();

        $deleteOrder = DB::delete('delete from orders where transaction_id = :trid',['trid' => $request->tid]);
        $deleteOrder;

        $deleteTransaction = DB::delete('delete from transactions where id = :trid',['trid' => $request->tid]);
        $deleteTransaction;
    }

    public function saveTransaction(Request $request) {
        $getPrice = Order::where('transaction_id','=',$request->tid)->get();
        $sumOrders = 0;
        foreach($getPrice as $price) {
            $sumOrders += $price->price;
        }
    }
        
}
