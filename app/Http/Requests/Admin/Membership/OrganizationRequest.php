<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
        $parentRule = request()->parent_id == 0 ? '' : 'exists:organizations,id'; 
        
        if(request()->isMethod('POST')){
            return [
                'name' => 'required|min:2|max:100|unique:organizations,name',
                'parent_id' => 'required|'.$parentRule,
                'national_code' => 'nullable|unique:organizations,national_code',
                'manager_id' => 'nullable|exists:users,id', 
                'email' => 'nullable|email|max:100|unique:organizations,email',
                'phone' => 'nullable',
                'address' => 'max:250', 
                'website' => 'nullable|max:100',
                'logo' => 'image|mimes:png,jpg,jpeg,svg',
                'role.*' => 'nullable|exists:roles,id'
            ];
        } else { 
            return [
                'name' => 'required|min:2|max:100|unique:organizations,name,'.$this->organization->id,
                'parent_id' => 'required|'.$parentRule,
                'national_code' => 'nullable|unique:organizations,national_code,'.$this->organization->id,
                'manager_id' => 'nullable|exists:users,id', 
                'email' => 'nullable|email|max:100|unique:organizations,email,'.$this->organization->id,
                'phone' => 'nullable',
                'address' => 'max:250', 
                'website' => 'nullable|max:100',
                'logo' => 'image|mimes:png,jpg,jpeg,svg',
                'role.*' => 'nullable|exists:roles,id'
            ];
        }

    }
}
