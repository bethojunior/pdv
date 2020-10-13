<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $table = 'user_status';

    protected $fillable = ['name'];

    protected $primaryKey = 'id';
}
