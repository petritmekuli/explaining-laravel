<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Not only that using FormRequest makes your controller shorter and cleaner but also
     * imagine that you have a PostController and you want to create the same one for the
     * API(mobile application) so inside the Controllers you create Api/PostController.php.
     * This means you are repeating yourself and the S(single responsibility) and DRY principles
     * are broken by doing the validation from the controller
     */

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //We are not going to deal with authorization that's what return true means.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','alpha', 'min:3'],
            'body' => ['required', 'alpha']
        ];
    }

    public function withValidator($validator){
        // if(!$validator->fails()){
            //runs after validation.
        // }
        $validator->after(function ($validator) {
            // dd('No errors but still a hit');

            if(($count = $validator->errors()->count()) >= 3){
                $validator->errors()->add('alert', 'Pay more attention, you can\'t get away with invalid data. You got ' . $count . ' errors.');
            }

            /**
             * Similarly you can check if form fields contain some of unaccepted words etc. For
             * example you want to make sure that your form is not going to be filled with dummy data
             * like lorem ipsum.
             */

            // dd($validator);
            // dd(get_class_methods($validator));
            $invalidWords = ['lorem', 'ipsum'];
            foreach($invalidWords as $invalidWord){
                if(str_contains($validator->getData()['title'], $invalidWord)){
                    $validator->errors()->add('invalid_word', "Title is not allowed to contain this word: $invalidWord ");
                }
            }
        });
    }
}
