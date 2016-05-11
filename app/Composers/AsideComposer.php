<?php 
namespace App\Composers;

use App\Repositories\FlatBrandsRepositories;
use App\Repositories\FlatCatsRepositories;

class AsideComposer
{
	public $brands;
	public $cats;
	private $sHostname;

	public function __construct(FlatBrandsRepositories $brands, FlatCatsRepositories $cats)
	{
		$this->cats = $cats;
		$this->brands = $brands;
		$this->sHostname = \Request::server('HTTP_HOST');
	}

	public function compose($v_var)
	{
		$v_var->with([
			'titletest' => '',
			'brands' => $this->brands->getAll(),
			'cats' => $this->cats->getAll(),
			'sHostname' => $this->sHostname
		]);
	}
}