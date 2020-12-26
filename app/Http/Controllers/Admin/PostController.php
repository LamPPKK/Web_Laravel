<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::get();
        return view('admin.posts.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.posts.create');
    }
    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'slug' => 'required',
                'image' => 'required',
                'description' => 'required',
                'content' => 'required',
            ]
        )->validate();
        try {
            // DB::transaction();
            $data = $request->all();
            $data['type_post'] = 1;
            Post::create($data);
            // DB::commit();
            $request->session()->flash('success', 'Thêm sản phẩm thành công');
            // dd(session('success'));

            return redirect()->route('admin.posts.index');
        } catch (Exception $e) {
            // DB::rollBack();
            $request->session()->flash('error', 'Thêm sản phẩm thành công');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post'));
    }
    public function update(Request $request, $id)
    {
        Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'slug' => 'required',
                'image' => 'required',
                'description' => 'required',
                'content' => 'required',
            ]
        )->validate();
        try {
           
            $data = $request->all();
            $data['type_post'] = 1;
            $post = Post::find($id);
            $post->update($data);
            $request->session()->flash('success', 'Cập nhật sản phẩm thành công');
            return redirect()->route('admin.posts.edit',$id);
        } catch (Exception $e) {
            // DB::rollBack();
            $request->session()->flash('error', 'Cập nhật sản phẩm thành công');
            return redirect()->back();
        }
        $request->session()->flash('error', 'Cập nhật sản phẩm thành công');
        return redirect()->route('admin.posts.index');
    }
}
