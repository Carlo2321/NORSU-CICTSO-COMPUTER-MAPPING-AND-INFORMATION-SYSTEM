<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Activity extends Model
{
    use HasFactory;
    
    public function causer()
    {
        return $this->belongsTo(\App\Models\User::class, 'causer_id');
    }
}
