<?php

namespace NineCells\Member\Models;

trait SocialLoginTrait
{
    public function getAvatarAttribute()
    {
        return $this->socials->last()->avatar;
    }

    public function socials()
    {
        return $this->hasMany(SocialLogin::class, 'user_id');
    }
}
