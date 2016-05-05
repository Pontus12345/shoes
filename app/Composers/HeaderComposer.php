<?php 
namespace App\Composers;

use App\Repositories\FlatHeaderRepositories;

class HeaderComposer
{
	public $header;
	private $sHostname;
	private $mCheckuser;
	
	public function __construct(FlatHeaderRepositories $header)
	{
		$this->mCheckuser = (session('user_id')) ? session('user_id') : 'login';
		$this->header = $header;
		$this->sHostname = \Request::server('HTTP_HOST');
	}

	public function compose($links)
	{
		$links->with([
			'title' => 'Shoes For You',
			'topLinks' => $this->header->getAll()['toplinks'], 
			'links' => $this->header->getAll()['menu'], 
			'sublinks' => $this->header->getAll()['sublinks'],
			'true' => $this->header->getAll()['true'],
			'sHostname' => $this->sHostname,
            'checkuser' => $this->mCheckuser
		]);
	}
}