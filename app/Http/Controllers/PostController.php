<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        return view('post.index', ['posts' => Post::all()]);
    }

    public function create(){
        return view('post.create');
    }

    public function store(Request $request){
        /**
         * If you decide to validate your form data inside the controller instead of FormRequest class
         * but still you want to customize some behaviors that are not provided using the request()
         * method on the Request instance, you can do so by creating a Validator by yourself.
         */

        /**
         * This make() accepts four arguments. The first one is an array of data that should be
         * validated or knows as the input data provided from the form, the second one is an array
         * of rules basically what rules should be applied to what fields, the third argument is
         * an array of messages customization and the fourth is an array of attributes customization.
         * If you don't want to customize how data should be flashed to the session and where this
         * action should redirect then you may attach the validate(). This means you made changes
         * on the error messages and attribute names. But the rest is of functionality is as usual.
         */
        $validator = Validator::make(
            $request->only(['title', 'body']),
            [
                // alpha doesn't allow spaces ' '
                'title' => ['required','alpha', 'min:3'],
                'body' => ['required', 'alpha'],
            ],
            [
                'title.required' => 'Post must have a :attribute.'
            ],
            [
                'title' => 'post title'
            ]
        );

        /**
         * This is not more advance functionality than the CreatePostRequest offers. However if you
         * like to do the validation inside the controller and still change the where you redirect,
         * error messages and attribute names this is how you can do it.
         */

        // If you want to stop validation on the first failure.
        // if($validator->stopOnFirstFailure()->fails()){
        if($validator->fails()){
            return redirect()
            ->route('post.create')
            ->withInput()
            ->withErrors($validator);
            // ->withErrors($validator, 'bag name');
            // ->withErrors($validator->errors());
        }

        Post::create($request->only(['title', 'body']));
        return redirect()->route('post.index');
    }
}
