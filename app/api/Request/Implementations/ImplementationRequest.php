<?php


namespace App\api\Request\Implementations;



use App\Services\Implementation\ImplementationService;
use Illuminate\Http\Client\Request;

class ImplementationRequest
{
    public $request;
    private $service;

    public function __construct(Request $request , ImplementationService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }
}
