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

    /** As Laravel supposes you redirect back to the file that fires the submit action almost everytime.
     * However you can customize this behavior by providing one of the two attributes below.
     */
    // protected $redirect = '/post';
    // protected $redirectRoute = 'post.index';

    /**
     * Again as Laravel supposes you would like to have all the error messages for each field. This
     * means it will validate all the fields and add the specific errors for each of them in the messageBag.
     * However if you will you can validate the form until a field breaks a rule. If that happens the
     * validation will stop and the error messages for that field will be set to the messageBag.
     */
    // protected $stopOnFirstFailure = true;

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
     * To show that the messages are being customized from the messages() below I commented all the
     * changes made to the lang/en/validation.php file. And that means the messages are as Laravel
     * provides by default and made some changes inside the messages() method below.
     */
    public function messages()
    {
        return [
            'title.required' => ':attribute is required.',
            'body.alpha' => ':attribute should contain only letters.',
        ];
    }

    //Similar functionality as messages(), but the changes apply to the :attribute
    public function attributes(){
        return [
            'title' => 'post title',
            'body' => 'post body',
        ];
    }

    /**
     * That's all you have to do to be able to validate form as you were using the request validate().
     * But unlike the validate() method you can customize some behaviors, error messages etc. When
     * using FormRequests.
     */
}
