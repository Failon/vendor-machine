<?php

namespace App\VendorMachine\Domain\Repository;

use App\VendorMachine\Domain\Entity\Cash;
use App\VendorMachine\Domain\Entity\Coin;

interface CashRepository
{
    public function save(Cash $cash): void;
    public function searchAll(): array;
    public function findOneByCoin(Coin $coin): Cash;
}