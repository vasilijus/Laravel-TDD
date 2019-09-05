<?php

use App\Concert;


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Billing\PaymentGateway;

class ConcertsOrdersController extends Controller
{

    private $paymentGateway;

    public function __construct(PaymentGateway $paymentGateway)
    {
        $this->$paymentGateway = $paymentGateway; // Line 18
    }

    //
    public function store($concertId)
    {
        $concert = Concert::find($concertId);

        // Charging the customer 
        
        $this->paymentGateway->charge( request('ticket_quantity') * $concert->ticket_price , request('payment_token') );

        // Create the order

        $order = $concert->orderTickets( request('email') , request('ticket_quantity') );

        return response()->json([], 201);
    }
}
