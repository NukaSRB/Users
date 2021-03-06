<?php

namespace JumpGate\Users\Repositories;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Session;
use Laracasts\Commander\Events\EventGenerator;
use JumpGate\Users\Events\UserWasCreated;
use JumpGate\Core\Repositories\BaseRepository;
use JumpGate\Core\Ajax\Ajax;
use JumpGate\Core\View\Helpers\Crud;
use JumpGate\Core\View\Image;

class UserRepository extends BaseRepository
{
    use EventGenerator;

    /**
     * @var \Illuminate\Events\Dispatcher
     */
    protected $events;

    /**
     * @var \JumpGate\Core\Ajax\Ajax
     */
    protected $ajax;

    /**
     * @var \JumpGate\Core\View\Helpers\Crud
     */
    private $crud;

    public function __construct(\User $user, Dispatcher $events, Ajax $ajax, Crud $crud)
    {
        $this->model  = $user;
        $this->events = $events;
        $this->ajax   = $ajax;
        $this->crud   = $crud;
    }

    public function set($user)
    {
        if ($user instanceof \User) {
            $this->entity = $user;
        } else {
            throw new \InvalidArgumentException('Invalid user passed.');
        }
    }

    public function create($input)
    {
        $user            = new \User;
        $user->username  = $input['username'];
        $user->password  = $input['password'];
        $user->email     = $input['email'];
        $user->status_id = 1;

        if (isset($input['firstName'])) {
            $user->firstName = $input['firstName'];
        }

        if (isset($input['lastName'])) {
            $user->lastName = $input['lastName'];
        }

        $this->entity = $user;

        $result = $this->save();

        if ($result) {
            // Send out the event
            $this->raise(new UserWasCreated($this->getEntity()));
        }

        return $result;
    }

    /**
     * @param array $input
     */
    public function update($input)
    {
        $this->checkEntity();
        $this->requireSingle();

        $input = e_array($input);

        if ($input != null) {
            $this->entity->displayName = $this->arrayOrEntity('displayName', $input);
            $this->entity->firstName   = $this->arrayOrEntity('firstName', $input);
            $this->entity->lastName    = $this->arrayOrEntity('lastName', $input);
            $this->entity->email       = $this->arrayOrEntity('email', $input);
            $this->entity->location    = $this->arrayOrEntity('location', $input);
            $this->entity->url         = $this->arrayOrEntity('url', $input);

            $this->save();
        }
    }

    public function addRole($roleId)
    {
        $this->checkEntity();
        $this->requireSingle();

        try {
            $this->entity->roles()->attach($roleId);

            $this->save();
        } catch (\Exception $e) {
            $this->ajax->setStatus('error');
            $this->ajax->addError('role', $e->getMessage());

            return false;
        }
    }

    public function removeRole($roleId)
    {
        $this->checkEntity();
        $this->requireSingle();

        try {
            $this->entity->roles()->detach($roleId);

            $this->save();
        } catch (\Exception $e) {
            $this->ajax->setStatus('error');
            $this->ajax->addError('role', $e->getMessage());

            return false;
        }
    }

    public function setRoles($roleIds = [])
    {
        $this->checkEntity();
        $this->requireSingle();

        try {
            $this->entity->roles()->detach();

            if (count($roleIds) > 0) {
                $this->entity->roles()->attach($roleIds);
            }

            $this->save();
        } catch (\Exception $e) {
            $this->ajax->setStatus('error');
            $this->ajax->addError('roles', $e->getMessage());

            return false;
        }
    }

    public function updatePassword($input)
    {
        $this->checkEntity();
        $this->requireSingle();

        $input = e_array($input);

        try {
            $this->entity->verifyPassword($input);
        } catch (\Exception $e) {
            $this->ajax->setStatus('error');
            $this->ajax->addError('password', $e->getMessage());

            return false;
        }

        // Save the new password
        $this->entity->password = $input['new_password'];

        $this->save();
    }

    public function uploadAvatar($avatar, $username)
    {
        $image   = new Image;
        $results = $image->addImage(public_path('img/avatars/User'), $avatar, \Str::studly($username));

        return $results;
    }

    public function getVisiblePreferences()
    {
        return \User_Preference::where('hiddenFlag', 0)->orderByNameAsc()->get();
    }

    public function updatePreferenceByKeyName($preferenceKeyName, $preferenceValue)
    {
        $this->checkEntity();

        $preference = $this->getPreferenceByKeyName($preferenceKeyName);

        $this->setPreferenceValue($preference->id, $preferenceValue);
    }

    public function getPreferenceWithArray($preferenceKeyName)
    {
        $this->checkEntity();

        $preference      = $this->getPreferenceByKeyName($preferenceKeyName);
        $preferenceArray = $this->getPreferenceOptionsArray($preference->id);

        return [$preference, $preferenceArray];
    }

    public function getPreferenceByKeyName($preferenceKeyName)
    {
        $this->checkEntity();

        return $this->entity->getPreferenceByKeyName($preferenceKeyName);
    }

    public function getPreferenceOptionsArray($preferenceId)
    {
        $this->checkEntity();

        return $this->entity->getPreferenceOptionsArray($preferenceId);
    }

    public function setPreferenceValue($preferenceId, $preferenceValue)
    {
        $this->checkEntity();

        $this->entity->setPreferenceValue($preferenceId, $preferenceValue);
    }

    protected function checkEntity()
    {
        if ($this->entity == null) {
            $this->entity = Session::get('activeUser');
        }
    }
}
