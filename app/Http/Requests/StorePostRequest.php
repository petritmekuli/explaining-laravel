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

    /**
     * That's all you have to do to be able to validate form as you were using the request validate().
     * But unlike the validate() method you can customize some behaviors, error messages etc. When
     * using FormRequests.
     */
}
