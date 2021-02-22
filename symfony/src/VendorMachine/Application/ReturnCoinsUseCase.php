<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Services\ResetTransaction;

class ReturnCoinsUseCase extends UseCase
{

    public function __construct(
        private ResetTransaction $resetTransaction,
        private GetTotalTransaction $getTotalTransaction
    )
    {
    }

    protected function doExecute(?Request $request = null): Response
    {
        $total = $this->getTotalTransaction->execute();
        $this->resetTransaction->reset();

        return $total;
    }
}