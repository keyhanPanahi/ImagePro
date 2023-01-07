<?php

namespace App\Http\Controllers\Admin\Membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Membership\OrganizationRequest;
use App\Models\Admin\Membership\Role;
use App\Models\Membership\Organization;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Intervention\Image\ImageManagerStatic as Image;

class OrganizationController extends Controller
{
    public function index(Request $request)
    {
        $organizations = Organization::select('id', 'name', 'parent_id', 'logo', 'manager_id', 'status')->orderByDesc('id')->get();

        if ($request->ajax()) {
            return DataTables::of($organizations)
                ->editColumn('logo', function (Organization $organization) {
                    if ($organization->logo) {
                        return '<img src=' . asset(env('AVATAR_PATH') . $organization->logo) . ' class="rounded-circle" width="35" height="35">';
                    } else {
                        return '<img src=' . asset(env('AVATAR_ORG')) . ' class="rounded-circle" width="35" height="35">';
                    }
                })
                ->editColumn('name', function (Organization $organization) {
                    return $organization->name;
                })
                ->editColumn('parent_id', function (Organization $organization) {
                    return $organization->parent ? $organization->parent->name : '-';
                })
                ->editColumn('status', function (Organization $organization) {
                    return $organization->status == 1 ? '<small class="badge bg-label-success"> تایید شده </small>' : '<small class="badge bg-label-danger"> تایید نشده </small>';
                })
                ->addColumn('action', 'admin.pages.membership.organization.table.action')
                ->addColumn('select', 'admin.pages.membership.organization.table.select')
                ->rawColumns(['logo', 'name', 'parent_id', 'status', 'action', 'select'])
                ->make(true);
        }

        return view('admin.pages.membership.organization.index');
    }


    public function create()
    {
        $organizationRoles = Role::where('name','organizations')->first(); 
        return view('admin.pages.membership.organization.create', compact('organizationRoles'));
    }


    public function store(OrganizationRequest $request)
    {
        $inputs = $request->all();
        $inputs['status'] = 1;
        if ($request->parent_id == 0) {
            unset($inputs['parent_id']);
        }
        //upload logo
        if ($request->hasFile('logo')) {
            $imageName = uniqid() . '.' . $request->logo->extension();
            $dir = 'admin-assets' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR . 'avatar';
            $imagePath = $dir . DIRECTORY_SEPARATOR . $imageName;
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            Image::make($request->logo)->resize(500, 500)->save($imagePath, 15, 'jpg');
            $inputs['logo'] = $imageName;
        }
        $org = Organization::create($inputs);
        $org->syncRoles($request->role);
        return to_route('admin.membership.organization.index')->with('toast-success', 'سازمان ایجاد گردید.');
    }


    public function show(Organization $organization)
    {
        $organizationRoles = Role::where('name','organizations')->first(); 
        return view('admin.pages.membership.organization.show', compact('organization','organizationRoles'));
    }


    public function edit(Organization $organization)
    {    
        $organizationRoles = Role::where('name','organizations')->first();  
        return view('admin.pages.membership.organization.edit', compact('organization','organizationRoles'));
    }


    public function update(OrganizationRequest $request, Organization $organization)
    {
        $inputs = $request->all();
        if($request->hasFile('logo')) {
            //remove old logo
            if ($organization->logo != null) {
                if (file_exists(public_path(env('AVATAR_PATH') . $organization->logo))) {
                    unlink(public_path(env('AVATAR_PATH') . $organization->logo));
                }
            }

            $imageName = uniqid() . '.' . $request->logo->extension();
            $dir = 'admin-assets' . DIRECTORY_SEPARATOR . 'file' . DIRECTORY_SEPARATOR . 'avatar';
            $imagePath = $dir . DIRECTORY_SEPARATOR . $imageName;
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            Image::make($request->logo)->resize(500, 500)->save($imagePath, 15, 'jpg');
            $inputs['logo'] = $imageName;
        }
        if ($request->parent_id == 0) {
            unset($inputs['parent_id']);
        }
        $organization->update($inputs);
        $organization->syncRoles($request->role);
        return to_route('admin.membership.organization.index')->with('toast-success', 'سازمان ویرایش گردید.');
    }
 
    
    public function destroy(Request $request)
    {
        if($request->ids) {
            Organization::whereIn('id',$request->ids)->delete();
            return to_route('admin.membership.organization.index')->with('toast-success','موارد انتخابی حذف گردید.');
        }  
        return to_route('admin.membership.organization.index')->with('toast-error','موردی انتخاب نشده است.');
    }


    public function status(Request $request)
    {
        if($request->ids) {
            Organization::whereIn('id',$request->ids)->update(['status' => $request->status]);
            return to_route('admin.membership.organization.index')->with('toast-success','وضعیت موارد انتخابی تغییر یافت.');
        } 

        return to_route('admin.membership.organization.index')->with('toast-error','موردی انتخاب نشده است.');
    }
}
