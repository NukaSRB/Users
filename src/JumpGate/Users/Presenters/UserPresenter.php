<?php

namespace JumpGate\Users\Presenters;

use JumpGate\Core\Presenters\BasePresenter;

class UserPresenter extends BasePresenter
{
    /********************************************************************
     * Model attributes
     *******************************************************************/

    /**
     * Always uppercase a user's username
     *
     * @return string
     */
    public function username()
    {
        return ucwords($this->entity->username);
    }

    public function emailLink()
    {
        $preference = $this->getPreferenceValueByKeyName('SHOW_EMAIL');

        if ($preference == 'yes') {
            return \HTML::mailto($this->email, $this->email);
        }

        return null;
    }

    /********************************************************************
     * Preferences
     *******************************************************************/

    public function alertLocation()
    {
        $preference = $this->getPreferenceValueByKeyName('ALERT_LOCATION');

        switch ($preference) {
            case 'top-left':
                return 'messenger-on-top messenger-on-left';
            case 'top':
                return 'messenger-on-top';
            case 'top-right':
                return 'messenger-on-top messenger-on-right';
            case 'bottom-right':
                return 'messenger-on-bottom messenger-on-right';
            case 'bottom':
                return 'messenger-on-bottom';
            case 'bottom-left':
                return 'messenger-on-bottom messenger-on-left';
        }
    }

    public function popover()
    {
        return $this->getPreferenceValueByKeyName('POPOVER_TYPE');
    }

    public function image()
    {
        $avatarPreference = $this->getPreferenceValueByKeyName('AVATAR');

        if ($avatarPreference != 'none') {
            return $this->{$avatarPreference};
        } else {
            return '/img/no_user.png';
        }
    }

    public function avatar()
    {
        // get the users avatar if it exists
        if (file_exists(public_path() . '/img/avatars/User/' . \Str::studly($this->username) . '.png')) {
            return '/img/avatars/User/' . \Str::studly($this->username) . '.png';
        }

        // If no other image is set, use the default
        return '/img/no_user.png';
    }

    /**
     * Check for an avatar uploaded to the site, resort to gravatar if none exists, resort to no user image if no
     * gravatar exists
     *
     * @return string
     */
    public function gravatar()
    {
        // Check for valid gravatar
        $gravCheck = 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '.png?d=404';
        $response  = get_headers($gravCheck);

        // If a valid gravatar URL is found, use the gravatar image
        if ($response[0] != "HTTP/1.0 404 Not Found") {
            return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '.png?s=200&d=blank';
        }

        // If no other image is set, use the default
        return '/img/no_user.png';
    }

    public function onlyGravatar()
    {
        return 'http://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '.png';
    }

    /********************************************************************
     * New attributes
     *******************************************************************/

    public function profile()
    {
        return \HTML::link('/user/view/' . $this->id, $this->username);
    }

    public function roleList()
    {
        if ($this->roles->count() > 0) {
            return implode('<br />', $this->roles()->orderBy('group')->orderBy('priority')->get()->fullName->toArray());
        }

        return 'None';
    }

    /**
     * Get the number of posts from this user
     *
     */
    public function postsCount()
    {
        $postsCount   = $this->posts->count();
        $repliesCount = $this->replies->count();

        return $postsCount + $repliesCount;
    }

    /**
     * Get the user's css file
     *
     */
    public function theme()
    {
        return public_path() . '/css/master3/users/' . \Str::studly($this->username) . '.css';
    }

    /**
     * Get the user's css file for the laravel style method
     *
     */
    public function themeStyle()
    {
        return '/css/master3/users/' . \Str::studly($this->username) . '.css';
    }

    /**
     * Combine the user's first and last name to produce a full name
     *
     * @return string
     */
    public function fullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Make the join date easier to read
     *
     * @return string
     */
    public function joinDate()
    {
        return $this->createdAtReadable();
    }

    /**
     * Make the last active date easier to read
     *
     * @return string
     */
    public function lastActiveReadable()
    {
        return ($this->lastActive == '0000-00-00 00:00:00' || $this->lastActive == null ? 'Never' : date('F jS, Y \a\t h:ia', strtotime($this->lastActive)));
    }

    public function online($flip = false)
    {
        if ($this->lastActive >= date('Y-m-d H:i:s', strtotime('-15 minutes'))) {
            $status = ['<i class="text-success fa fa-circle"></i>', 'Online'];
        } else {
            $status = ['<i class="text-error fa fa-circle"></i>', 'Offline'];
        }

        if ($flip) {
            return implode('&nbsp;&nbsp;', array_reverse($status));
        }

        return implode('&nbsp;&nbsp;', $status);
    }

    public function onlineMaterialize($flip = false)
    {
        if ($this->lastActive >= date('Y-m-d H:i:s', strtotime('-15 minutes'))) {
            $status = ['<i class="green-text fa fa-circle"></i>', 'Online'];
        } else {
            $status = ['<i class="red-text fa fa-circle"></i>', 'Offline'];
        }

        if ($flip) {
            return implode('&nbsp;&nbsp;', array_reverse($status));
        }

        return implode('&nbsp;&nbsp;', $status);
    }
}
