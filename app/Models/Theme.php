<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    function createdBy(){
        return $this->belongsTo(Users::class,'created_by');
    }

    function updatedBy(){
        return $this->belongsTo(Users::class,'updated_by');
    }
}
