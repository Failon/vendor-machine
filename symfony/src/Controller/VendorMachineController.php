<?php

namespace App\Controller;

use App\VendorMachine\Domain\Entity\Coin;
use App\VendorMachine\Domain\Repository\CashRepository;
use App\VendorMachine\Domain\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    private ProductRepository $productRepository;
    private CashRepository $cashRepository;

    public function __construct(ProductRepository $productRepository, CashRepository $cashRepository)
    {
        $this->productRepository = $productRepository;
        $this->cashRepository = $cashRepository;
    }

    public function index(Request $request): Response
    {
        $coin = new Coin(0.25);
        $cash = $this->cashRepository->findByCoin($coin);
        dump($cash); die;

        $products = $this->productRepository->searchAll();
        $text = implode(", ", array_column($products, 'name'));
        return new Response($text);
    }
}