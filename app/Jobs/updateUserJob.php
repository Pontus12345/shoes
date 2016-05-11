<?php 
namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;

class updateUserJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public $username;
    public $password;
    public $email;
    public function __construct($username, $password, $email)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    public function handle()
    {
        $aUser = [
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email
        ];

        \DB::table('users')->where(
            'username','=', session('username')
        )->update($aUser);

        session()->put('username', $this->username);
    }
}
