<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\RoleRequest;
use App\Models\Admin\Membership\Role;
use Illuminate\Http\Request;
use App\Models\Admin\Membership\Permission;
use Yajra\DataTables\Facades\DataTables;


class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Role::select('id', 'name', 'title', 'parent_id')->orderByDesc('id')->get())
                ->editColumn('title', function (Role $role) {
                    return $role->title;
                })
                ->editColumn('name', function (Role $role) {
                    return $role->name;
                })
                ->editColumn('parent', function (Role $role) {
                    if ($role->parent) {
                        if ($role->parent_id % 2 == 0) {
                            return '<span class="badge bg-label-warning m-1">' . $role->parent->title . '</span>';
                        } else {
                            return '<span class="badge bg-label-primary m-1">' . $role->parent->title . '</span>';
                        }
                    }
                })
                ->addColumn('action', 'admin.pages.membership.role.table.action')
                ->addColumn('select', 'admin.pages.membership.role.table.select')
                ->rawColumns(['action', 'parent', 'select'])
                ->make(true);
        }
        $roleGroups = Role::where('parent_id', null)->get();
        return view('admin.pages.membership.role.index', compact('roleGroups'));
    }


    public function create()
    {
        $groups =  Role::where('parent_id', null)->orderBy('id', 'DESC')->get();
        $permissions = Permission::where('parent_id', null)->has('children')->orderBy('id', 'DESC')->get();
        return view('admin.pages.membership.role.create', compact('permissions', 'groups'));
    }


    public function store(RoleRequest $request)
    {
        $inputs = $request->all();
        $role = Role::create($inputs);
        $role->syncPermissions($request->permission);
        return redirect()->route('admin.membership.role.index')->with('toast-success', 'نقش ثبت گردید');
    }


    public function edit(Role $role)
    {
        $groups =  Role::where('parent_id', null)->orderBy('id', 'DESC')->get();
        $permissions = Permission::where('parent_id', null)->has('children')->orderBy('id', 'DESC')->get();
        return view('admin.pages.membership.role.edit', compact('groups', 'role', 'permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $inputs = $request->all();
        $role->update($inputs);
        $result = $role->syncPermissions($request->permission);
        return redirect()->route('admin.membership.role.index')->with('toast-success', 'نقش ویرایش گردید');
    }


    public function destroy(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $role = Role::where('id', $id)->first();
                if ($role->permissions) {
                    $role->permissions()->detach();
                }
                $role->delete();
            }
            return to_route('admin.membership.role.index')->with('toast-success', 'موارد انتخابی حذف گردید.');
        }
        return redirect()->route('admin.membership.role.index')->with('toast-error', 'موردی انتخاب نشده است');
    }
}
