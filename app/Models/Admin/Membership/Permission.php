<?php

namespace App\Models\Admin\Membership;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;
    
    protected $guarded = ['id'];

    //relation to PermissionTables
    public function parent()
    {
        return $this->belongsTo(Permission::class,'parent_id','id');
    }

    public function children()
    {
        return $this->hasMany(Permission::class,'parent_id','id');
    }
}
