<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //

    public function index(){

    }

    // show product details

   
    
    public function show($id , $slug){
        $product = Product::where('id',$id)->where('slug',$slug)->first(); 

        if (!$product) {
            // Product not found, redirect to an error page or return a 404 response
            abort(404);
        }
    
        // Check if the provided slug is correct
        if ($slug != $product->slug) {
            // Incorrect slug, redirect to an error page or return a 404 response
            abort(404);
        }

        $main_categories = Category::where('status','=','active')-> where('parent_id', '=', null)->get();
        $sup_categories = Category::where('status','=','active')-> where('parent_id','!=','null')->get();


 
        $products =  Product::where('status','=','active')->where('category_id', '=', $product->category_id)->get();
        $products_limit =  Product::where('category_id', '=', $product->category_id)->limit(10)->get();
        $reviews = Review::where('product_id', $product->id)->get();

        //$product_variants = ProductVariant::all();

        $product_sizes = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 1)  
        ->get();

        $product_colors = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 2)
        ->get();

        $product_pics = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 3)
        ->get();

        $product_kamons = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 4)
        ->get();

        $shose_sizes = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 5)
        ->get();
        
        $options = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 6) 
        ->get();
        
        $cosmo = ProductVariant::where('product_id', '=', $product->id)
        ->where('attribute_id', '=', 7) 
        ->get();
        
        
            $product->incrementViews();
           // return view('products.show', compact('product'));
        

        if($product->status != 'active'){
            abort(404);
        }
        return view('frontend.pages.product_details',compact
        ('product','reviews','main_categories',
        'sup_categories','product_sizes','product_colors',
        'product_pics','product_kamons','shose_sizes','products','products_limit','options','cosmo'));
    }

    public function productAutocomplete(Request $request){
        $term = $request->input('term');

        $products = Product::where('name', 'LIKE', '%' . $term . '%')->where('status','active')
            ->select('name', 'id' ,'slug','image') // Select both name and id
            ->get(); // Retrieve the matching customers

        return response()->json($products);
    }
}