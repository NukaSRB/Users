<?php

namespace JumpGate\Users\Traits;

class HasPreferences
{
    public function preferences()
    {
        return $this->belongsToMany('JumpGate\Users\Models\User\Preference', 'preferences_users', 'user_id', 'preference_id')
                    ->withPivot('value')
                    ->orderBy('id', 'asc');
    }

    public function getVisiblePreferences()
    {
        return Preference::where('hiddenFlag', 0)->orderByNameAsc()->get();
    }

    public function updatePreferenceByKeyName($preferenceKeyName, $preferenceValue)
    {
        $preference = $this->getPreferenceByKeyName($preferenceKeyName);

        $this->setPreferenceValue($preference->id, $preferenceValue);
    }

    public function getPreferenceValueByKeyName($preferenceKeyName)
    {
        $preference = Preference::where('keyName', $preferenceKeyName)->first();

        if ($preference != null) {
            $userPreference = UserPreferenceUser::where('preference_id', $preference->id)->where('user_id', $this->id)->first();

            if ($userPreference == null) {
                return $preference->default;
            }

            return $userPreference->value;
        }
    }

    public function getPreferenceByKeyName($preferenceKeyName)
    {
        $preference = Preference::where('keyName', $preferenceKeyName)->first();

        if ($preference != null) {
            $userPreference = PreferenceUser::where('preference_id', $preference->id)->where('user_id', $this->id)->first();

            if ($userPreference == null) {
                $userPreference                = new PreferenceUser();
                $userPreference->user_id       = $this->id;
                $userPreference->preference_id = $preference->id;
                $userPreference->value         = $preference->default;
                $userPreference->save();
            }

            return $userPreference;
        }

        return null;
    }

    public function getPreferenceById($preferenceId)
    {
        return UserPreferenceUser::find($preferenceId);
    }

    public function getPreferenceValue($keyName)
    {
        $preference = $this->getPreferenceByKeyName($keyName);

        return $preference->value;
    }

    public function getPreferenceOptionsArray($id)
    {
        $preference = $this->getPreferenceById($id);

        $preferenceOptions = explode('|', $preference->preference->value);
        $preferenceArray   = [];

        foreach ($preferenceOptions as $preferenceOption) {
            $preferenceArray[$preferenceOption] = ucwords($preferenceOption);
        }

        return $preferenceArray;
    }

    public function setPreferenceValue($id, $value)
    {
        $preference = $this->getPreferenceById($id);

        if ($value != $preference->value) {
            $preference->value = $value;

            if (! $preference->save()) {
                throw new \Exception($preference->getErrors());
            }
        }
    }

    public function resetPreferenceToDefault($id)
    {
        $preference = $this->getPreferenceById($id);

        $preference->value = $preference->preference->default;
        $preference->save();

        return $this;
    }
}
