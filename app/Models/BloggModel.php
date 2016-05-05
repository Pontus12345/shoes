<?php
namespace App\Models;

use Schema;
use Illuminate\Database\Eloquent\Model;

class BloggModel extends Model
{
    protected $table = 'blog';
    
	public function scopeColumnsOrder($query, $v_oOrder, $v_oGetcolumns)
	{    
        foreach ($v_oGetcolumns as $v_oGetcolumn) 
        {    
            if ($v_oGetcolumn == $v_oOrder){

                $oOrderBlogg = $query->orderBy($v_oOrder, 'DESC')->get();
            }
        }
        
        return $oOrderBlogg;
	}
}
