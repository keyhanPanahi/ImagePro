<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->isMethod('post')){
            return [
                'username' => 'required|digits:10|unique:users,username',
                'email' => 'nullable|email|min:5|max:100|unique:users,email',
                'password' => ['required' , 'min:8' , 'confirmed'],
                'first_name' => 'required|min:2|max:50',
                'last_name' => 'required|min:2|max:50',
                'sex_id' => 'required|exists:sexes,id',
                'mobile' => 'required|digits:11|unique:users,mobile',
                'address' => 'nullable|min:5|max:200',
                'avatar' => 'nullable|image|mimes:png,jpg,jpeg,webp',
                'organization_id' => 'required|exists:organizations,id',
                // 'role.*' => ''
            ];
        }
        else{
            return [
                'username' => 'required|digits:10|unique:users,username,'.$this->user->id,
                'email' => 'nullable|email|min:5|max:100|unique:users,email,'.$this->user->id,
                'password' => ['nullable' , 'min:8' , 'confirmed'],
                'first_name' => 'required|min:2|max:50',
                'last_name' => 'required|min:2|max:50',
                'sex_id' => 'required|exists:sexes,id',
                'mobile' => 'required|digits:11|unique:users,mobile,'.$this->user->id,
                'address' => 'nullable|min:5|max:200',
                'avatar' => 'nullable|image|mimes:png,jpg,jpeg,webp',
                'organization_id' => 'required|exists:organizations,id',
                // 'role.*' => ''
            ];
        }
    }
}
