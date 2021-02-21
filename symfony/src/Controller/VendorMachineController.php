<?php

namespace App\Controller;

use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Request $request): Response
    {
        $coin = new Coin(0.30);

        $products = $this->productRepository->searchAll();
        $text = implode(", ", array_column($products, 'name'));
        return new Response($text);
    }
}