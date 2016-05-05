<?php
namespace App\Handlers\Commands;

use App\Models\User;
use App\Commands\CreateUserCommand;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserCommandHandler
{
    public function __construct()
    {
        //
    }

    public function handle(CreateUserCommand $command)
    {
        $Regusers = User::create([
            'username' => $command->username,
            'password' => $command->password,
            'email' => $command->email,
        ]);

        return $Regusers;
    }

}
