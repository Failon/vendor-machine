<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;
use App\VendorMachine\Domain\Repository\ProductRepository;

class GetProductListUseCase extends UseCase
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function doExecute(Request $request): Response
    {
        $products = [];
        foreach ($this->productRepository->searchAll() as $product) {
            $products[] = (object) [
                'id' => $product->getId(),
                'code' => $product->getCode(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'stock' => $product->getStock()
            ];
        }

        return new Response($products);
    }
}