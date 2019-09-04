<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConcertsOrdersController extends Controller
{
    //

    private $paymentGateway;
    
    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }


    public function store()
    {
        $paymentGateway->charge($ammount, $token);
        return response()->json([], 201);
    }
}
