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
        /**
         * The simplest form to validate a from request is using a validate() function
         * that is available to the $request object. This function not only that makes sure
         * the form data meet the constrains set by rules. Also makes sure that the error
         * messages and old input form data are going to be flashed in the session. As well
         * redirect back to the same view where the form has been submitted. Error messages
         * are shared to the views through a middleware called ShareErrorsFromSession
         * which pulls the errors form session if there are any, and shares the $errors
         * attribute to all the views. That's how $errors inside the view files is set.
         * $errors is an instance of MessageBag, so there are some helpful methods available.
         * $errors is available in every view so even if there are no errors it will have null
         * value but no extra isset checks needed. Similar functionality could have been applied
         * through ServiceProviders using Facades\View::share(). Beside validation rules that's
         * all about validation using validate() on the request. Editing messages using this way
         * can be changed only in the lang/xx/validation.php. This is because most of the times
         * you don't need to make any changes. But if there are times then you could create a custom
         * validation instance using Validator::make();
         */

        // Validating the request input
        $request->validate([
            'title' => ['required','alpha', 'min:3'],
            'body' => ['required', 'alpha']
        ]);

        Post::create($request->only(['title', 'body']));
        return redirect()->route('post.index');
    }
}
