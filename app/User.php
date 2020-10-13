<?php

namespace App;

use App\Models\Enterprise\Enterprise;
use App\Models\User\UserStatus;
use App\Models\User\UserType;
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
        'name',
        'email',
        'password',
        'enterprises_id',
        'user_type_id',
        'status',
        'phone',
        'picture',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userStatus()
    {
        return $this->belongsTo(UserStatus::class, 'user_status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class, 'enterprises_id', 'id');
    }

    public function list(){

    }
}
