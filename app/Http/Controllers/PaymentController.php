<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request) {
        $users = User::all();

        return $users;
    }
}
