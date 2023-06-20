<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Requests\ProductStockRequeest;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequeest;
use App\Http\Requests\ProductImagesRequeest;
use App\Http\Requests\ProductPriceRequest;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
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
    public function getPrice($product_id)
    {
        return view('admin.products.price.create',compact('product_id'));
    }
    public function storeprice(ProductPriceRequest $request )
    {
        try{
            DB::beginTransaction();
            // dd($request->all());

            Product::where('id',$request->product_id)->update([
                'price'  => $request->price , 
                'special_price'  => $request->special_price ,
                'special_price_type' => $request->special_price_type ,
                'special_price_start' => $request->special_price_start ,
                'special_price_end' => $request->special_price_end ,
            ]);
           return redirect()->route('admin.general.products')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            DB::rollBack();

            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
    public function getStock($product_id)
    {
        return view('admin.products.stock.create',compact('product_id'));
    }
    public function storeStock(ProductStockRequeest $request)
    {
        try{
            DB::beginTransaction();
            // dd($request->all());

            Product::where('id',$request->product_id)->update([
                'sku'  => $request->sku , 
                'manage_stock'  => $request->manage_stock ,
                'in_stock' => $request->in_stock ,
                'qty' => $request->qty ,
            ]);
            DB::commit();
           return redirect()->route('admin.general.products')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            DB::rollBack();

            return redirect()->back()->with('error','حدث خطا ما');

        }
    }

    public function getImages($product_id)
    {
        return view('admin.products.image.create',compact('product_id'));
    }

    public function saveImage(Request $request)
    {
        if($request->hasFile('dzfile'))
        {
            $file = $request->file('dzfile');
            $file_name = getImage('products',$request->dzfile);
        }   
        return response()->json([
            'name' => $file_name ,
            'origine_name' => $file->getClientOriginalName(),
        ]);
    }
    public function storeImage(ProductImagesRequeest $request)
    {
        try{
            DB::beginTransaction();
            if($request->has('document') && count($request->document) > 0)
            {
                foreach($request->document as $photo)
                {
                    ProductImage::create([
                        'product_id' => $request->product_id,
                        'photo' => $photo
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.general.products')->with('success','تم الاضافه بنجاح');

        }catch(Exception $ex)
        {
            DB::rollBack();

            return redirect()->back()->with('error','حدث خطا ما');

        }
    }
}
