<?php

namespace JumpGate\Users\Services;

use Illuminate\Auth\AuthManager;
use Illuminate\Config\Repository;

class RegistrationService
{
    private $user;

    private $auth;

    private $config;

    public function __construct(\User $user, AuthManager $auth, Repository $config)
    {
        $this->user   = $user;
        $this->auth   = $auth;
        $this->config = $config;
    }

    public function register(array $user)
    {
        // Create the new user
        $result = $this->user->create($user);

        if ($result) {
            // Assign the guest role
            $this->user->addRole($this->config->get('jumpgate.users.main.guest'));

            // Log the user in
            $this->auth->login($this->user->getEntity());
        }

        return $result;
    }
}
