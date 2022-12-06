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
         * Typically a relationship between a user and a post would be a many to many relationship.
         * However in this case we are using an array to store user(writer) data just to show how
         * array validation works.
         */
        $user = [
            'name' => 'Petrit',
            'email' => 'petrit@example.com',
            // 'favorite_category' => 'SomeCategory'
        ];

        $request->merge(['user' => $user]);

        Validator::make(
            $request->only(['title', 'body', 'categories', 'user']),
            [
                // alpha doesn't allow spaces ' '
                'title' => ['required','alpha', 'min:3'],
                'body' => ['required', 'alpha'],
                'categories.*' => ['nullable', 'min:2'],
                'categories.0' => ['required', 'min:3'], //Overriding nullable and min:2
                /**
                 * Each key in the array we are validating should have an associated key in the
                 * validation rule keys. If we try to send more keys with array than we are
                 * expecting in the validation rule list, an exception will be thrown.
                 * */
                'user' => ['required', 'array:name,email']
            ],
            [
                // :index is also available to be used.
                // 'categories.*.required' => "The categories #:position field is required"
            ],
            [
                'categories.*' => 'categories #:position'
            ]
        )->validate();

        /**
         * data from form: title='Title', body='Body', categories #1='first', categories #2=null
         * but sizeof($request->input('categories')); is still 2. But we would like the size of
         * categories array to be the same as the number of categories provided in the form. And
         * not as all the categories form fields provided. We can use array_filter().
         */
        $request->merge(
            ['categories' => array_filter($request->categories, function($value){
                    /** This is what array_filter does by default. So in this case no need to provide this
                     * closure. However if some if condition needed, this is how you do it. Return false
                     * means remove that element from array.
                     */
                    return $value !== null;
                })
            ]
        );

        /**
         * These categories aren't being associated with the created post, because this was meant to
         * only show how array validation works. And to store these categories to database, first
         * categories table should be created and a relationship many to many with posts table.
         * After that you associate categories to the created post.
         */
        Post::create($request->only(['title', 'body']));
        return redirect()->route('post.index');
    }
}
