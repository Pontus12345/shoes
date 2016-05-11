<?php
namespace App\Repositories;

use DB;	

class FlatBrandsRepositories
{
	public function getAll()
	{
		return DB::table('brands')->get();
	}
}