<?php

namespace App\VendorMachine\Infrastructure\DoctrineRepository;

use App\VendorMachine\Domain\Entity\Cash;
use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Repository\CashRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class CashDoctrineRepositoryImplementation extends ServiceEntityRepository implements CashRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cash::class);
    }

    public function save(Cash $cash): void
    {
        $this->getEntityManager()->persist($cash);
        $this->getEntityManager()->flush();
    }

    public function searchAll(): array
    {
        return $this->findBy([], ['coin.value' => 'DESC']);
    }

    public function findOneByCoin(Coin $coin): Cash
    {
        return $this->findOneBy(['coin.value' => $coin->getValue()]);
    }
}