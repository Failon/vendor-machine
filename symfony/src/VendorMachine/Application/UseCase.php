<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;

abstract class UseCase
{
    abstract public function doExecute(Request $request): Response;

    public function execute(Request $request): Response
    {
        return $this->doExecute($request);
    }
}