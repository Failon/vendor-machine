<?php

namespace App\VendorMachine\Domain\Repository;

use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Entity\Product;
use App\VendorMachine\Domain\Entity\Transaction;

interface TransactionRepository
{
    public function save(Transaction $transaction): void;

    /**
     * @return Transaction[]
     */
    public function searchAll(): array;
    public function findOneByCoinAndProduct(Coin $coin, Product $product): ?Transaction;
    public function reset(): void;
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
}