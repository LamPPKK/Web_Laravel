<?php

namespace App\Http\Controllers\Site;

use App\category_product;
use App\Entity\Category;
use App\Entity\Post;
use App\Entity\Product;
use App\Entity\ReviewProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    private $category;
    private $product;
    private $post;
    private $reviewProduct;
    private $category_product;
    public function __construct(Category $category, Product $product, Post $post, category_product $category_product,ReviewProduct $reviewProduct)
    {
        $this->category = $category;
        $this->product = $product;
        $this->category_product = $category_product;
        $this->post = $post;
        $this->reviewProduct = $reviewProduct;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        //
        $product = $this->product->detailProductBySlug($slug);
        // dd($product);
        return view('site.defaults.product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
    public function review($post_slug)
    {
        $post = $this->post->getPostBySlug($post_slug);
        $reviews = $this->reviewProduct->paginate(10);
        // dd($reviews);
        return view('site.defaults.review', compact('post','reviews'));
        dd($post);
    }
    public function postReview(Request $request, $product_id)
    {
       
        $this->reviewProduct->userReviewProduct($request, $product_id);
        $post = $this->post->getPostByProductId($product_id);
        // dd($post);
        return redirect()->route('users.review',$post->slug);
    }
}
