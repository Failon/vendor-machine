<?php

namespace App\VendorMachine\Infrastructure\Controller;

use App\VendorMachine\Application\GetProductListUseCase;
use App\VendorMachine\Application\GetTotalTransaction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    public function __construct (
        private GetProductListUseCase $getProductListUseCase,
        private GetTotalTransaction $getTotalTransaction
    )
    {}


    public function index(Request $request): Response
    {
        $products = $this->getProductListUseCase->execute()->getData();
        $totalTransaction = $this->getTotalTransaction->execute()->getData();
        return $this->render('index.html.twig', [
            'products' => $products,
            'totalInserted' => $totalTransaction
        ]);
    }
}