<?php 
namespace App\Http\Controllers;

use DB;
use Schema;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\GlobalController;

class ProductsController extends GlobalController
{
    private $return;
    private $sHostname;

    /**
    * @Desc: takes out hostname
    */
    
    public function __construct() 
    {
        return $this->sHostname = \Request::server('HTTP_HOST');
    }

    /**
    * @Desc: Ordering products = to url
    * @Param: v1: which order, v2: = to order by v1  
    */

    private function OrderProducts($v1_mOrder, $v2_sCondition = false) 
    {
        $oGetcolumnsP = Schema::getColumnListing('products');

        for ($i=0; $i < count($oGetcolumnsP); $i++) {

            if ($v1_mOrder == $oGetcolumnsP[$i]) {

                $this->return = true;
                $oProducts = Products::ColumnsOrder($v1_mOrder, $v2_sCondition);
            } else {
           
                $returnfalse = false;
            }          
        }
        
        return $oProducts;
    }
    
    /**
    * @Desc: render Products page
    * @param: render the order of the page
    */

    public function ProductsAction($v_order)
    {
        $oProducts = $this->OrderProducts($v_order);
        
        if ($this->return === true) {

            return View('Runningshoes/pages/products/Products')->with([
                'getProducts' => $oProducts,
                'getipsumText' => $this->getText("Lorem ipsum dolor sit"),
                'sHostname' => $this->sHostname
            ]);

        } elseif($returnfalse === false) {
           
            return back();
        }
    }

    /**
    * @Desc: render individual products page
    * @param: render the id of one product
    */

    public function ProductsPage($v_pid)
    {
        $t_oProdids = Products::where('products_id', '=', $v_pid)->get();

        $t_oComments = DB::table('comments')->where(
            'comments_products_id', '=', $v_pid
        )->where(
            'pages', '=', "products$v_pid"
        )->orderBy('id', 'DESC')->get();

        return (!count($t_oProdids)) ? redirect('/') :
            View('Runningshoes/pages/products/productID')->with([
                'getProducts'=> $t_oProdids, 
                'sHostname' => $this->sHostname,
                'id' => $v_pid,
                't_oComments' => $t_oComments
            ]);     
    } 

    /**
    * @Desc: search for products
    */

    public function Search(Request $req)
    {
        if (!empty($req->search)) {

            $t_oProducts = Products::where(
                'products_name', 'LIKE', '%'.$req->search.'%'
            )->get();   
            
            if(count($t_oProducts) !== 0) { 
                
                return View('Runningshoes.pages.products.Products')->with([
                    'getProducts' => $t_oProducts,
                    'getipsumText' => $this->getText("Lorem ipsum dolor sit"),
                    'sHostname' => $this->sHostname
                ]);
                                
            } else {

                abort(403);
            
            }
        
        } else {
          
          return abort(403); 
        
        }
    }

    /**
    * @Desc: Displaying Shoes view
    * @param: render order
    **/

    public function ShoesView($v_order)
    {
        $oProducts_order = $this->OrderProducts($v_order, 'shoes');

        $t_oBanner = DB::table('submenu')->where(
            'submenu_name','=','Shoes'
        )->get();  
        
        return View('Runningshoes.pages.products.Shoesproducts')->with([
            'oProducts_order' => $oProducts_order,
            'Banners' => $t_oBanner,
            'sHostname' => $this->sHostname
        ]);
    }

    /**
    * @Desc: Displaying accessories view
    * @param: render order
    **/

    public function AccessoriesView($v_order)
    {
        $t_oProducts_order = $this->OrderProducts($v_order, 'Accessories');
        
        $t_oBanner = DB::table('submenu')->where(
            'submenu_name','=','Accessories'
        )->get();  
        
        return View('Runningshoes.pages.products.Accessoriesproducts')->with([
            'oProducts_order' => $t_oProducts_order,
            'Banners' => $t_oBanner, 
            'sHostname' => $this->sHostname
        ]);
    }
}