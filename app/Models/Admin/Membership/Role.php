<?php

namespace App\Models\Admin\Membership;


use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Traits\HasPermissions;

class Role extends SpatieRole
{
    use HasFactory,HasPermissions;
    
    protected $guarded = ['id'];

    //relation to rolesTable
    public function parent()
    {
        return $this->belongsTo(Role::class,'parent_id','id');
    }

    public function children()
    {
        return $this->hasMany(Role::class,'parent_id','id');
    }
}
