<?php

namespace App\Http\Controllers\AdminDashboard;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Enumerations\Type;
use App\Http\Requests\MainCategoryRequest;

class MainCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(PAGINATION_COUNT) ;

        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        $categories = Category::all() ;

        return view('admin.categories.create',compact('categories'));
    }
    public function store(MainCategoryRequest $request)
    {
        try{
            
            if($request->type == Type::mainCategory)
            {
                $request->request->add(['parent_id' => null]) ;
            }
            // dd($request->all());
            $category = Category::create([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => $request->is_active
            ]);

            $category->name = $request->name ;
            $category->save();
            
           return redirect()->route('admin.categories')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
    
    public function edit($id)
    {
        $category = Category::find($id);
        if(!$category)
        {
            return redirect()->route('admin.categories')->with('error','هذا القسم غير موجود');
            
        }
        return view('admin.categories.edit',compact('category'));
    }
    public function update(MainCategoryRequest $request , $id)
    {
        try
        {
            
             $category = Category::find($id);

            if(!$category)
            {
                return redirect()->route('admin.categories')->with('error','هذا القسم غير موجود');
                
            }

            if(!$request->has('is_active'))
            {
                $request->request->add(['is_active' => 0]);
            }else
            {
                $request->request->add(['is_active' => 1]);

            }

            // dd($request->slug);
            $category->update([
                'name' => $request->name,
                'slug' => $request->slug,
                'is_active' => $request->is_active
            ]);

            // dd($category->slug);
            $category->name = $request->name ;
    
            $category->save();
           return redirect()->route('admin.categories')->with('success','تم التعديل بنجاح');
        }
        catch(Exception $ex)
        {
            return redirect()->route('admin.categories')->with('error','حدث خطا ما');

        }
    }
    public function delete($id)
    {
        try{
            $category = Category::find($id);
            if(!$category)
            {
                return redirect()->back()->with('error','هذا القسم غير موجود');
            }
            $category->delete($id);

           return redirect()->back()->with('success','تم الحذف بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}
