<?php

namespace App\Controller;

use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Services\AddCoinToTransaction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    private AddCoinToTransaction $addCoinToTransaction;

    public function __construct(AddCoinToTransaction $addCoinToTransaction)
    {
        $this->addCoinToTransaction = $addCoinToTransaction;
    }

    public function index(Request $request): Response
    {
        $coinValue = 0.25;
        $productCode = 'R5782';
        $this->addCoinToTransaction->add($coinValue, $productCode);


        return new Response("test");
    }
}