<?php

namespace App\Http\Controllers\Admin;

use App\category_product;
use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $category;
    private $category_product;
    private $product;
    private $post;

    public function __construct(Category $category,Product $product,category_product $category_product,Post $post){
        $this->category = $category;
        $this->product = $product;
        $this->category_product = $category_product;
        $this->post = $post;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::join('posts','posts.id','products.post_id')
                            ->select('posts.*','products.*')
                            ->get()->toJson();
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = $this->category->getAll();
        // dd($categories);
        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            Validator::make($request->all(),
            [
                'title'=> 'required',
                'slug'=> 'required',
                'image'=> 'required',
                'description'=> 'required',
                'content'=> 'required',
                'images'=> 'required',
                'price_buy'=> 'required',
                'price_sale'=> 'required',
            ])->validate();
            $data = $request->all();

            $data['price_buy'] = str_replace('.','',$data['price_buy']);
            if($data['price_sale'] != ''){
                $data['price_sale'] = str_replace('.','',$data['price_sale']);
            }else{
                $data['price_sale'] =  $data['price_buy'];
            }
            // dd($data);
            DB::beginTransaction();
            $data['type_post'] = 1;
            $post = Post::create($data);
            $data['post_id'] = $post->id;
            $data['product_code'] = $post->id;
            $data['images'] = $request->images;
            // $data['price_buy'] = $request->price_buy;
            // $data['price_sale'] = $request->price_sale;
            $product = Product::create( $data);
            foreach ($request->categories as $category){
                $dataCatePro=[
                    'category_id' => $category,
                    'product_id' =>$product->id
                ];
            $this->category_product->create($dataCatePro);

            }
            DB::commit();
            $request->session()->flash('success', 'Thêm sản phẩm thành công');

            return redirect()->route('admin.products.index');

        }catch(Exception $e){
            // DB::rollBack();
            $request->session()->flash('success', 'Thêm sản phẩm thất bại');
            return redirect()->back();

        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        //
        $product =$this->product->detailProductBySlug($slug);
        $cateProduct = $this->category_product->where("product_id",$product->id)->get();
        $cates = [];
        foreach($cateProduct as $cate){
            $cates[] = $cate->category_id;
        }
        $categories = $this->category->getAll();
        return view('admin.products.edit',compact('product','categories','cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
            $data = $request->all();

            $data['price_buy'] = str_replace('.','',$data['price_buy']);
            if($data['price_sale'] != ''){
                $data['price_sale'] = str_replace('.','',$data['price_sale']);
            }else{
                $data['price_sale'] =  $data['price_buy'];
            }
           
        try{
            $product = $this->product->find($id);
            $post = $this->post->find($product->post_id);
            DB::beginTransaction();

            $postUpdate = $post->update($data);
            $product->update($data);
            // $data['images'] = $request->images;
            $this->category_product->where('product_id',$product->id)->delete();
            foreach ($request->categories as $category){
                $dataCatePro=[
                    'category_id' => $category,
                    'product_id' =>$product->id
                ];
                $this->category_product->create($dataCatePro);

            }


         
           
            DB::commit();
            return redirect()->route('admin.products.edit',$request->slug)->with('success','Cập nhật sản phẩm thành công');
        }catch(Exception $e){
            Log::error($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error','Cập nhật sản phẩm thất bại');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
