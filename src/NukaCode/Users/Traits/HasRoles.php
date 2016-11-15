<?php

namespace JumpGate\Users\Traits;

use JumpGate\Users\Models\Permission;
use JumpGate\Users\Models\Role;

trait HasRoles
{
    /**
     * A user may have multiple roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'acl_role_user');
    }

    /**
     * Assign the given role to the user.
     *
     * @param  string $role
     *
     * @return mixed
     * @throws \Exception
     */
    public function assignRole($role)
    {
        if (Role::count() === 0) {
            throw new \Exception('No roles have been created.');
        }

        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Determine if the user has the given role.
     *
     * @param  mixed $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return ! ! $role->intersect($this->roles)->count();
    }

    /**
     * Determine if the user may perform the given permission.
     *
     * @param  Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return $this->hasRole($permission->roles);
    }
}
