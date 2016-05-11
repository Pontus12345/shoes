<?php
namespace App\Handlers\Commands;

use DB;
use App\Models\User;
use App\Jobs\updateUserJob;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserJobHandler
{
    public function __construct()
    {
        //
    }

    public function handle(updateUserJob $Job)
    {
        $Updateusers = User::update([
            'username' => $Job->username,
            'password' => $Job->password,
            'email' => $Job->email,
        ]);

        return $Updateusers;
    }

}
