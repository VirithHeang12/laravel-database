<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BankService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AboutController extends Controller
{
    public function __construct(
        protected int $amount,
    ) {}
    public function index(Request $request, PaymentService $paymentService)
    {
       $bankService = App::make(BankService::class);
       $users = DB::table('users')->orderBy('name')->get();

       return view('about', [
           'users'     => $users,
           'payment'   => $bankService->processPayment(),
           'amount'    => $this->amount,
       ]);


    }
}
