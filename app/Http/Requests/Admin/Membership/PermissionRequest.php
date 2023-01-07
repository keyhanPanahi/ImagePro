<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
        if(request()->isMethod('POST')){
            return [
                'name'=>'required|unique:permissions,name',
                'title'=>'required|unique:permissions,title',
                'parent_id'=>'nullable|exists:permissions,id',
            ];
        }else{
            return [
                'name'=>'required|unique:permissions,name,'.$this->permission->id,
                'title'=>'required|unique:permissions,title,'.$this->permission->id,
                'parent_id'=>'nullable|exists:permissions,id',
            ];
        }
    }
    public function attributes()
    {
        return [
            'name' => 'کد یکتا',
            'title' => 'نام',
            'parent_id'=>'گروه'
        ];
    }
}
