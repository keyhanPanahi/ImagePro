<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\Profile\ChangeAvatarRequest;
use App\Http\Requests\Admin\Membership\Profile\ChangeProfileInformationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('admin.pages.membership.profile',compact('user'));
    }


    public function changeAvatar(ChangeAvatarRequest $request)
    {
        $inputs = $request->all();
        $user = Auth::user();

        if($request->hasFile('avatar')){
            if($user->avatar){
                unlink(env('AVATAR_PATH').$user->avatar);
            }

            $imageName = $user->username.'.'.$request->avatar->extension();
            $dir = 'admin-assets'.DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.'avatar';
            $imagePath = $dir.DIRECTORY_SEPARATOR.$imageName;
            if(!file_exists($dir)){
                mkdir($dir, 0777, true);
            }

            Image::make($request->avatar)->resize(335,335)->save($imagePath, 15, 'jpg');
            $inputs['avatar'] = $imageName;

            $user->update($inputs);
            return to_route('admin.membership.profile')->with('toast-success','آواتار تغییر گردید.');
        }

        return to_route('admin.membership.profile')->with('toast-error','تصویری انتخاب نشده است.');
    }


    public function changeProfileInformation(ChangeProfileInformationRequest $request)
    {
        $inputs = $request->all();
        $user = Auth::user();

        $user->update($inputs);

        return to_route('admin.membership.profile')->with('toast-success','اطلاعات حساب تغییر گردید.');
    }
}
