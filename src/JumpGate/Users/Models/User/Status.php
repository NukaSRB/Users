<?php

namespace JumpGate\Users\Models\User;

use App\Models\BaseModel;
use Laravel\Socialite\AbstractUser;

class Status extends BaseModel
{
    protected $table = 'user_statuses';

    protected $fillable = [
        'name',
        'label',
    ];

    public function user()
    {
        return $this->hasOne(config('auth.providers.users.model'), 'status_id');
    }
}
