<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Membership\PermissionRequest;
use App\Models\Admin\Membership\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{

    public function index(Request $request){
        if ($request->ajax()) {
            return DataTables::of(Permission::select('id','name','title','parent_id')->orderByDesc('id')->get())
                ->editColumn('title',function (Permission $permission) {
                    return $permission->title;
                })
                ->editColumn('name',function (Permission $permission) {
                    return $permission->name;
                })
                ->editColumn('parent', function (Permission $permission) {
                    if($permission->parent){
                        if($permission->parent_id % 2 == 0)
                        {
                            return '<span class="badge bg-label-warning m-1">'. $permission->parent->title .'</span>' ;
                        }
                        else {
                            return '<span class="badge bg-label-primary m-1">'. $permission->parent->title .'</span>' ;
                        }
                    }
                })
                ->addColumn('action','admin.pages.membership.permission.table.action')
                ->addColumn('select','admin.pages.membership.role.table.select')
                ->rawColumns(['parent','action','select'])
                ->make(true);
        }
        //filter groups of roles => users-role and organizations-roles
        $permissionGroups = Permission::where('parent_id',null)->get();
        return view('admin.pages.membership.permission.index',compact('permissionGroups'));
    }

    public function create()
    {
        $groups =  Permission::where('parent_id',null)->orderBy('id','DESC')->get();
        return view('admin.pages.membership.permission.create',compact('groups'));
    }

    public function store(PermissionRequest $request)
    {
        $inputs = $request->all();
        $permission = Permission::create($inputs);
        return redirect()->route('admin.membership.permission.index')->with('toast-success','مجوز دسترسی ثبت گردید');
    }

    public function edit(Permission $permission)
    {
        $groups =  Permission::where('parent_id',null)->orderBy('id','DESC')->get();
        return view('admin.pages.membership.permission.edit',compact('groups','permission'));
    }

    public function update(PermissionRequest $request,Permission $permission){
        $inputs = $request->all();
        $permission->update($inputs);
        return redirect()->route('admin.membership.permission.index')->with('toast-success','مجوز دسترسی ویرایش گردید');
    }

    public function destroy(Request $request)
    {
        if($request->ids != null){
            $permissions = Permission::whereIn('id',$request->ids)->delete();
            return redirect()->route('admin.membership.permission.index')->with('toast-success','مجوزهای انتخاب شده حذف گردید');
        }
        else{
            return redirect()->route('admin.membership.permission.index')->with('toast-error','موردی انتخاب نشده است');

        }
    }
}
