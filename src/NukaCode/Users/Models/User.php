<?php

namespace JumpGate\Users\Models;

use App\Models\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use JumpGate\Users\Traits\HasRoles;

abstract class User extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, HasRoles, SoftDeletes, Notifiable;

    /**
     * Define the SQL table for this model
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'display_name',
        'timezone',
        'location',
        'url',
    ];

    /**
     * Tell eloquent to set deleted_at as a carbon date.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     * Determines if the users has global rights.
     *
     * @return mixed
     */
    public function isSuperUser()
    {
        if (config('jumpgate.users.allow_super_user') == true
            && $this->super_flag == 1
        ) {
            return true;
        }

        return false;
    }

    /**
     * Grant a user global rights.
     *
     * @return mixed
     */
    public function makeSuperUser()
    {
        if (config('jumpgate.users.allow_super_user') == true) {
            $this->super_flag = 1;
            $this->save();

            return true;
        }
        
        return false;
    }

    /**
     * Order by name ascending scope
     *
     * @param Builder $query The current query to append to
     *
     * @return Builder
     */
    public function scopeOrderByNameAsc($query)
    {
        return $query->orderBy('username', 'asc');
    }

    /**
     * Make sure to hash the user's password on save
     *
     * @param string $value The value of the attribute (Auto Set)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
