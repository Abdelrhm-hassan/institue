<?php

namespace App\Classes\Stripe;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Stripe\StripeClient;

class Stripe
{
    private $stripe;
    function __construct() {
        include "stripe-php/init.php";
        $this->stripe = new StripeClient(env('STRIPE_SECRET'));
    }

    function goToPay($return_url, $transaction){
        $this->stripe = $this->stripe->checkout->sessions->create([
            'success_url' => url('/').$return_url,
            'cancel_url' => url('/').$return_url,
            'mode' => 'payment',
            'line_items' => [
                [
                    'quantity'=> 1,
                    'price_data' => [
                        'currency'=> getCurrency(),
                        'unit_amount'=> $transaction->amount * 100,
                        'product_data'=>[
                            'name'  => $transaction->title
                        ]
                    ],
                ],
            ],
        ]);
        if(isset($this->stripe) && $this->stripe->payment_status == 'unpaid'){
            $transaction->update(['authority'=>$this->stripe->id,'gateway'=>'Stripe']);
            header('Location:'.$this->stripe->url);
            exit();
        }
    }
    function verify($transaction,$action = null){
        if($transaction->mode == 'paid')
            return false;

       $id = $transaction->authority;
       $this->stripe = $this->stripe->checkout->sessions->retrieve($id);
       if(isset($this->stripe) && isset($this->stripe->payment_status) && $this->stripe->payment_status == 'paid') {
           $transaction->update(['mode'=>'paid']);
           if($action == 'wallet'){
               $userWallet = User::find($transaction->user_id);
               if($userWallet){
                   $userWallet->update(['wallet'=>$userWallet->wallet + $transaction->amount]);
               }
           }
           return true;
       }

       return false;
    }
}
