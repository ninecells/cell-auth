<?php

namespace NineCells\Member\Models;

trait SocialLoginTrait
{
    public function getAvatarAttribute()
    {
        if ($this->socials->count() == 0) {
            return '';
        }

        return $this->socials->last()->avatar;
    }

    public function socials()
    {
        return $this->hasMany(SocialLogin::class, 'user_id');
    }
}
