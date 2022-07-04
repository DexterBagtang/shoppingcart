<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\SendMail;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class ClientController extends Controller
{
    public function home(){
        $sliders = Slider::all()->where('status',1);
        $products = Product::all()->where('status',1);
        return view('client.home')->with('sliders',$sliders)->with('products',$products);
    }

    public function shop(){
        $categories = Category::all();
        $products = Product::all()->where('status',1);

        return view('client.shop')->with('categories',$categories)->with('products',$products);
    }


    public function addtocart($id){
        $product = DB::table('products')
            ->where('id', $id)
            ->first();

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return redirect::to('/shop');
    }

    public function cart(){
        if(!Session::has('cart')){
            return view('client.cart');
        }

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    }

    public function updateqty(Request $request, $id){
        //print('the product id is '.$request->id.' And the product qty is '.$request->quantity);
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id, $request->quantity);
        Session::put('cart', $cart);

        //dd(Session::get('cart'));
        return back();
    }

    public function removeitem($product_id){
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($product_id);

        if(count($cart->items) > 0){
            Session::put('cart', $cart);

        }
        else{
            Session::forget('cart');
        }

        //dd(Session::get('cart'));
        return back();
    }

    public function checkout(){
        if (!Session::has('client')){
            return view('client.login');
        }
        if (!Session::has('cart')){
            return view('client.cart')->with('status','No added products in the cart !');
        }
        return view('client.checkout');
    }

    public function login(){
        return view('client.login');
    }
    public function logout(){
        Session::forget('client');
        return \redirect('/shop');
    }

    public function accessaccount(Request $request){
        $this->validate($request,['email'=>'email|required ',
            'password'=>'required']);
        $client = Client::where('email',$request->input('email'))->first();

        if ($client){
            if (Hash::check($request->input('password'),$client->password)){
                Session::put('client',$client);
                return redirect('/shop');
            }
            else{
                return back()->with('status','Incorrect email or password');

            }

        }
        else{
            return back()->with('status','Email does not exist');
        }

    }

    public function signup(){
        return view('client.signup');
    }

    public function register(Request $request){
        $this->validate($request,['email'=>'email|required|unique:clients',
                                    'password'=>'required|min:4']);
        $client = new Client();
        $client->email = $request->input('email');
        $client->password = bcrypt($request->input('password'));

        $client->save();

        return back()->with('status','Your account has been created successfully');

    }

    public function postcheckout(Request $request){

        try {
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);

            $payer_id = time();

            $order = new Order();
            $order->name = $request->input('name');
            $order->address = $request->input('address');
            $order->cart = serialize($cart);

            Session::put('order',$order);

            $checkoutData = $this->checkoutData();

            $provider = new ExpressCheckout();

            $response = $provider->setExpressCheckout($checkoutData);

            return redirect($response['paypal_link']);

        }
        catch(\Exception $e){
            return redirect('/checkout')->with('error',$e->getMessage);
        }

//        $order->save();
//
//        Session::forget('cart');
//
//        $orders = Order::where('payer_id',$payer_id)->get( );
//        $orders->transform(function($order, $key){
//            $order->cart = unserialize($order->cart);
//            return $order;
//        });
//
//        $email = Session::get('client')->email;
//
//        Mail::to($email)->send(new SendMail($orders));
//
//
//
//        return redirect('/cart')->with('status','Your purchase has been successfully accomplished!');
    }

    private function checkoutData(){

        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);

        $data['items']=[];

        foreach($cart->items as $item){
            $itemDetails = [
                'name' => $item['product_name'],
                'price'=> $item['product_price'],
                'qty'  => $item['qty']
            ];
            $data['items'][] = $itemDetails;
        }

        $checkoutData = [
            'items'      => $data['items'],
            'return_url' => url('/payment-success'),
            'cancel_url' => url('/checkout'),
            'invoice_id' => uniqid(),
            'invoice_description' => "Order Description",
            'total' => Session::get('cart')->totalPrice
        ];

        return $checkoutData;

    }

    public function payment_success(Request $request){
        try{
            $token = $request->get('token');
            $payerId = $request->get('PayerID');
            $checkoutData = $this->checkoutData();

            $provider = new ExpressCheckout();
            $response = $provider->getExpressCheckoutDetails($token);
            $response = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);

            $payer_id = $payerId.''.time();

            Session::get('order')->payer_id = $payer_id;

            Session::get('order')->save();

            $orders = Order::where('payer_id',$payer_id)->get( );
            $orders->transform(function($order){
                $order->cart = unserialize($order->cart);
                return $order;
            });

            $email = Session::get('client')->email;

            Mail::to($email)->send(new SendMail($orders));

            Session::forget('cart');



            return redirect('/cart')->with('status','Your purchase has been successfully accomplished!');


            //return redirect('/cart')->with('status','Success !');
    }

        catch(\Exception $e){
            return redirect('/checkout')->with('error',$e->getMessage);
        }
    }


    public function order(){
        $orders = Order::all();
        $orders->transform(function($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        return view('client.order')->with('orders',$orders);
    }
}
