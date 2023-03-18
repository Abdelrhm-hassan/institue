<?php


namespace App\Classes;


use App\Model\Transaction;

class ZarinPal
{
    private $MERCHANT;
    private $WSDL = 'https://www.zarinpal.com/pg/services/WebGate/wsdl';
    private $WSDL_SANDBOX = 'https://sandbox.zarinpal.com/pg/services/WebGate/wsdl';
    private $CALLBACKURL = '';
    public function __construct($CALLBACKURL)
    {
        $this->MERCHANT = env('ZARINPAL');
        $this->CALLBACKURL = $CALLBACKURL;
    }

    public function goToPay($transactionId, $mode =null){
        $transaction = Transaction::find($transactionId);
        if(!$transaction)
            return 'ERR: No Transaction Found';

        $Amount = $transaction->amount;
        $Description = $transaction->title;
        if($mode == 'sandbox'){
            $client = new \SoapClient($this->WSDL_SANDBOX, ['encoding' => 'UTF-8']);
        }else {
            $client = new \SoapClient($this->WSDL, ['encoding' => 'UTF-8']);
        }

        $result = $client->PaymentRequest(
            [
                'MerchantID'    => $this->MERCHANT,
                'Amount'        => $Amount,
                'Description'   => $Description,
                'CallbackURL'   => $this->CALLBACKURL,
            ]
        );

        if ($result->Status == 100) {

            $transaction->update(['gateway'=>'zarinpal','authority'=>$result->Authority]);

            if($mode == null) {
                return ['status'=>200,'url'=>'https://www.zarinpal.com/pg/StartPay/' . $result->Authority];
            }
            if($mode == 'sandbox') {
                return ['status'=>200,'url'=>'https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority];
            }
            if($mode == 'gate') {
                return ['status'=>200,'url'=>'https://www.zarinpal.com/pg/StartPay/' . $result->Authority . '/ZarinGate'];
            }
        } else {
            return ['status'=>'-1','description'=>'ERR: '.$result->Status];
        }
    }

    public function checkVerify($request,$mode = null){
        $transaction = Transaction::where('authority',$request->Authority)->first();
        if(!$transaction)
            return 'ERR: No Transaction Found';
        $MerchantID = $this->MERCHANT;
        $Amount = $transaction->amount;
        $Authority = $request->Authority;

        if ($request->Status == 'OK') {

            if($mode == 'sandbox'){
                $client = new \SoapClient($this->WSDL_SANDBOX, ['encoding' => 'UTF-8']);
            }else{
                $client = new \SoapClient($this->WSDL, ['encoding' => 'UTF-8']);
            }


            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                $transaction->update(['mode'=>'paid','ref'=>$result->RefID]);
                return ['status'=>200,'amount'=>$transaction->amount,'ref'=>$result->RefID,'transaction_id'=>$transaction->id];
            } else {
                return ['status'=>-1,'description'=>$result->Status];
            }
        } else {
            return ['status'=>0];
        }
    }
}
