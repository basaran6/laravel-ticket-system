<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' =>  'required|max:100',
            'body'  =>  'required',
            'ticket_type_id'   =>  'required|exists:ticket_types,id',
            'ticket_priority_id'    => 'required|exists:ticket_priorities,id'
        ];
    }
}
