<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImageTrait;
use App\Models\BlogNews;
use Illuminate\Http\Request;

 
use App\Http\Requests\Backend\StoreProductRequest;
use App\Http\Requests\Backend\UpdateProductRequest; 
use App\Models\{
    Attribute,
    Brand,
    Category,
    Product,
    Store,
    Tag
};

use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Storage;

class BlogsNewsController extends Controller
{
    //
    use UploadImageTrait;
    //
    public function index()
    {
        $blogsNews = BlogNews::all();
        return view('backend.Admin_Dashboard.blogsNews.index', compact('blogsNews'));

    }
    public function create()
    {
        return view('backend.Admin_Dashboard.blogsNews.create');
    } 

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'title' => 'required|string',
            'active' => 'required|boolean',
            'main_page' => 'required|boolean',
            'content' => 'required|string',
            'image' => 'required'
        ], [
            'type.required' => 'حقل النوع مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
            'main_image.required' => 'حقل الصفحة الرئيسية مطلوب',
            'active.required' => 'حقل النشط مطلوب',
            'content.required' => 'حقل المحتوى مطلوب',
            'image.required' => ' حقل الصورة مطلوب',
        ]);
        

        $validatedData['image'] = $this->ProcessImage($request, 'image', 'blogsNews');
        BlogNews::create($validatedData);
        return redirect()->route('admin.blogsNews.index')->with('toast_success', 'تم الحفظ بنجاح');
    }

    public function edit($id)
    {
        $blogNews = BlogNews::findOrFail($id);
        return view('backend.Admin_Dashboard.blogsNews.edit', compact('blogNews'));
    }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'title' => 'required|string',
            'active' => 'required|boolean',
            'main_page' => 'required|boolean',
            'content' => 'required|string',
            'image' => 'sometimes'
        ], [
            'type.required' => 'حقل النوع مطلوب',
            'title.required' => 'حقل العنوان مطلوب',
            'main_image.required' => 'حقل الصفحة الرئيسية مطلوب',
            'active.required' => 'حقل النشط مطلوب',
            'content.required' => 'حقل المحتوى مطلوب',
        ]);
         
        $blogNews = BlogNews::findOrFail($id);
        
    
 
        $validatedData['image'] = $this->ProcessImage($request, 'image', 'blogsNews', null, null, $blogNews->image);
        //dd($validatedData);
      // تحديث البيانات باستخدام دالة update()
    $blogNews->update($validatedData);
        return redirect()->route('admin.blogsNews.index')->with('toast_success', 'تم التعديل بنجاح');


    }
    public function destroy($id)
    {
        $blogNews = BlogNews::findOrFail($id);
        $blogNews->delete();
        return redirect()->route('admin.blogsNews.index')->with('toast_error', 'تم الحذف بنجاح');
    }
}
