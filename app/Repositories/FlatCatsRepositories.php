<?php
namespace App\Repositories;

use DB;	

class FlatCatsRepositories
{
	public function getAll()
	{
		return DB::table('cats')->get();
	}
}