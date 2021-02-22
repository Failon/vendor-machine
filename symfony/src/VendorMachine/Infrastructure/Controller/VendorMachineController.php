<?php

namespace App\VendorMachine\Infrastructure\Controller;

use App\VendorMachine\Application\GetProductListUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    public function __construct (
        private GetProductListUseCase $getProductListUseCase
    )
    {}


    public function index(Request $request): Response
    {
        $products = $this->getProductListUseCase->execute((new \App\VendorMachine\Application\Request\Request()))->getData();

        return $this->render('index.html.twig', [
            'products' => $products
        ]);
    }
}