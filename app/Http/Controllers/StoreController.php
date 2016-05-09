<?php 
namespace App\Http\Controllers;

use DB;
use Mail;
use Event;
use Schema;
use Session;
use App\Models\Menu;
use App\Models\Slides;
use App\Models\Products;
use App\Models\Cart;
use App\Models\BloggModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\CommentsRequest;
use App\Http\Controllers\GlobalController;

class StoreController extends GlobalController
{
    private $qtyC;
    private $name;
    private $text;
    private $email;
    private $return;
    private $limit = 8;
    private $sHostname;
    private $getFullPriceProd;

    /**
    * @Desc: Take out url
    */

    public function __construct()
    {
        return $this->sHostname = \Request::server ("HTTP_HOST");
    }
    
    /**
    * @Desc: render view  
    */

    public function StoreAction()
    {
        return View('Runningshoes/pages/Home')->with([
            'getRandomProducts' => Products::randomize($this->limit)->get(),
            'Slides' => Slides::all(),
        ]);
    }

    /**
    * @Desc: totalCart method takes in param and calculate
    * total of moms and all product price that exist in shoppingcart 
    */

    public function CartView()
    {
        if (count(Session::get('user_id')) == 0){

            return redirect('Log-in');
        } else {

            $t_oCartMany = DB::table('shoppingcart')->where(
                'cart_user_id', "=", Session::get('user_id')
                )->get();

            if(count($t_oCartMany) === 0) {

                $sNoPro = 'There are no Products';
                
                return View('Runningshoes/pages/Cart')->with([
                    'noPro' => $sNoPro,    
                    'getAllCarts' => $t_oCartMany,
                    'totalCart' => $this->totalCart(
                        'mysql',
                        'shoppingcart',
                        'cart_user_id',
                        Session::get('user_id'),
                        'full_prise_prod'
                        ),
                    'sHostname' => $this->sHostname    
                    ]);

            } else {

                $sNoPro = '';
                
                return View('Runningshoes/pages/Cart')->with([
                    'noPro' => $sNoPro, 
                    'getAllCarts' => $t_oCartMany,
                    'totalCart' => $this->totalCart(
                        'mysql',
                        'shoppingcart',
                        "cart_user_id",
                        Session::get('user_id'),
                        'full_prise_prod'
                        ),
                    'sHostname' => $this->sHostname    
                    ]);
            }
        }
    }
    
    /**
    * @Desc: adding cart and making max limit of products in cart
    * @method: removing one from product 
    */

    public function addCart()
    {   
        if (count(Session::get('user_id')) === 0){

            return redirect('Log-in');
            
        } else {  

            $aArrQty = [];

            $t_oCarts = Cart::GetCart();
            
            foreach ($t_oCarts as $t_oCart) {

               $aArrQty[] = (int) $t_oCart->cart_pro_qty;
           }

           if (count($t_oCarts) > 30 || in_array(30, $aArrQty)) {

                return redirect("http://$this->sHostname/Shoppingcart")->with(
                   'cartMax', 'Max limit of products in cart'
                );

            }

            $t_pPros = Products::leftJoin(
                'shoppingcart', 'products_id', '=', 'prod_id'
            )->where(
                'products_id','=', Input::get('btn_hidden_id')
            )->get();

            foreach ($t_pPros as $t_pPro) {

                if ($t_pPro->prod_id == true && $t_pPro->cart_user_id == true) { 

                    for ($this->qtyC = $t_pPro->cart_pro_qty; $this->qtyC <= $t_pPro->cart_pro_qty; $this->qtyC++) { 

                        $iQtyCart = $this->qtyC += 1;
                        $this->getFullPriceProd = $t_pPro->Products_price * $this->qtyC;
                        
                        Cart::UpdateCart(
                            Input::get('btn_hidden_id'), 
                            $iQtyCart,
                            $this->getFullPriceProd
                            ); 
                    }

                    $this->updateProductsStock(Input::get('btn_hidden_id'));

                    return redirect('Shoppingcart');
                    exit(); 

                   /**
                    * Laravel bug: return can kill session sometimes,
                    * exit after return fixed the problem 
                    */

                   } else {

                    $this->qtyC = '1';
                    $this->getFullPriceProd = $t_pPro->Products_price * $this->qtyC;
                    
                    Cart::Insertcart(
                        $t_pPro->products_name, 
                        $t_pPro->Products_price,
                        $this->getFullPriceProd,
                        $t_pPro->product_title,
                        $t_pPro->products_label,
                        $t_pPro->product_image,
                        $this->qtyC,
                        Session::get('user_id'),
                        $t_pPro->products_id
                        );

                    $this->updateProductsStock(Input::get('btn_hidden_id'));

                    return redirect('Shoppingcart'); 
                }
            }
        }
    }
    
    /**
    * @Desc: -1 in product stock
    */

    private function updateProductsStock($v_oProdid, $sOpt = Null) 
    {
        if (!session('username')) return back();
        
        Products::UpdateStock($v_oProdid, $sOpt);        
    }

    /**
    * Removing One from cart
    */

    public function removeCartspro()
    {
        if (count(Session::get('user_id')) == 0) {

            return redirect('/');

        } else {  

            $aArrQty = [];

            $t_oCart = DB::table('shoppingcart')->select('cart_pro_qty')->get();
            
            foreach ($t_oCart as $v_t_oCart) {

                $aArrQty[] = (int) $v_t_oCart->cart_pro_qty;
                
            }

            if (max($aArrQty) > 1) {

                Products::IncUpdateStock($_GET['prod_idremove'], 'remove');
                
                Cart::RemoveQty($_GET['prod_idremove'], (int) max($aArrQty) -1);

            } else {

                DB::table('shoppingcart')->where(
                    'prod_id', '=', $_GET['prod_idremove']
                    )->take(1)->delete();

                Products::IncUpdateStock($_GET['prod_idremove'], 'remove');
            }

            return redirect('Shoppingcart');
        }
    }

    /**
    * @Desc: Show cart price for all products inclusive moms 
    */

    private function totalCart($v1_conn, $v2_cart, $v3_getuser, $v4_session, $v5_fullprice)
    {   
        $aPrice = []; 

        $t_oTotalsCosts = DB::connection($v1_conn)->table($v2_cart)->where(
            $v3_getuser, "=", $v4_session
        )->get();

        foreach ($t_oTotalsCosts as $t_oTotalsCost) {

            $aPrice[] = (int) $t_oTotalsCost->cart_pro_qty * (int) $t_oTotalsCost->shoppingcart_prod_price;                  
        }

        $iSum = array_sum($aPrice);
        $oPartC = $iSum;
        $iOnlyM = (int) $iSum * 0.25;
        $iTotalCM = (int) $iSum * 1.25;
        
        if(count($iTotalCM) === 0) {

            return 0 . ' '. '$';

        } else {

            $setSession = Session::put([
                'partC' => $oPartC,
                'onlyM' => $iOnlyM,
                'totalCM' => $iTotalCM,
                ]);

            return $iTotalCM;
            
        }
    }

    /**
    * @Desc: Render forum categori
    */
    
    public function sublink($v_createsubje)
    {
        $t_oCreateSub = DB::table('submenu')->join(
            'forum_cat', 'submenu_id', '=', 'submenu_id'
        )->where('submenu_link', '=', $v_createsubje);   

        $t_oGetforumCats = DB::table('forum_cat')->lists(
            'Forum_cat_name', 'Forum_cat_id'
        );

        if (!count($t_oCreateSub)) {

            return redirect('Products');
            
        } else {

            return View('Runningshoes/pages/'.$v_createsubje)->with([
                'getforumCats' => $t_oGetforumCats,
            ]); 
            
        }
    }  

    public function aboutUsView()
    {
        return View('Runningshoes.pages.aboutUs')->with([
            'infoPages' => DB::table('menus')->where(
                'menu_name', '=', 'About us'
                )->get(),
            ]);
    }

    public function contactUsView()
    {
        Session::put('sRandomAuth', $this->sRandom);

        return View('Runningshoes.pages.contactUs')->with([
            'infoPages' => DB::table('menus')->where(
                'menu_name', '=', 'About us'
                )->get(),
            'sHostname' => $this->sHostname
            ]);
    }

    /**
    * @Desc: Send email to pontusp66J@gmail.com
    */

    public function sendEmail(ContactRequest $request)
    {       
        if ($request) {

            $this->email = $request->email_contact;
            $this->text = $request->text_contact;
            $this->name = $request->name_contact;
            $data = ['email' => $this->email, 'name' => $this->name];

            Mail::send('Runningshoes.pages.emails.reminder', ['text' => $this->text, 'name' => $this->name, 'email' => $this->email], function ($message) use ($data) {

                $message->from($data['email'], $data['name']);
                $message->to('pontusp66J@gmail.com', 'Pontus')->subject('Runningshoes');

            });            

            return back()->with('resived', 'We have resived your Email');
        
        } else {

            return abort(404);

        }
        
    }
    
    /**
    * @desc: Render categori view with products
    */
    
    public function cat($v_id)
    {
        $aBanners = [];

        $t_oCa = DB::table('cats')->join(
            'products', 'Cat_id','=', 'product_cat'
        )->where(
            'categories_title', '=', $v_id
        )->get();

        foreach ($t_oCa as $v_ban) {

            $aBanners[] = $v_ban->banner_link;      
            break;
            
        }

        $oCats = (count($t_oCa) > 0) ? View('Runningshoes.pages.products.cats')->with([
            'cats' => $t_oCa,
            'Banners' => $aBanners,
            'sHostname' => $this->sHostname
        ]) : abort(403);

        return $oCats;
    }

    /**
    * @desc: Render Brand view with products
    */

    public function brand($v_id)
    {
        $aBanners = [];

        $t_oBa = DB::table('brands')->join(
            'products', 'Brand_id','=', 'product_brand'
            )->where(
            'categories_title', '=', $v_id
            )->get();

        foreach ($t_oBa as $v_ban) {

            $aBanners[] = $v_ban->banner_link;      
            break;
            
        }

        $oBrands = (count($t_oBa) > 0) ? View('Runningshoes.pages.products.brands')->with([
            'Banners' => $aBanners,
            'brands' => $t_oBa,
            'sHostname' => $this->sHostname,
            'page' => $v_id,
            ]) : abort(403);

        return $oBrands;
    }

    public function Terms_ConditionView()
    {
        return View('Runningshoes.pages.TermsCondition');
    }

    public function BloggView($v_order)
    {
        $t_ogGetBloggs = Menu::where(
            'menu_name','=', 'Blogg'
        )->select('info')->get();

        $t_oGetcolumnsO = Schema::getColumnListing('blog');

        for ($i=0; $i < count($t_oGetcolumnsO); $i++) { 

            if ($v_order === $t_oGetcolumnsO[$i]) {

                $this->return = true;

                $oOrders = BloggModel::ColumnsOrder($v_order, $t_oGetcolumnsO);
                
            } else {

                $returnfalse = false;
            }          
        }

        if ($this->return === true) {

            $d_Ord = $this->ClosetsDate($oOrders);

            return View('Runningshoes.pages.blogg.BloggView')->with([
                'getBloggs' => $t_ogGetBloggs,
                'orders' => $oOrders,
                'getcolumnsO' => $t_oGetcolumnsO,
                'closetsdate' => $d_Ord,
                ]);

        } elseif($returnfalse === false) {

            return back();
            
        }
    }

    /**
    * @Desc: render bloggviewId
    */
    
    public function BloggPostView($v_order)
    {
        $t_oPostOrder = BloggModel::where("ID","=", $v_order)->get();

        $t_oComments = DB::table('comments')->where(
            'comments_blogg_id', '=', $v_order
        )->where(
            'pages', '=', "blogg$v_order"
        )->orderBy('id', 'DESC')->get();

        return View('Runningshoes.pages.blogg.blogpostView')->with([
            'postOrders' => $t_oPostOrder,
            't_oComments' => $t_oComments,
            'id' => $v_order,
            'sHostname' => $this->sHostname
        ]);
    }

    /**
    * Take out closets date from blogg
    * @param V1 = what order,
    * @param V2 = that date,
    * @param V3 = choose what date it will aim for, 
    */

    private function ClosetsDate($v1_orders, $v2_date = [], $v3_dateClosets = [])
    {
        if (is_object($v1_orders) && $v2_date === [] && $v3_dateClosets === []) {

            foreach ($v1_orders as $v_order) {

                $v2_date[] = $v_order->Date;
                
            }

            $d_baseDate = date_create('2016-05-04');
            $d_count = count($v2_date);

            for($i=0;$d_count>$i;$i++) {

                $datetime = date_create($v2_date[$i]);
                $interval = date_diff($d_baseDate, $datetime);
                $newDate[$interval->format('%s')] = $v2_date[$i];
                
            }

            ksort($newDate);

            $splice = array_slice($newDate, 0, 5, true);

            foreach($splice as $v_splice => $arg_opt) {

                $v3_dateClosets[] = $v_splice;
                
            }

            return $v3_dateClosets;

        } else {

            abort(403);
            
        }
    }

    /**
    * @Desc: making comments 
    */

    public function Comments(CommentsRequest $req) 
    {   
        if ($req) {

            if (!isset($req->comments_products_id) || !isset($req->comments_blogg_id)) {

                if (!isset($req->comments_products_id)) {

                    $req->comments_products_id = null;
                
                } elseif(!isset($req->comments_blogg_id)) {    

                    $req->comments_blogg_id = null;
                
                }
            }

            DB::table('comments')->insert([
                'name' => $req->comments_username,
                'comments' => $req->comments_content,
                'pages' => $req->comments_id,
                'date' => date('y-m-d'),
                'rate' => $req->You_need_to_check_a_star,
                'comments_products_id' => $req->comments_products_id,
                'comments_blogg_id' => $req->comments_blogg_id
            ]);   
        }

        return back(); 
    }
}