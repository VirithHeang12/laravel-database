<?php

namespace App\Http\Controllers;

use App\Models\User;


class UserAllController extends Controller
{
    public function __invoke()
    {
        $users = User::where('date_of_birth', '<', now()->subYears(1))->get();
        return view('users.index', [
            'users'        => $users,
        ]);
    }
}
