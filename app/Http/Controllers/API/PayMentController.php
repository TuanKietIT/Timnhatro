<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Omnipay\Omnipay;

class PayMentController extends Controller
{
    private $gateway;
    
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        $this->gateway->setTestMode(true);

    }
    public function pay(Request $request)
    {
        try{
           $response = $this->geteway->purchase(array(
               'amount' => $request->amount,
               'currency' => env('PAYPAL_CURRENCY'),
               'returnUrl' => url('success'),
               'cancelUrl' => url('error')

           ))->send();
           if($response->isRedirect()){
              $response->isRedirect();
           }
           else{
             return $response->getMessage();
           }
        }
        catch(\Throwable $th){
            return $th->getMessage();
        }
    }
}
