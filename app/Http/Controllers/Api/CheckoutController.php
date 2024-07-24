<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BraintreeService;

class CheckoutController extends Controller
{
    // variabile di braintree service
    protected $braintree;

    public function __construct(BraintreeService $braintree)
    {
        $this->braintree = $braintree;
    }

    public function generateToken() {

        $clientToken = $this->braintree->generateClientToken();

        $data = [
            'result' => $clientToken
        ];
        return response()->json($data);
    }

        // $result = $this->braintree->gateway()->transaction()->sale([
        //     'amount' => '10',
        //     'paymentMethodNonce' => $nonce,
        //     'options' => [
        //         'submitForSettlement' => true
        //     ]
        // ]);
    public function makePayment(Request $request) {
        $nonce = $request->payment_method_nonce;
        
        $result = $this->braintree->gateway()->transaction()->sale([
            // dati della transazione
            'amount' => '10',
            'paymentMethodNonce' => $nonce,
            
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        return response()->json($result);
    }

}
