<?php 
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Helper\JsonApiHelper;
use App\Http\Controllers\GlobalController;

class ApiController extends GlobalController
{

	/**
	* @Desc: Api for comments
	* @Method: (Select and Insert to db)	
	*/

	public function iCommentsRequest(Request $req)
	{
		if ($req->all()) {

			$i_atComments = [
				'name' => substr(e($req->pname),strripos(e($req->pname),'=')+strlen('=')),
				'comments' => substr(e($req->pComment),strripos(e($req->pComment),'=')+strlen('=')),
				'email' => substr(e($req->pemail),strripos(e($req->pemail),'=')+strlen('=')),
				'pages' => substr(e($req->pPage), strripos(e($req->pPage),'=')+strlen('='))
			];

			DB::table('comments')->insert($i_atComments);
		}

		if ($req->pages) {

			$s_tComments = DB::table('comments')->where(
				'pages', '=', substr(e($req->pages), strripos(e($req->pages),'='
			)+strlen('=')))->orderBy('id', 'desc')->get();
		
			JsonApiHelper::successResponse($s_tComments);
		}
	}

	public function sCommentsrate(Request $req) 
	{
		if ($req)

			$s_aRate = DB::table('comments')->select('rate', 'comments_products_id')->get();
			JsonApiHelper::successResponse($s_aRate);
	}
}
