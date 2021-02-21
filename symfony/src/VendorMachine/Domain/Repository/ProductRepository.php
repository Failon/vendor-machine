<?php

namespace App\VendorMachine\Domain\Repository;

use App\VendorMachine\Domain\Entity\Product;

interface ProductRepository
{
    public function save(Product $product): void;
    public function searchAll(): array;
}