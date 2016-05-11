<?php 
namespace App\Composers;

class FooterComposer
{
	public $sHostname;

	public function __construct()
	{
		$this->sHostname = \Request::server('HTTP_HOST');
	}

	public function compose($links)
	{
		$links->with(['sHostname' => $this->sHostname]);
	}
}