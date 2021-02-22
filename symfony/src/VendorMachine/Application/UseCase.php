<?php

namespace App\VendorMachine\Application;

use App\VendorMachine\Application\Request\Request;
use App\VendorMachine\Application\Response\Response;

abstract class UseCase
{
    abstract protected function doExecute(?Request $request = null): Response;

    public function execute(?Request $request = null): Response
    {
        return $this->doExecute($request);
    }
}