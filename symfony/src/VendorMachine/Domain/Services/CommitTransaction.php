<?php

namespace App\VendorMachine\Domain\Services;

use App\VendorMachine\Domain\Entity\Cash;
use App\VendorMachine\Domain\Entity\Transaction;
use App\VendorMachine\Domain\Repository\CashRepository;
use App\VendorMachine\Domain\Repository\ProductRepository;
use App\VendorMachine\Domain\Repository\TransactionRepository;

class CommitTransaction
{
    private TransactionRepository $transactionRepository;
    private ResetTransaction $resetTransaction;
    private CashRepository $cashRepository;
    private ProductRepository $productRepository;

    public function __construct(
        TransactionRepository $transactionRepository,
        ResetTransaction $resetTransaction,
        CashRepository $cashRepository,
        ProductRepository $productRepository
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->resetTransaction = $resetTransaction;
        $this->cashRepository = $cashRepository;
        $this->productRepository = $productRepository;
    }

    public function commit(): void
    {
        $transactions = $this->transactionRepository->searchAll();
        $this->assertTransactionsAreNotEmpty($transactions);
        $this->assertThereIsEnoughStock($transactions);
        $this->transactionRepository->beginTransaction();
        try {
            foreach ($transactions as $transaction) {
                $cash = $this->cashRepository->findOneByCoin($transaction->getCoin());
                if (!empty ($cash)) {
                    $cash->setAmount($cash->getAmount() + $transaction->getAmount());
                } else {
                    $cash = Cash::fromTransaction($transaction);
                }
                $this->cashRepository->save($cash);
            }
            $product = reset($transactions)->getProduct();
            $product->setStock($product->getStock() - 1);
            $this->productRepository->save($product);
            $this->transactionRepository->commit();
        } catch (\Exception) {
            $this->transactionRepository->rollback();
        }
    }

    private function assertTransactionsAreNotEmpty(array $transactions)
    {
        if(empty($transactions)) {
            throw new \UnderflowException("There are no transactions to be committed");
        }
    }

    /**
     * @param Transaction[] $transactions
     */
    private function assertThereIsEnoughStock(array $transactions)
    {
        if (reset($transactions)->getProduct()->getStock() <= 0) {
            throw new \DomainException("There is no stock for the purchased product");
        }
    }
}