<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller; 
use App\Models\Category;
use App\Models\Product;
use App\Models\Store; 
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){

 
        $main_categories = Category::where('status','=','active')-> where('parent_id', '=', null)->get();
        $sup_categories = Category::where('status','=','active')-> where('parent_id','!=','null')->get();
        $stores = Store::where('status','=','active')->get();
        $offers = Product::where('status', 'active')->where('offer',1)->take(8)->get();
        $products_mostViewed = Product::orderBy('views', 'desc')->take(8)->get();
    


        // get latest 8 products which status is active 
       $products = Product::with('category','store','reviews')
        ->active()
        ->inRandomOrder()
        ->latest()
        ->take(8)
        ->get();
		
		
		// Get one product from each store
        // $stores = Store::where('status','=','active')->inRandomOrder()->get();
        // $products = [];

        // foreach ($stores as $store) {
        //     $product = Product::with('category', 'store', 'reviews')
        //         ->active()
        //         ->where('store_id', $store->id)
        //         ->inRandomOrder()
        //         ->first(); // Get the latest product for each store
        //     if ($product) {
        //         $products[] = $product;
        //     }
        // }


		// $best_seller_products = Product::where('product_type','=','best_seller')->active()->latest()->take(4)->get();
        return view('frontend.pages.home',  compact(
            'products',  
        'main_categories',
        'sup_categories',
        'stores',
        'offers',
        'products_mostViewed'
            // ,'best_seller_products'
    ));
    }
}
