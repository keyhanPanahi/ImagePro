<?php

namespace App\Http\Controllers\Admin\Sevice;

use App\Http\Controllers\Controller;
use App\Models\Membership\Organization;
use App\Models\Membership\User;
use Illuminate\Http\Request;

class SelectController extends Controller
{
    public function selectOrganization(Request $request)
    {
        $search = $request->search;
        if ($search == ''){
            $organizations = Organization::orderBy('id','desc')->select('id','name')->limit(5)->get();
        }
        else{
            $organizations = Organization::orderBy('id','desc')->select('id','name')->where('name','like','%'.$search.'%')->limit(5)->get();
        }
        $response = array();
        foreach ($organizations as $organization) {
            $response[] = array(
                'id' => $organization->id,
                'text' => $organization->name
            );
        }
        return response()->json($response);
    }

    public function selectUser(Request $request)
    {
        $search = $request->search;
        if ($search == ''){
            $users = User::orderBy('id','desc')
            ->select('id','username','first_name', 'last_name')
            ->limit(5)
            ->get();
        }
        else{
            $users = User::orderBy('id','desc')
            ->select('id','username','first_name', 'last_name')
            ->where('username','like','%'.$search.'%')
            ->orWhere('first_name','like','%'.$search.'%')
            ->orWhere('last_name','like','%'.$search.'%')
            ->limit(5)
            ->get();
        }
        $response = array();
        foreach ($users as $user) {
            $response[] = array(
                'id' => $user->id,
                'text' => $user->username . ' - ' . $user->fullname
            );
        }
        return response()->json($response);
    }
}
