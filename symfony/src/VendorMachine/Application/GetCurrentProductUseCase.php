<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Repository\TransactionRepository;

class GetCurrentProductUseCase extends UseCase
{
    public function __construct(private TransactionRepository $transactionRepository)
    {
    }

    protected function doExecute(?Request $request = null): Response
    {
        $transactions = $this->transactionRepository->searchAll();
        if (empty($transactions)) {
            return new Response(null);
        }
        $sampleTransaction = reset($transactions);

        return new Response((object)[
            'id' => $sampleTransaction->getProduct()->getId(),
            'code' => $sampleTransaction->getProduct()->getCode(),
            'name' => $sampleTransaction->getProduct()->getName()
        ]);

    }
}