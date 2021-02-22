<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Repository\TransactionRepository;

class GetTotalTransaction extends UseCase
{
    public function __construct(private TransactionRepository $transactionRepository){}

    public function doExecute(?Request $request = null): Response
    {
        $currentTransactions = $this->transactionRepository->searchAll();
        $totalTransaction = 0;
        foreach ($currentTransactions as $currentCurrencyTransaction) {
            $coinTotal = $currentCurrencyTransaction->getAmount() * $currentCurrencyTransaction->getCoin()?->getValue();
            $totalTransaction = $totalTransaction + $coinTotal;
        }

        return new Response($totalTransaction);
    }
}