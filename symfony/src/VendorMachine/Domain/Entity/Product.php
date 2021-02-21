<?php

namespace App\VendorMachine\Domain\Entity;

class Product
{
    private int $id;
    private string $code;
    private string $name;
    private float $price;
    private int $stock;

    public function __construct(string $code, string $name, float $price, int $stock)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __isset($prop) : bool
    {
        return isset($this->$prop);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }
}