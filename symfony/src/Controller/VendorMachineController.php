<?php

namespace App\Controller;

use App\VendorMachine\Domain\Services\ResetTransaction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class VendorMachineController extends AbstractController
{
    private ResetTransaction $resetTransation;

    public function __construct(ResetTransaction $resetTransation)
    {
        $this->resetTransation = $resetTransation;
    }


    public function index(Request $request): Response
    {
        $this->resetTransation->reset();

        return new Response("test");
    }
}