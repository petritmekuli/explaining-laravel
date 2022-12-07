<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

use App\Rules\StartsWithUppercase;

class PostController extends Controller
{
    public function index(){
        return view('post.index', ['posts' => Post::all()]);
    }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
            $request->validate(
                [
                    'title' => ['required','alpha', 'min:3', new StartsWithUppercase()],
                    'body' => ['required', 'alpha', function($attributeName, $attributeValue, $fail){
                        if(! preg_match('/[A-Z]/', $attributeValue[0])){
                            // $fail(trans('validation.starts_with_uppercase'));
                            // $fail("The $attributeName field must start with Uppercase.");

                            $attributeValue[0] = strtoupper($attributeValue[0]);
                            $fail(__('validation.starts_with_uppercase', ['validValue'=>$attributeValue], 'al'));
                        }
                    }],
                ],
                [
                    //Overriding error messages.

                    // 'title.required' => 'test',
                    // 'title.' . StartsWithUppercase2::class => 'Overriding the rule message.',
                ]
            );

        Post::create($request->only(['title', 'body']));
        return redirect()->route('post.index');
    }
}
