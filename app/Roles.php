<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\Observers\UserActionsObserver;

class Roles extends Model
{
    public static function boot()
    {
        parent::boot();

        Roles::observe(new UserActionsObserver);
    }

    protected $table = 'roles';

    protected $fillable = ['title'];

}
