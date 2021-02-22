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

    public function reset(): void
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->delete(Transaction::class)->getQuery()->execute();
    }

    public function beginTransaction(): void
    {
        $this->getEntityManager()->beginTransaction();
    }

    public function commit(): void
    {
        $this->getEntityManager()->commit();
    }

    public function rollback(): void
    {
        $this->getEntityManager()->rollback();
    }
}