<?php

namespace JumpGate\Users\Models\User;

use App\Models\BaseModel;
use Laravel\Socialite\AbstractUser;

class Social extends BaseModel
{
    protected $table = 'user_socials';

    protected $fillable = [
        'user_id',
        'provider',
        'social_id',
        'email',
        'avatar',
        'token',
        'refresh_token',
        'expires_in'
    ];

    public function updateFromProvider(AbstractUser $socialUser, $provider)
    {
        $attributes = [
            'user_id'       => $this->user_id,
            'provider'      => $provider,
            'social_id'     => $socialUser->getId(),
            'email'         => $socialUser->getEmail(),
            'avatar'        => $socialUser->getAvatar(),
            'token'         => $socialUser->token,
            'expires_in'    => $socialUser->expiresIn,
        ];

        if (isset($socialUser->refreshToken) && $socialUser->refreshToken) {
            $attributes['refresh_token'] = $socialUser->refreshToken;
        }

        $this->updateOrCreate(array_only($attributes, ['user_id', 'provider', 'email']), $attributes);
    }

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'user_id');
    }
}
