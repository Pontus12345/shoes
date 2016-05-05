<?php

namespace App\Listeners;

use App\Events\test;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class listener_test
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  test  $event
     * @return void
     */
    public function handle(test $event)
    {
        //
    }
}
