<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name','nik', 'nama_lengkap', 'telp', 'role', 'email', 'password', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setRoleIdAttribute($input)
    {
        $this->attributes['id'] = $input ? $input : null;
    }

    public function roles() {
        return $this->belongsToMany(Role::class, 'id');
    }

    public function isAdmin()
    {
        foreach ($this->role()->get() as $role) {
            if ($role->id == '1') {
                return true;
            }
        }

        return false;
    }
    public function artikel(){
    	return $this->hasMany(Artikel::class);
    }
}

