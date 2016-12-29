<?php

namespace JumpGate\Users\Models;

use App\Models\BaseModel;

class Permission extends BaseModel
{
    public $table = 'acl_permissions';

    /**
     * A permission can be applied to roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'acl_permission_role');
    }
}
