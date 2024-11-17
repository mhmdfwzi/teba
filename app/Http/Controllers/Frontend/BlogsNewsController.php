<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogNews;
use Illuminate\Http\Request;

class BlogsNewsController extends Controller
{
    public function blogsNews()
    {
        $blogsNews = BlogNews::all();
        $blogs = BlogNews::all();
        $servicesProducts = BlogNews::all();
        
        return view('frontend.pages.blogsNews', compact('blogsNews','blogs','servicesProducts'));
    }

    public function blogsNewsDetails($id)
    {
        $blogNews = BlogNews::findOrFail($id);
        $popularBlogNews = BlogNews::where('id', '!=', $id)  // Exclude the current product by ID
        ->take(5)->get();

        return view('frontend.pages.blogsNewsDetails', compact('blogNews', 'popularBlogNews'));
    }
}
