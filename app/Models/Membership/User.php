<?php

namespace App\Models\Membership;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions, SoftDeletes, Sluggable;
    
    public function sluggable(): array
    {
        return ['slug' => ['source' => 'username']];   
    }

    protected $guarded = ['id'];
    
    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];

    //scope admin
    public function scopeAdmin()
    {
        return User::has('roles');
    }

    //full name
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    //relations
    public function organization()
    {
        return $this->belongsTo(Organization::class , 'organization_id');
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class,'sex_id');
    }
}
