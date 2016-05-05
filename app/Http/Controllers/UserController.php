<?php 
namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Route;
use Session;
use Datetime;
use App\Models\User;
use App\Jobs\updateUserJob;
use Illuminate\Http\Request;
use App\Commands\CreateUserCommand;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Controllers\GlobalController;

class UserController extends GlobalController
{    
    private $oTokenDB;

    public function showLogIn()
    {
        return View('Runningshoes/pages/User')->with(
            'token', $this->getToken()
        );
    }

    private function getToken()
    {        
        Route::get('someRoute', [
            'uses' => 'HomeController@getSomeRoute', 'middleware' => 'csrf'
        ]);
        
        $t_oGetTokens = $this->fetchTable(DB::table('users')->get([
            'remember_token' =>'remember_token'
        ]));
        
        foreach ($t_oGetTokens as $t_oGetToken) {
            
            $this->oTokenDB = $t_oGetToken->remember_token;
        }

        return $this->oTokenDB;
    }

    public function getDate()
    {
        $date = new DateTime();
        $date->format('Y-m-d H:i:s');

        return $date;
    }

    public function reguser(RegisterRequest $request)
    {
        $oUserR = new CreateUserCommand(
            $request->Reg_username,
            Hash::make($request->Reg_password),
            $request->Reg_email
        );

        $this->dispatch($oUserR);
        
        return back()->with('RegUser', 'You Have Created A New User');
    }

    public function makeLogin(ProfileRequest $request)
    {
        $t_oUser_ids = User::where(
            "username","=", $request->login_username
        )->get();

        foreach ($t_oUser_ids as $t_oUser_id ) {
        
            $oUserId = $t_oUser_id->id;
        }

        $aValid = [
            'username' => $request->login_username,
            'password' => $request->login_password,
        ];

        if(Auth::attempt($aValid)) {

            $setSession = Session::put([
                'username' => $request->login_username,
                'password' => $request->login_password,
                'user_id' => $oUserId,
                'token' => $request->_token
            ]);

            return redirect('/');        
        } else {
            
            $Session = Session::put([
                'Error' => 'Your Log in information was incorrect',
            ]);

            return redirect('Log-in');    
        }
    }

    public function logout()
    {
        if (Session()->has('token'))
            
            Session::flush();
            
            return redirect('/');
    }

    public function AccountView()
    {
        $sView = (session('username')) ? View('Runningshoes.pages.Account') : back();    
        
        return $sView;
    }

    public function UpdateAcc(UpdateRequest $request)
    {   
        if (session('username')) {

            $this->dispatch(new UpdateUserJob(
                $request->update_username,
                Hash::make($request->update_password), 
                $request->update_email)
            );

            return back()->with(
                'Updated', 'You have updated your login information correct'
            );

        } else {

            return back();
        }
    }

    public function forumUserView($v_Username)
    {   
        $t_oGetUser = User::where('username','=', $v_Username)->get();
        
        $getuserForum = DB::table('subjects')->where(
            'subjects_username','=', $v_Username
        )->count();

        return View('Runningshoes.pages.forum.User')->with([
            'getuserForum' => $getuserForum,
            'getUsers' => $t_oGetUser,
        ]);
    }
}
