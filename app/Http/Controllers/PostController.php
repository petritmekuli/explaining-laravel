<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
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

    public function store(StorePostRequest $request){
        /**
         * We are using StorePostRequest to validate.
         * If we reached this action it means all the data were valid data
         */

        // Post::create($request->validated());
        Post::create($request->only(['title', 'body']));
        return redirect()->route('post.index');
    }
}
