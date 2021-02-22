<?php

namespace App\VendorMachine\Domain\Services;

use App\VendorMachine\Domain\Repository\TransactionRepository;

class ResetTransaction
{
    private TransactionRepository $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function reset(): void
    {
        $this->transactionRepository->reset();
    }
}