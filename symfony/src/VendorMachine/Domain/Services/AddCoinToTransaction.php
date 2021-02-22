<?php

namespace App\VendorMachine\Domain\Services;

use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Entity\Product;
use App\VendorMachine\Domain\Entity\Transaction;
use App\VendorMachine\Domain\Repository\ProductRepository;
use App\VendorMachine\Domain\Repository\TransactionRepository;

class AddCoinToTransaction
{
    private ProductRepository $productRepository;
    private TransactionRepository $transactionRepository;

    public function __construct(ProductRepository $productRepository, TransactionRepository $transactionRepository)
    {
        $this->productRepository = $productRepository;
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @param float $coinValue
     * @param string $productCode
     * @throws \UnexpectedValueException
     * @throws \DomainException
     */
    public function add(float $coinValue, string $productCode): void
    {
        $coin = new Coin($coinValue);
        $product = $this->productRepository->findOneByCode($productCode);
        $this->assertProductExists($product, $productCode);
        $this->assertThereIsProductStock($product);
        $transaction = $this->transactionRepository->findOneByCoinAndProduct($coin, $product);
        if (empty($transaction)) {
            $transaction = new Transaction($coin, 0, $product);
        }
        $transaction->setAmount($transaction->getAmount() + 1);
        $this->transactionRepository->save($transaction);
    }

    /**
     * @param Product|null $product
     * @param string $productCode
     */
    private function assertProductExists(?Product $product, string $productCode): void
    {
        if (empty($product)) {
            throw new \UnexpectedValueException(sprintf("Product with code %s does not exist", $productCode));
        }
    }

    /**
     * @param Product|null $product
     */
    private function assertThereIsProductStock(?Product $product): void
    {
        if ($product->getStock() <= 0) {
            throw new \DomainException(sprintf("There is no stock for the product '%s'", $product->getName()));
        }
    }
}