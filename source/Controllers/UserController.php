<?php

namespace Source\Controllers;

use Source\Models\User;

class UserController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): void
    {
        $users = $this->user->find() ->fetch(true);

        $response = [];

        foreach ($users as $user) {
            $response[] = $user->data();
        }

        echo response($response)->json();
    }
}
