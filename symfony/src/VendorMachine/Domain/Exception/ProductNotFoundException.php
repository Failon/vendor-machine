<?php

namespace App\VendorMachine\Domain\Exception;

class ProductNotFoundException extends \DomainException
{
    public function __construct(string $productCode, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct(sprintf("Product with code %s not found", $productCode), $code, $previous);
    }
}