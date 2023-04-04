<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use HasFactory;
    use SoftDeletes;

    function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->belongsTo(Posts::class, 'created_by');
    }

    function createdThemes(){
        return $this->hasMany(Theme::class,'created_by');
    }

    function updatedThemes(){
        return $this->hasMany(Theme::class,'updated_by');
    }

}
