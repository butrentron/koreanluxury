<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Http\Requests\OrderRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Validator;

class SiteController extends Controller
{
    protected $types;
    protected $categories;
    protected $brands;
    protected $products;
    protected $slides;
    protected $settings;
    protected $ships;

    public function __construct( \App\Type $types, \App\Category $categories, 
                                 \App\Brand $brands, \App\Product $products, 
                                 \App\Slide $slides, \App\Setting $settings,
                                 \App\Ship $ships ) 
    {
        $this->types        = $types;
        $this->categories   = $categories;
        $this->brands       = $brands;
        $this->products     = $products;
        $this->slides       = $slides;
        $this->settings     = $settings;
        $this->ships        = $ships;
    }

    private function getBrands() {
        return $this->brands->select('id', 'slug', 'name', 'image')->get();
    }

    private function getSettings() {
        return $this->settings->first();
    }

    private function getSlides() {
        return $this->slides->select('id', 'title', 'desc', 'link', 'image')->where('publish', 0)->get();
    }

    private function getShips() {
        return $this->ships->select('id', 'name', 'desc', 'logo')->get();
    }

    public function index() {

        $a = \DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.category_id')
                    ->select(\DB::raw('max(products.id), categories.*'))
                    ->get();
        dd($a);

        $types = $this->types->select( 'id', 'name', 'slug', 'description' )
                                    ->where( 'display', '1' )
                                    ->orderBy( 'sort', 'asc' )
                                    ->get();

        $brands = $this->getBrands();
        $slides = $this->getSlides();
        $setting = $this->getSettings();
    	return view('site.index', compact( 'types', 'brands', 'slides', 'setting' ));
    }

    public function categories( $id, $slug ) {
        $category = $this->categories->select( 'id', 'name', 'slug', 'lft', 'rgt', 'set_title', 'meta_key', 'meta_desc' )
                                    ->where( [['slug', $slug],['id', $id]] )->first();
        if( !$category ) abort(404);

        $categories = $category->select( 'id' )
                                ->whereBetween( 'lft', [$category->lft, $category->rgt] )->get();

        $brands = $this->getBrands();

        $products = $this->products->whereIn('category_id', $categories)->orderBy('id', 'desc')->paginate(20);

        $slides = $this->getSlides();

        $setting = $this->getSettings();

    	return view('site.categories', compact( 'products', 'category', 'brands', 'slides', 'setting' ));
    }

    public function types( $id, $slug ) {
        $category = $this->types->select( 'id', 'name', 'slug', 'description' )
                                ->where( [['slug', $slug],['id', $id], ['display', 1]] )->first();
        if( !$category ) abort(404);

        $products = $category->products()->paginate(20);

        $brands = $this->getBrands();
        $slides = $this->getSlides();
        $setting = $this->getSettings();
        return view('site.categories', compact( 'products', 'category', 'brands', 'slides', 'setting' ));
    }

    public function brands( $id, $slug ) {
        $category = $this->brands->select( 'id', 'name', 'slug', 'set_title', 'meta_desc', 'meta_key' )
                                ->where( [['slug', $slug],['id', $id]] )->first();
        if( !$category ) abort(404);

        $products = $category->products()->paginate(20);

        $brands = $this->getBrands();

        $slides = $this->getSlides();
        
        $setting = $this->getSettings();

        return view('site.categories', compact( 'products', 'category', 'brands', 'slides', 'setting' ));
    }

    public function products($id, $slug) {
        $product = $this->products->where( [['slug', $slug],['id', $id]] )->first();
        if( !$product ) abort(404);

        $view = $product->view;
        $product->update([
            'view' => $view + 1
        ]);

        $producstAsBrand = $product->where('brand_id', $product->brand_id)->whereNotIn('id', [$product->id])->take(15)->get();
        
        $setting = $this->getSettings();
        $ships = $this->getShips();
    	return view('site.single', compact('product', 'producstAsBrand', 'setting', 'ships'));
    }

    public function search() {
        $brands = $this->getBrands();

        $slides = $this->getSlides();
        
        $setting = $this->getSettings();

        if(Request::get('keywords') && Request::get('keywords') != null) {
            $keywords = Request::get('keywords');
            $products = $this->products->where('name', 'like', '%'.$keywords.'%')->paginate(20);
        }else {
            abort(404);
        }
        return view('site.products', compact( 'products', 'brands', 'slides', 'setting' ));
    }

    public function cart(Request $Request) {

        if (Request::isMethod('post')) {

            $validator = Validator::make(Request::all(), [
                'ship' => 'required',
                'size' => 'required',
                'color' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

            $product_id = Request::get('product_id');
            $product = $this->products->find($product_id);
            Cart::add(array(
                'id' => $product_id, 
                'name' => $product->name,
                'qty' => Request::get('qty') ? Request::get('qty') : 1, 
                'price' => ($product->sale !=0) ? $product->price_at : $product->price,
                'options' => array(
                    'image' => $product->image,
                    'color' => Request::get('color'),
                    'size' => Request::get('size'),
                    'ship' => Request::get('ship'),
                    'logo_ship' => Request::get('logo_ship'),
                    'slug' => Request::get('slug'),
                ),
            ));
        }
        if (Request::get('product_id') && (Request::get('increment')) == 1) {
            $rowId = Cart::search(array('id' => Request::get('product_id')));
            $item = Cart::get($rowId[0]);

            Cart::update($rowId[0], $item->qty + 1);
        }

        if (Request::get('product_id') && (Request::get('decrease')) == 1) {
            $rowId = Cart::search(array('id' => Request::get('product_id')));
            $item = Cart::get($rowId[0]);

            Cart::update($rowId[0], $item->qty - 1);
        }

        if(Request::get('product_id') && (Request::get('remove')) == 'true') {
            $rowId = Cart::search(array('id' => Request::get('product_id')));
            Cart::remove($rowId[0]);
        }

        $cart = Cart::content();

        $products = $this->products->orderBy('view', 'desc')->take(15)->get();
        
    	
        $setting = $this->getSettings();
        $ships = $this->getShips();

        return view('site.cart', compact('cart', 'products', 'setting', 'ships'));
    }

    public function destroyCart() {
        Cart::destroy();
        return redirect()->route('site.cart.get');
    }

    public function getOrder() {
        $setting = $this->getSettings();
        if(Cart::total() == 0) {
            return redirect('/')->with(['message' => 'Hiện tại bạn vẫn chưa có sản phẩm nào. Hãy mua hàng~', 'type' => 'danger']);
        }
        return view('auth.infomation', compact('setting'));
    }

    public function postOrder(OrderRequest $request) {
        $setting = $this->getSettings();

        $input = $request->all();
        $input['amount'] = Cart::total();
        $transactions = \App\Transaction::create($input);

        $last_id_trans = $transactions->id;

        foreach(Cart::content() as $item) {
            $attr = ['colors' => $item->options->color, 'sizes' => $item->options->size, 'ships' => $item->options->ship];

            $orders = \App\Order::create([
                'transaction_id'    => $last_id_trans,
                'product_id'        => $item->id,
                'amount'            => $item->subtotal,
                'qty'               => $item->qty,
                'data'              => json_encode($attr)
            ]);
        }

        if(\Response::json(['success' => true], 200)) {
            \Mail::send('auth.emails.cart2', ['data' => $transactions], function ($message) use ($transactions, $setting) {
                $message->from($setting->email);
                $message->to('0905483996@txt.att.net')->subject('Thông tin đơn hàng!');
            });

            // \Mail::send('auth.emails.cart', ['data' => $transactions, 'setting' => $setting], function ($message) use ($transactions) {
            //     $message->to($transactions->email, $transactions->name)->subject('Thông tin đơn hàng!');
            // });

            // \Mail::send('auth.emails.sendAdmin', ['data' => $transactions], function ($message) use ($transactions, $setting) {
            //     $message->from($transactions->email, 'Thông tin đơn hàng của '.$transactions->name);

            //     $message->to($setting->email, 'Luxury.com')->subject('Thông tin giao dịch');
            // });

            $name = $transactions->name;
            $phone = $transactions->phone;
            $email = $transactions->email;

            // $this->sms($name, $phone, $email);

            

            Cart::destroy();

            return redirect('/')->with(['message' => 'Bạn đã đặt hàng thành công. Hãy truy cập email để xem đơn hàng của mình.', 'type' => 'success']);
            
        }
    }

    public function pages($uri) {
        $setting = $this->getSettings();
        $page = \App\Page::select( 'id', 'name', 'uri', 'content', 'meta_key', 'meta_desc', 'set_title' )
                                ->where( [['uri', $uri], ['hidden', 0]] )->first();

        if(!$page) abort(404);
        return view('site.page', compact('setting', 'page'));
    }

    public function sms($name, $phone, $email) {
        $setting = $this->getSettings();

        $APIKey=$setting->api;
        $SecretKey=$setting->secret;
        $YourPhone=$setting->phone_at;

        $ch = curl_init();
        
        $SampleXml = "<RQST>"
                       . "<APIKEY>". $APIKey ."</APIKEY>"
                       . "<SECRETKEY>". $SecretKey ."</SECRETKEY>"                                    
                       . "<ISFLASH>0</ISFLASH>"
               . "<SMSTYPE>7</SMSTYPE>"
                       . "<CONTENT>". 'Xin chào Admin! Hiện tại đang có một hóa đơn đặt hàng từ khách hàng '.$name.'- Số ĐT:'.$phone.' -E-mail:'.$email ."</CONTENT>"
                       . "<CONTACTS>"
                       . "<CUSTOMER>"
                       . "<PHONE>". $YourPhone ."</PHONE>"
                       . "</CUSTOMER>"                               
                       . "</CONTACTS>"
                       . "</RQST>";
                               
        curl_setopt($ch, CURLOPT_URL, "http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V2/" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_POST, 1 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $SampleXml ); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain')); 

        $result=curl_exec ($ch);        
        $xml = simplexml_load_string($result);

        if ($xml === false) {
            die('Error parsing XML');   
        }

        if( $xml->CodeResult == 103 ) {
            return \Mail::send('auth.emails.errors', ['data' => $setting], function ($message) use ($setting) {
                $message->to($setting->email, $setting->name)->subject('Thông báo từ website!');
            });
        }

        return true;
    }

}
