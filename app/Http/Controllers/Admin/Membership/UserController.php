<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\UserRequest;
use App\Models\Admin\Membership\Role;
use App\Models\Membership\Organization;
use App\Models\Membership\Sex;
use App\Models\Membership\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $users = User::select('id','username','first_name','last_name','organization_id','avatar','status')->get();

            return DataTables::of($users)
            ->editColumn('avatar',function(User $user){
                $image = $user->sex_id == 1 ? env('AVATAR_WOMAN') : env('AVATAR_MAN'); 
                if($user->avatar){
                    '<img src='. asset(env('AVATAR_PATH').$user->avatar).' class="rounded-circle" width="35" height="35">';
                } else {
                    return '<img src='. asset($image).' class="rounded-circle" width="35" height="35">';
                }
            })
            ->addColumn('fullName',function(User $user){ 
                return $user->fullName; 
            })
            ->editColumn('organization_id',function(User $user){
                return $user->organization ? $user->organization->name : '';
            })
            ->addColumn('role', function(User $user){
                return view('admin.pages.membership.user.table.role',compact('user'));
            })
            ->editColumn('status',function(User $user){
                if($user->status == 0){
                    return '<span class="badge bg-label-danger">غیرفعال</span>';
                }
                else{
                    return '<span class="badge bg-label-success">فعال</span>';
                }
            })
            ->addColumn('action','admin.pages.membership.user.table.action')
            ->addColumn('select','admin.pages.membership.user.table.select')
            ->rawColumns(['avatar' ,'fullName' ,'status' , 'action' , 'select'])
            ->make(true);
        }

        $userRole = Role::where('name','users')->first();  
        $organizations = Organization::select('id','name')->get();
        return view('admin.pages.membership.user.index',compact('userRole','organizations'));
    }

    
    public function create()
    {
        $sexes = Sex::select('id','name')->where('status',1)->get();
        $role = Role::where('name','users')->first();
        return view('admin.pages.membership.user.create',compact('sexes','role'));
    }

    
    public function store(UserRequest $request)
    {
        $inputs = $request->all();

        if($request->hasFile('avatar')){
            $imageName = $request->username.'.'.$request->avatar->extension();
            $dir = 'admin-assets'.DIRECTORY_SEPARATOR.'file'.DIRECTORY_SEPARATOR.'avatar';
            $imagePath = $dir.DIRECTORY_SEPARATOR.$imageName;
            if(!file_exists($dir)){
                mkdir($dir, 0777, true);
            }

            Image::make($request->avatar)->resize(500,500)->save($imagePath, 15, 'jpg');
            $inputs['avatar'] = $imageName;
        }

        $inputs['password'] = Hash::make($request->password);
        $inputs['status'] = 1;

        $user = User::create($inputs);
        $user->syncRoles($request->role);

        return to_route('admin.membership.user.index')->with('toast-success','کاربر ایجاد گردید.');
    }

    
    public function show(User $user)
    {
        return view('admin.pages.membership.user.show',compact('user'));
    }

    
    public function edit(User $user)
    {
        $sexes = Sex::select('id','name')->where('status',1)->get();
        $role = Role::where('name','users')->first();
        return view('admin.pages.membership.user.edit',compact('user','sexes','role'));
    }

    
    public function update(UserRequest $request, User $user)
    {
        $inputs = $request->all();

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

            Image::make($request->avatar)->resize(500,500)->save($imagePath, 15, 'jpg');
            $inputs['avatar'] = $imageName;
        }

        if($request->password){
            $inputs['password'] = Hash::make($request->password);
        }
        else{
            unset($inputs['password']);
        }

        $user->update($inputs);

        $user->syncRoles($request->role);

        return to_route('admin.membership.user.index')->with('toast-success','کاربر ویرایش شد.');
    }

    
    public function destroy(Request $request)
    {
        if($request->ids){
            User::whereIn('id',$request->ids)->delete();
            return back()->with('toast-success','موارد انتخابی حذف گردید.');
        }

        return back()->with('toast-error','موردی انتخاب نشده است.');
    }


    public function status(Request $request)
    {
        if($request->ids){
            User::whereIn('id',$request->ids)->update(['status' => $request->status]);
            return back()->with('toast-success','وضعیت موارد انتخابی تغییر یافت.');
        }

        return back()->with('toast-error','موردی انتخاب نشده است.');
    }
}
