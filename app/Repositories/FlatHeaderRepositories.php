<?php 
namespace App\Repositories;

use DB;	
use App\Models\Menu;
use App\Http\Controllers\GlobalController;

class FlatHeaderRepositories extends GlobalController
{
	public function getAll()
	{
		if (session('username')) {
			
			$true = true;
		} else {
			
			$true = false;
		}
		
		$top = DB::table('toplinks')->get();
		
		$top2 = DB::table('toplinks')->get();
		
		$links = Menu::all();
		
		$sublinks = $this->getSublinks();
		
		$title = $this->getTitle('Shoes for you');
		
		$Links = [
			'titletest' => $title,
			'menu' => $links,
			'sublinks' => $sublinks,
			'toplinks'=>$top,
			'true' => $true
		];
		
		return $Links;
	}
}
