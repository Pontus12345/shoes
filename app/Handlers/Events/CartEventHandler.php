<?php
namespace App\Handlers\Events;

use DB;
use App\Events\CartsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueue;

class CartEventHandler
{
    public function __construct()
    {
        //
    }

    public function handle(CartsEvent $event)
    {
        $addprod = DB::table('carts')->create([
            'username' => $command->username,
            'password' => $command->password,
            'email' => $command->email,
        ]);
        
        return $Regusers;        
    }
}
