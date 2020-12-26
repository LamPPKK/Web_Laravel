<?php

namespace App\Http\Controllers\Site;

use App\Entity\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //
    public function index($slug)
    {
        $post = Post::where('slug',$slug)->first();
        // dd($post);

        return view('site.defaults.post',compact('post'));
    }
}
