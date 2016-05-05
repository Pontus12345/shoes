<?php
namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateSubjectCommand extends Command
{
    public $name;
    public $text;
    public $post_cat_id;

    public function __construct($v1_name, $v2_text, $v3_postCatId)
    {
        $this->name = $v1_name;
        $this->text = $v2_text;    
    	$this->post_cat_id = $v3_postCatId;
    }
}
