<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class GlobalController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $sRandom; 

    public function __construct() 
    {
        $this->sRandom = $this->generateRandomString();    
    }
    
    /** 
    * @Desc: Taking out tables 
    */

    protected function fetchTable($v_oTable)
    {
        return $v_oTable;
    }

    /**
    * @Desc: Title of page
    */

    protected function getTitle($v_sTitle)
    {
        return $v_sTitle;
    }

    protected function getText($v_sText)
    {
        return $v_sText;
    }

    /**
    * @Desc: Taking out submenusand render on all pages
    */

    protected function getSublinks()
    {
        $t_oSubLinks = DB::table('submenu')->get();    
        
        return $t_oSubLinks;
    }

    /**
    * Making CAPTCHA 
    */

    protected function generateAuthString($v1_oField, $v2_oField) 
    {
        $r_sAuthString = ($v1_oField == $v2_oField) ? $v2_oField : "You are a robot";
        
        return $r_sAuthString;
    }

    /**
    * @Desc: generate random string when you refresing page
    * @param: The length of string
    **/

    private function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);
        $randomString = '';
        
        for ($i = 0; $i < $length; $i++) {
        
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        
        }

        return $randomString;
    }

}