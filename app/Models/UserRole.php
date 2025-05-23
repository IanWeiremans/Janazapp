<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'role_name',
    ];

    // If a UserRole has multiple users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
