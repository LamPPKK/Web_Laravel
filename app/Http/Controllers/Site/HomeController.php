<?php

namespace App\Http\Controllers\Site;

use App\Entity\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //
    public function index()
    {
        $posts = Post::get();
        return view('site.defaults.index',compact('posts'));
    }
}
