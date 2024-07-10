<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SaveEventRequest extends FormRequest
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

/* 
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SaveEventRequest extends FormRequest
{ 
    public function authorize(): bool
    {
        return false;
    }

  
  
    public function rules(): array
    {
        return [
            'event_name' => 'required|max:50',
            'event_image' => 'required|max:150',
            'price' => 'required|numeric|decimal:0,2',            
            'expense_date' => 'required|date',
            'expense_time' => 'required',
        ];
    }
}
 */