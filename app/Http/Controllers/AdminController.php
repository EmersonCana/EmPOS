<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Transaction;
use App\Sale;
use Carbon\Carbon;

use DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set("Asia/Manila");
    }
    
    public function getCategory() {
        $getCategory = Category::all();
        return view('layouts.pages.admin_settings', compact('getCategory'));
    }
    public function createCategory(Request $request) {
        $createCategory = new Category;
        $createCategory->category_name = $request->category_name;
        $createCategory->save();
        return redirect('/create_category');
    }

    public function createProduct(Request $request) {
        $createProduct = new Product;
        $createProduct->category_id = $request->category;
        $createProduct->product_name = $request->product_name;
        $createProduct->product_key = $request->product_key;
        $createProduct->price = $request->price;
        $createProduct->save();
        return redirect('/create_product');
    }

    public function createProductView(Request $request) {
        $getProducts = Product::all();
        $getCategory = Category::all();
        return view('layouts.pages.create_product', compact('getCategory','getProducts'));
    }

    public function dailySales() {
        $today = Carbon::now()->day;
        $dailySales = Sale::whereDay('created_at','=',Carbon::now()->day)->sum('price');
        $salesPerProduct = 0;
        $getDailySales = Sale::whereDay('created_at','=',Carbon::now()->day)->orderBy('updated_at','DESC')->get();
        $countCustomers = DB::table('sales')->where('created_at','=',Carbon::now()->day)->distinct('transaction_id')->count('transaction_id');
        
        foreach($getDailySales as $sales) {
            $getSalesPrice = Sale::whereDay('created_at',$today)->get();
            $getSalesCount = Sale::whereDay('created_at',$today)->get();
        }
        return view('layouts.pages.admin_daily_sales', compact('getSalesPrice','getSalesCount','getDailySales','dailySales','countCustomers','today'));
    }

    public function dailySalesPrice(Request $request) {
        $today = Carbon::now()->day;
        $dailySales = Sale::whereDay('created_at','=',Carbon::now()->day)->sum('price');
        $getSalesCount = "";
        if($request->date == "") {
            $getDailySales = Sale::whereDay('created_at',$today)->get();
            $countCustomers = DB::table('sales')->where('created_at',$today)->distinct('transaction_id')->count('transaction_id');
        }else{
            $getDailySales = Sale::whereDay('created_at',$request->date)->get();
            $countCustomers = DB::table('sales')->whereDay('created_at',$request->date)->distinct('transaction_id')->count('transaction_id');
        }
        foreach($getDailySales as $sales) {
            $getSalesPrice = Sale::whereDay('created_at',$today)->get();
            $getSalesCount = Sale::whereDay('created_at',$today)->get();
        }
        return view('layouts.pages.admin_daily_sales_data', compact('getSalesPrice','getDailySales','dailySales','countCustomers','countSold','today'));
    }

    public function monthlySales() {
        $thisMonth = Carbon::now()->month;
        $today = Carbon::now()->day;
        $monthlySales = Sale::whereMonth('created_at','=',$thisMonth)->sum('price');
        $month = Sale::whereMonth('created_at',1)->get();
        return view('layouts.pages.admin_monthly_sales', compact('month','monthlySales','thisMonth'));
    }

    public function monthlySalesData(Request $request) {
        $thisMonth = $request->month;
        $getMonthlySales = Sale::whereMonth('created_at',$thisMonth)->get();
        $monthlySales = 0;
        foreach($getMonthlySales as $sales) {
            $monthlySales += $sales->price;
        }
        return view('layouts.pages.admin_monthly_sales', compact('month','monthlySales','thisMonth'));;
    }

    public function yearlySales() {
        $thisYear = Carbon::now()->year;
        $today = Carbon::now()->day;
        $getDailySales = Sale::whereYear('created_at',$thisYear)->get();
        $yearlySales = 0;
        foreach($getDailySales as $sales) {
            $yearlySales += $sales->price;
        }
        return view('layouts.pages.admin_yearly_sales', compact('thisYear','getDailySales','yearlySales','countCustomers'));
    }

    public function yearlySalesData(Request $request) {
        $year = Carbon::now()->year;
        $thisYear = Carbon::now()->year;
        $getDailySales = Sale::whereYear('created_at',$request->input_year)->get();
        $yearlySales = 0;
        foreach($getDailySales as $sales) {
            $yearlySales += $sales->price;
        }
        return view('layouts.pages.admin_yearly_sales', compact('thisYear','getDailySales','yearlySales','year'));
    }

    public function editProduct(Request $request, $id) {
        $createProduct = Product::find($id);
        $createProduct->category_id = $request->category;
        $createProduct->product_name = $request->product_name;
        $createProduct->price = $request->price;
        $createProduct->save();
        return redirect('/create_product');
    }

    public function deleteProduct(Request $request, $id) {
        $deleteProduct = Product::find($id);
        $deleteProduct->delete();
        return redirect('/create_product');
    }

    public function editCategory(Request $request, $id) {
        $editCategory = Category::find($id);
        $editCategory->category_name = $request->category_name;
        $editCategory->save();
        return redirect('/create_category');
    }

    public function deleteCategory($id) {
        $deleteCategory = Category::find($id);
        $deleteCategory->delete();
        return redirect('/create_category');
    }
}
