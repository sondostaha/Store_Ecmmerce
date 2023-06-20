<?php

namespace App\Http\Controllers\AdminDashboard;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequeest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(PAGINATION_COUNT);

        return view('admin.products.general.index',compact('products'));
    }

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::active()->get() ;
        $data['categories'] = Category::active()->get() ;
        $data['tags'] = Tag::all() ;

        return view('admin.products.general.create',$data);
    }
    public function store(GeneralProductRequeest $request)
    {
        try{
            DB::beginTransaction();
            
            if(!$request->has('is_active'))
            {
                $request->request->add(['is_active' => 0]);
            }else
            {
                $request->request->add(['is_active' => 1]);

            }
            // dd($request->all());
            $products = Product::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'short_description' => $request->short_description,
                'is_active' => $request->is_active
            ]);

            $products->categories()->attach($request->categories);


            $products->tags()->attach($request->tags);

            // foreach($request->categories as $category)
            // {
            //     ProductCategory::create([
            //         'product_id' => $products->id,
            //         'category_id' => $category
            //     ]);
            // }
            
            DB::commit();
           return redirect()->route('admin.categories')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            DB::rollBack();

            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
    
    public function delete($id)
    {
        try{
            $product = Product::find($id);
            if(!$product)
            {
                return redirect()->back()->with('error','هذا المنتج غير موجود');
            }
            $product->delete($id);
            $product->categories()->delete();
            $product->tags()->delete();


           return redirect()->back()->with('success','تم الحذف بنجاح');

        }catch(Exception $ex)
        {
            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}
