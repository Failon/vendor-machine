<?php

namespace App\VendorMachine\Domain\Services;

use App\VendorMachine\Domain\Entity\Transaction;
use App\VendorMachine\Domain\Repository\CashRepository;
use App\VendorMachine\Domain\Repository\TransactionRepository;

class GetTransactionChange
{
    private CashRepository $cashRepository;
    private TransactionRepository $transactionRepository;

    public function __construct(
        CashRepository $cashRepository,
        TransactionRepository $transactionRepository,
    ) {
        $this->cashRepository = $cashRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function get(): array
    {
        $currentTransactions = $this->transactionRepository->searchAll();
        if (empty($currentTransactions)) {
            Throw new \UnderflowException();
        }
        $labelTransaction = reset($currentTransactions);
        $productPrice = $labelTransaction->getProduct()->getPrice();
        $totalTransaction = $this->getTotalTransaction($currentTransactions);
        $this->assertProductPriceDoNotExceedTransactionCash($productPrice, $totalTransaction, $labelTransaction);
        $cash = $this->cashRepository->searchAll();
        $remainingChange = $totalTransaction - $productPrice;
        $changeInCoins = [];
        foreach ($cash as $coinTypeCash) {
            if ($coinTypeCash->getAmount() > 0) {
                $coinValue = $coinTypeCash->getCoin()->getValue();
                $numberOfCoins = floor($remainingChange / $coinValue);
                if ($numberOfCoins > 0) {
                    if ($numberOfCoins < $coinTypeCash->getAmount()) {
                        $numberOfCoins = $coinTypeCash->getAmount();
                    }
                    $changeInCoins[$coinValue] = $numberOfCoins;
                    $remainingChange = $remainingChange - ($numberOfCoins * $coinValue);
                }
                if ($remainingChange === 0) {
                    break;
                }
            }
        }
        if ($remainingChange !== 0) {
            throw new \DomainException("No change available");
        }

        return $changeInCoins;
    }

    /**
     * @param array $currentTransactions
     * @return float|int
     */
    private function getTotalTransaction(array $currentTransactions): float|int
    {
        $totalTransaction = 0;
        foreach ($currentTransactions as $currentCurrencyTransaction) {
            $coinTotal = $currentCurrencyTransaction->getAmount() * $currentCurrencyTransaction->getCoin()?->getValue();
            $totalTransaction = $totalTransaction + $coinTotal;
        }
        return $totalTransaction;
    }

    /**
     * @param float $productPrice
     * @param float|int $totalTransaction
     * @param Transaction $labelTransaction
     */
    private function assertProductPriceDoNotExceedTransactionCash(
        float $productPrice,
        float|int $totalTransaction,
        Transaction $labelTransaction
    ): void {
        if ($productPrice > $totalTransaction) {
            throw new \DomainException(
                sprintf(
                    "Cannot purchase %s, %d missing",
                    $labelTransaction->getProduct()->getName(),
                    $productPrice - $totalTransaction
                )
            );
        }
    }
}