<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    private $category;
    public function __construct(Category $category){
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categorys = $this->category->getAll()->toJson();
        return view('admin.categorys.index',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
      
        return view('admin.categorys.create');
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
        Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'type'  => 'required',
            ]
        )->validate();
        // try {
            $data = $request->all();
            $data['slug'] = $request->title;
            // dd($data);
            Category::create($data);
            $request->session()->flash('success', 'Thêm danh mục thành công');

            return redirect()->route('admin.categorys.index');
        // } catch (Exception $e) {
        //     $request->session()->flash('error', 'Thêm danh mục thất bại');
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        dd($category);
        return view('admin.categorys.create');
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
}
