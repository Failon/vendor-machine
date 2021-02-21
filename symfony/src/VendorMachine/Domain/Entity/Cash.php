<?php

namespace App\VendorMachine\Domain\Entity;

class Cash
{
    private int $id;
    private Coin $coin;
    private int $amount;

    public function __construct(Coin $coin, int $amount)
    {
        $this->coin = $coin;
        $this->amount = $amount;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCoin(): Coin
    {
        return $this->coin;
    }

    public function setCoin(Coin $coin): void
    {
        $this->coin = $coin;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }
}