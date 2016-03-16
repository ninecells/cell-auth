<?php

namespace NineCells\Member\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialLogin extends Model
{
    protected $table = 'users_social_logins';

    protected $fillable = [
        'user_id', 'social_id', 'social_type', 'avatar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
