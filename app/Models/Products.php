<?php
namespace App\Models;

use Schema;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
	protected $table = 'products';
	
	/**
	* @Desc: take out random products 
	*/

	public function scopeRandomize($query, $limit = 3, $exclude = [])
	{
		$query = $query->whereRaw(
			'RAND()<(SELECT ((?/COUNT(*))*10) FROM `products`)',[$limit]
		)->orderByRaw('RAND()')->limit($limit);

		if (!empty($exclude)) {
			$query = $query->whereNotIn('id', $exclude);
		}

		return $query;
	}

	/**
	* @Desc: Take out The orders of products 
	*/

	public static function scopeColumnsOrder($query, $v_order, $v2_sCond)
	{
		$getcolumnsP = Schema::getColumnListing('products');    

		foreach ($getcolumnsP as $getcolumnP) 
		{    
			if($getcolumnP == $v_order){
				if ($v2_sCond) {
					$products = $query->where(
						'order_page', '=', $v2_sCond
						)->orderBy($v_order, 'desc')->get();

				} else {
					$products = $query->orderBy($v_order, 'desc')->get();
				}
			}
		}

		return $products;
	}
	
	/**
	* @Desc: Increment products by -1
	*/

	public function scopeUpdateProducts($query, array $v_mIds) 
	{
		$iAntal = (int) 0;

		foreach($v_mIds as $sv_mId) {
			
			$t_oAntal = $query->get();

			if ($t_oAntal->products_antal === $iAntal) {

				$query->where('products_id','=', $sv_mId)->where(
					'products_antal', '=', $iAntal
					)->delete();
			
			} else {

				$query->where('products_id','=', $sv_mId)->update([
					'products_antal' => -1,
					]);
			
			}
		}
	}
	
	/** 
	* @Desc: updateStock method -1 and inc method +1 in stock
	*/

	public function scopeUpdateStock($query, $v_oId, $v2_sMethod) 
	{
		$t_oPro = $query->where(
			'products_id', '=', $v_oId
		)->select('products_antal')->get();

		$query->where(
			'products_id', '=', $v_oId
		)->select('products_antal')->update([
			'products_antal' => (int) $t_oPro[0]->products_antal -1
		]);
	}
	
	/**
	* @Desc: +1 in cart
	*/

	public function scopeIncUpdateStock($query, $v_oId, $v2_sMethod) 
	{
		$t_oPro = $query->where(
			'products_id', '=', $v_oId
		)->select('products_antal')->get();

		$query->where(
			'products_id', '=', $v_oId
		)->select('products_antal')->update([
			'products_antal' => $t_oPro[0]->products_antal +1
		]);
	}

}
