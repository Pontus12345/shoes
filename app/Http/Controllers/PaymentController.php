<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalController;

class PaymentController extends GlobalController
{
    private $sHostname;

    public function __construct()
    {
       return $this->sHostname = \Request::server ("HTTP_HOST"); 
    }

    public function paypal_success()
    {
        if (session('username')) {
            
            DB::table('shoppingcart')->where(
                'cart_user_id', "=", session('user_id')
            )->delete();
            
            return View('Runningshoes/pages/paypalSuccess')->with(
                'sHostname', $this->sHostname
            );
        } else {

            return redirect('/');
        }
    }

    public function paypal_cancel()
    {
        return View('Runningshoes/pages/paypalCancel')->with(
            'sHostname', $this->sHostname
        );    
    }

}
