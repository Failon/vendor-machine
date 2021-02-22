<?php

namespace App\VendorMachine\Infrastructure\DoctrineRepository;

use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Entity\Product;
use App\VendorMachine\Domain\Entity\Transaction;
use App\VendorMachine\Domain\Repository\TransactionRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class TransactionDoctrineRepositoryImplementation extends ServiceEntityRepository implements TransactionRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function save(Transaction $transaction): void
    {
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();
    }

    public function searchAll(): array
    {
        return  $this->findAll();
    }

    public function findOneByCoinAndProduct(Coin $coin, Product $product): ?Transaction
    {
        return $this->findOneBy(['coin.value' => $coin->getValue(), 'product' => $product]);
    }
}