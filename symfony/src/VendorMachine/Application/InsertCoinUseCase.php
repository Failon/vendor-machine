<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Services\AddCoinToTransaction;

class InsertCoinUseCase extends UseCase
{

    public function __construct(private AddCoinToTransaction $addCoinToTransaction)
    {
    }

    protected function doExecute(?Request $request = null): Response
    {
        $coin = $request->getParameters()->coin;
        $product = $request->getParameters()->product;
        $this->addCoinToTransaction->add($coin, $product);

        return new Response(null);
    }
}