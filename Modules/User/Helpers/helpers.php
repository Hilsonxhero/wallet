<?php

use Modules\User\Repository\Contracts\UserRepository;

if (!function_exists('userRepo')) {
    /**
     * Get the User Repository.
     *
     * @return UserRepository
     */
    function userRepo(): UserRepository
    {
        return resolve(UserRepository::class);
    }
}
