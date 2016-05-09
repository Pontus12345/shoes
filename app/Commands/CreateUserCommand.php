<?php
namespace App\Commands;

use App\Models\User;
use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateUserCommand extends Command
{
    public $username;
    public $password;
    public $email;
    public $image;

    public function __construct($v1_username, $v2_password, $v3_email, $v4_image)
    {
        $this->username = $v1_username;
        $this->password = $v2_password; 
        $this->email = $v3_email;
        $this->image = $v4_image;
    }

    public function handle() 
    {
    	User::create([
            'username' => $this->username,
            'image' => (string) $this->image, 
            'password' => $this->password,
            'email' => $this->email,
        ]);
    }
}
