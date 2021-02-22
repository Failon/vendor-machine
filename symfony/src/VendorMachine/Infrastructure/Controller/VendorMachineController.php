<?php

namespace App\VendorMachine\Infrastructure\Controller;

use App\VendorMachine\Application\GetCurrentProductUseCase;
use App\VendorMachine\Application\GetProductListUseCase;
use App\VendorMachine\Application\GetTotalTransaction;
use App\VendorMachine\Application\InsertCoinUseCase;
use App\VendorMachine\Application\ReturnCoinsUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    public function __construct (
        private GetProductListUseCase $getProductListUseCase,
        private GetTotalTransaction $getTotalTransaction,
        private GetCurrentProductUseCase $getCurrentProductUseCase,
        private InsertCoinUseCase $insertCoinUseCase,
        private ReturnCoinsUseCase $returnCoinsUseCase
    )
    {}


    public function index(Request $request): Response
    {
        $product = $this->getCurrentProductUseCase->execute()->getData();
        $products = $this->getProductListUseCase->execute()->getData();
        $totalTransaction = $this->getTotalTransaction->execute()->getData();
        return $this->render('index.html.twig', [
            'selectedProduct' => $product,
            'products' => $products,
            'totalInserted' => $totalTransaction
        ]);
    }

    public function insertCoin(Request $request): Response
    {
        $coinValue = (float) $request->get('coin');
        $productCode = $request->get('product');
        $insertCoinRequest = new \App\VendorMachine\Application\Request\Request(
            (object)['coin' => $coinValue, 'product' => $productCode]
        );
        try {
            $this->insertCoinUseCase->execute($insertCoinRequest);
        } catch (\Exception $e) {
            $this->addFlash('danger', $e->getMessage());
        }

        return $this->redirectToRoute('index');
    }

    public function returnCoins(Request $request): Response
    {
        $totalReturned = $this->returnCoinsUseCase->execute()->getData();
        $this->addFlash('info', sprintf("%.2f amount returned", $totalReturned));

        return $this->redirectToRoute('index');
    }
}