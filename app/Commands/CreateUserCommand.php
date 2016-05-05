<?php
namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateUserCommand extends Command
{
    public $username;
    public $password;
    public $email;
    
    public function __construct($v1_username, $v2_password, $v3_email)
    {
        $this->username = $v1_username;
        $this->password = $v2_password; 
        $this->email = $v3_email;   
    }
}
