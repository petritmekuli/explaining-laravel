<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('post.index', ['posts' => Post::all()]);
    }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
        Post::create($request->only(['title', 'body']));
        return redirect()->route('post.index');
    }
}
