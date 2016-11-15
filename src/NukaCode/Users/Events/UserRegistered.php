<?php

namespace JumpGate\Users\Events;

use Illuminate\Queue\SerializesModels;
use JumpGate\Users\Models\User;

class UserRegistered
{
    use SerializesModels;

    /**
     * @var \JumpGate\Users\Models\User
     */
    public $user;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
