<?php

namespace App\VendorMachine\Domain\Entity;

class Transaction
{
    private int $id;
    private Coin $coin;
    private int $amount;
    private Product $product;

    public function __construct(Coin $coin, int $amount, Product $product)
    {
        $this->coin = $coin;
        $this->amount = $amount;
        $this->product = $product;
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

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}