<?php

namespace JumpGate\Users\Models\User\Preference;

use App\Models\BaseModel;

class User extends BaseModel
{
    protected $table = 'preferences_users';

    protected static $observer = 'JumpGate\Users\Models\Observers\User\Preference\UserObserver';

    public function validateValue()
    {
        return (preg_match('/' . $this->preference->value . '/', $this->value) == 1 ? true : false);
    }

    public function user()
    {
        return $this->belongsTo('JumpGate\Users\Models\User', 'user_id');
    }

    public function preference()
    {
        return $this->belongsTo('JumpGate\Users\Models\User\Preference', 'preference_id');
    }
}
