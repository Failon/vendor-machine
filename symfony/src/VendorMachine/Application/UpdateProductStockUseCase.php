<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Services\AddProductStock;

class UpdateProductStockUseCase extends UseCase
{
    public function __construct(private AddProductStock $addProductStock)
    {
    }

    protected function doExecute(?Request $request = null): Response
    {
        $productCode = $request->getParameters()->product;
        $stock = $request->getParameters()->stock;
        $this->assertStockIsInteger($stock);
        $this->addProductStock->add($productCode, $stock);

        return new Response(null);
    }

    private function assertStockIsInteger(int|float $stock)
    {
        if(!is_int($stock)) {
            throw new \InvalidArgumentException("Given Stock must be an integer");
        }
    }
}