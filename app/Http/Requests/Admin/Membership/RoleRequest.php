<?php

namespace App\Http\Requests\Admin\Membership;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if (request()->isMethod('POST')) {
            return [
                'name' => 'required|unique:roles,name',
                'title' => 'required|unique:roles,title',
                'parent_id' => 'nullable|exists:roles,id',
            ];
        } else {
            return [
                'name' => 'required|unique:roles,name,' . $this->role->id,
                'title' => 'required|unique:roles,title,' . $this->role->id,
                'parent_id' => 'nullable|exists:roles,id',
            ];
        }
    }
    public function attributes()
    {
        return [
            'name' => 'کد یکتا',
            'title' => 'نام',
            'parent_id' => 'گروه'
        ];
    }
}
