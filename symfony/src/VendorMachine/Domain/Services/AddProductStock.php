<?php

namespace App\VendorMachine\Domain\Services;

use App\VendorMachine\Domain\Repository\ProductRepository;

class AddProductStock
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function add(string $code, int $stock): void
    {
        $this->assertStockIsPositive($stock);
        $product = $this->productRepository->findOneByCode($code);
        $product->setStock($product->getStock() + $stock);
        $this->productRepository->save($product);
    }

    /**
     * @param int $stock
     */
    private function assertStockIsPositive(int $stock): void
    {
        if ($stock <= 0) {
            throw new \UnexpectedValueException("stock to add must be positive");
        }
    }
}