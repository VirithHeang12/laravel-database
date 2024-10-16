<?php

namespace App\Services;

class BankService
{
    /**
     * Process the payment
     *
     * @return int
     */
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    public function processPayment(): int
    {
        return $this->paymentService->processPayment();
    }
}
