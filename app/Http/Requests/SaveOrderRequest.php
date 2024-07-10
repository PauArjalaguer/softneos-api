<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SaveOrderRequest extends FormRequest
{ 
    public function authorize(): bool
    {
        return false;
    }

  
    public function rules(): array
    {
        return [
           'user_name'=> 'required|min:5|max:50',
           'user_email'=>'required|email'
        ];
    }
}
