<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
	protected $table = 'shoppingcart';  
	
	/**
	* @Desc: Insert in cart (product)
	*/

	public function scopeInsertcart ($query, $v1_oName, $v2_oPrice, $v3_oFullprice, $v4_oTitle, $v5_oLabel, $v6_oImage, $v7_iQty, $v8_sUserid, $v9_oProdid) 
	{
		$query->insert([
			'shoppingcart_prod_name' => $v1_oName,
			'shoppingcart_prod_price' => $v2_oPrice,
			'full_prise_prod' => $v3_oFullprice,
			'shoppingcart_prod_title' => $v4_oTitle,
			'shoppingcart_prod_label' => $v5_oLabel,
			'shoppingcart_prod_img' => $v6_oImage,
			'cart_pro_qty' => $v7_iQty,
			'cart_user_id' => $v8_sUserid,
			'prod_id' => $v9_oProdid,
		]);
	}
	
	/**
	* @Desc: Uppdate cart 
	*/

	public function scopeUpdateCart ($query, $v1_g_oId, $v2_oQty, $v3_oFullprice) 
	{
		$query->where(
			'prod_id', "=", $v1_g_oId)->update([
			'cart_pro_qty' => $v2_oQty, 
			'full_prise_prod' => $v3_oFullprice,
		]);
	}
	
	/**
	* @Desc: Take out cart
	*/
	
	public function scopeGetCart ($query) 
	{
		return $query->where('cart_user_id', '=', session('user_id'))->get();
	}

	/**
	* @Desc: Remove Cart qty if it exist
	*/

	public function scopeRemoveQty($query, $v1_oProdId, $v2_oCart) 
	{
		$query->where(
			'prod_id', '=', $v1_oProdId
		)->select('cart_pro_qty')->update([
			'cart_pro_qty' => $v2_oCart
		]);
	}
}
