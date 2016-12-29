<?php

namespace JumpGate\Users\Models\User;

class Preference extends \BaseModel
{
    protected $presenter = 'JumpGate\Users\Presenters\User\PreferencePresenter';

    protected $table = 'preferences';

    protected $fillable = [
        'name',
        'keyName',
        'description',
        'value',
        'default',
        'display',
        'hiddenFlag',
    ];

    protected $rules = [
        'name'    => 'required',
        'value'   => 'required',
        'default' => 'required',
        'display' => 'required',
    ];

    public function getPreferenceOptionsArray()
    {
        $preferenceOptions = explode('|', $this->value);
        $preferenceArray   = [];

        foreach ($preferenceOptions as $preferenceOption) {
            $preferenceArray[$preferenceOption] = ucwords($preferenceOption);
        }

        return $preferenceArray;
    }

    public function users()
    {
        return $this->belongsToMany('JumpGate\Users\Models\User', 'preference_users', 'user_id', 'preference_id');
    }
}
