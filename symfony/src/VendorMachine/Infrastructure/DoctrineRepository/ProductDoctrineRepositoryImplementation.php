<?php

namespace App\VendorMachine\Infrastructure\DoctrineRepository;

use App\VendorMachine\Domain\Entity\Product;
use App\VendorMachine\Domain\Repository\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class ProductDoctrineRepositoryImplementation extends ServiceEntityRepository implements ProductRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }

    public function searchAll(): array
    {
        return $this->findAll();
    }

    public function findOneByCode(string $code): ?Product
    {
        return $this->findOneBy(['code' => $code]);
    }
}