<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Product;
use App\Category;
use App\Order;
use App\Transaction;


Route::get('/', function () {
    $getProduct = Product::all();
    $getCategoryName = Category::all();
    $getOrder = Order::all();
    $getTransaction = Transaction::all();
    return view('/homepage', compact('getProduct','getCategoryName','getOrder','getTransaction'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//User created pages

Route::match(['PUT','POST'],'/transaction_start', 'CashierController@startTransaction');
Route::GET('/transaction_start','CashierController@getTransaction');

Route::match(['PUT','POST','PATCH'],'/add_order', 'CashierController@addOrder');
Route::match(['PUT','POST'],'/{key}/add_order/','CashierController@ajaxOrder');
Route::match(['POST','GET'],'/get_orders', 'CashierController@getOrders');
Route::match(['POST','GET'],'/product_search','CashierController@productSearchView');
Route::match(['POST','DELETE'],'/delete_order','CashierController@deleteOrder');
Route::GET('/homepage', 'CashierController@getCategory');
Route::GET('/confirm_order','CashierController@checkOutConfirm');
ROUTE::POST('/make_order','CashierController@makeOrder');
Route::POST('/save_transaction','CashierController@saveTransaction');


Route::get('/create_category', 'AdminController@getCategory');
Route::match(['PUT','POST'],'/create_category_validate', 'AdminController@createCategory');
Route::POST('/create_product', 'AdminController@createProduct');
Route::GET('/create_product', 'AdminController@createProductView');
Route::GET('/daily_sales','AdminController@dailySales');
Route::GET('/daily_sales_data','AdminController@dailySalesPrice');
Route::GET('/monthly_sales','AdminController@monthlySales');
Route::MATCH(['get','post'],'/monthly_sales_data','AdminController@monthlySalesData');
Route::GET('/yearly_sales','AdminController@yearlySales');
Route::GET('/yearly_sales_data','AdminController@yearlySalesData');
Route::MATCH(['PUT','post'],'/product/{id}/edit','AdminController@editProduct');
Route::MATCH(['delete','post'],'/product/{id}/delete','AdminController@deleteProduct');
Route::MATCH(['PUT','post'],'/category/{id}/edit','AdminController@editCategory');
Route::MATCH(['delete','post'],'/category/{id}/delete','AdminController@deleteCategory');

