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
	
    protected function fetchTable($v_oTable)
    {
        return $v_oTable;
    }

    protected function getTitle($v_sTitle)
    {
        return $v_sTitle;
    }

    protected function getText($v_sText)
    {
        return $v_sText;
    }

    protected function getSublinks()
    {
        $t_oSubLinks = DB::table('submenu')->get();    
        
        return $t_oSubLinks;
    }
}