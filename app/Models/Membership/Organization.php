<?php

namespace App\Models\Membership;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Organization extends Model
{
    use HasFactory, HasRoles, SoftDeletes, Sluggable;

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return ['slug' => ['source' => 'name']];   
    }

    protected $guard_name = 'web';

    //relations
    public function parent()
    {
        return $this->belongsTo(Organization::class, 'parent_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

}
