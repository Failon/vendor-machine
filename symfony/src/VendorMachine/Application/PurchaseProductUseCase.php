<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Services\CommitTransaction;
use App\VendorMachine\Domain\Services\GetTransactionChange;

class PurchaseProductUseCase extends UseCase
{
    public function __construct (
        private GetTransactionChange $getTransactionChange,
        private CommitTransaction $commitTransaction
    )
    {
    }

    protected function doExecute(?Request $request = null): Response
    {
        $change = $this->getTransactionChange->get();
        $this->commitTransaction->commit();

        return new Response($change);
    }
}