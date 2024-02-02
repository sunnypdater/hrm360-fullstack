<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'gender',
        'level',
        'position',
        'role',
        'department',
    ];

    public function user()
    {
        return $this->belongsTo('users');
    }
}
